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
            return redirect()->back()->with('success', 'La catégorie a été créée avec succès !');
        }else{

            return redirect()->back()->with('error', "Erreur lors de la création de la catégorie.");
        
        }
    }
}
