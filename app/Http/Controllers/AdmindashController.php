<?php

namespace App\Http\Controllers;
use App\Http\Services\AdmindashService;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdmindashController extends Controller
{
    private $AdmindashService;
    public function __construct(AdmindashService $AdmindashService)
    {
        $this->AdmindashService = $AdmindashService;
    }
    public function show()
    {
        $user = Auth::user();
        $users = $this->AdmindashService->getAllUsers();
        $colocations = $this->AdmindashService->getColocations($user);
        $createdcol = $this->AdmindashService->getAllCreatedColocations();
        $expenses = $this->AdmindashService->getAllExpenses();
        return view('admindash', compact('users', 'colocations', 'createdcol', 'expenses'));
    }

}
