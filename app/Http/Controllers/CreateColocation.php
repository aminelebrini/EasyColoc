<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Services\CollocationService;

class CreateColocation extends Controller
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
        // dd($user);
        $colocation = $this->CollocationService->create_colocation($request->name, $request->number,$user);
        
        if($colocation)
        {
            return redirect()->route('memberspace')->with('succesfuly to create this colocation');
        } 
    }
}
