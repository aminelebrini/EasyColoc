<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Services\CategorieService;

class CategorieController extends Controller
{
    private $CategorieService;

    public function __construct(CategorieService $CategorieService)
    {
        $this->CategorieService = $CategorieService;
    }
    public function CreateCategorie(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'colocation_id' => 'required|exists:colocations,id'
        ]);
        
        $categorie = $this->CategorieService->CreateCategorie($request->name, $request->colocation_id);

        if($categorie)
        {
            return redirect()->back()->with('success', 'The category has been successfully created !');
        }else{

            return redirect()->back()->with('error', "The category doesn't created");
        
        }
    }
}
