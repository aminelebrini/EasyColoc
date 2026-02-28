<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Services\SettlementService; 

class SettlementContorller extends Controller
{
    private $SettlementService;

    public function __construct(SettlementService $SettlementService)
    {
        $this->SettlementService = $SettlementService;
    }

    public function Paying(Request $request)
    {
        $request->validate([
            'expense_id' => 'required|exists:expenses,id',
            'user_id'    => 'required|exists:users,id',
        ]);

        
            $settlements = $this->SettlementService->Paying(
                $request->expense_id,
                $request->user_id
            );

            if ($settlements) 
            {
                return redirect()->back()->with('success', 'Settlement successful');
            } else {
                return redirect()->back()->with('error', 'Settlement failed');
            }
            // dd($settlements);
    }
}
