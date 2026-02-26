<?php

namespace App\Http\Controllers;

use App\Http\Services\ExpenseService;
use Illuminate\Support\Facades\Auth;


use Illuminate\Http\Request;

class ExpenseController extends Controller
{
    private $ExpenseService;

    public function __construct(ExpenseService $ExpenseService)
    {
        $this->ExpenseService = $ExpenseService;
    }

    public function create_expense(Request $request)
    {
        $user = Auth::user()->id;
        $request->validate([
            'colocation_id' => 'required|exists:colocations,id',
            'categories_id' => 'required|exists:categories,id', 
            'amount'        => 'required|numeric|min:0.01',
            'description'   => 'required|string',  
        ]);

        $expences = $this->ExpenseService->create_expense($user,$request->categories_id, $request->amount,$request->colocation_id, $request->description);
        
        if($expences)
        {
            return redirect()->back()->with('success', 'succesfuly to create this expence !');
        }
        else{
            return redirect()->back()->with('error', "expence doesn't created !");   
        }
    }
}
