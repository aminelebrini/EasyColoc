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
            'name' => 'required|string'
        ]);

        $categorie = $this->CategorieService->CreateCategorie($name);

        if($categorie)
        {
            return redirect()->route('/userspace')->with('success', 'The category has been successfully created !');
        }
    }
}
