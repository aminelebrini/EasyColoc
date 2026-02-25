<?php

namespace App\Http\Controllers;

use App\Http\Services\ExpenseService;

use Illuminate\Http\Request;

class ExpenseController extends Controller
{
    private $ExpenseService;

    public function __construct(ExpenseService $ExpenseService)
    {
        $this->ExpenseService = $ExpenseService;
    }

    public function create_expense()
    {
        $expences = $this->ExpenseService->create_expense();
        if($expences)
        {
            return redirect()->route('memberspace')->with('succesfuly to create this expence');
        }
    }
}
