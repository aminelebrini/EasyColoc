<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Services\CollocationService;
use Illuminate\Support\Facades\Auth;


class ColocationController extends Controller
{
    private $CollocationService;

    public function __construct(CollocationService $CollocationService)
    {
        $this->CollocationService = $CollocationService;
    }
    public function create_colocation(Request $request)
    {
        $request->validate([
            'name' => 'required | string',
            'number' => 'required|integer|max:5'
        ]);
        $user = Auth::user()->id;
        $colocation = $this->CollocationService->create_colocation($request->name, $request->number,$user);
        
        if($colocation)
        {
            return redirect()->back()->with('succesfuly to create this colocation');
        } 
    }

    public function leave_colocation(Request $request)
    {
        $request->validate([
            'colocation_id' => 'required|exists:colocations,id',
            'user_id' => 'required|exists:users,id'
        ]);

        $leave = $this->CollocationService->leave_colocation($request->colocation_id, $request->user_id);

        if($leave)
        {
            return redirect()->route('userspace')->with('success', 'You have successfully left the colocation');
        }
        else{
            return redirect()->back()->with('error', 'Failed to leave the colocation');
        }
    }
}
