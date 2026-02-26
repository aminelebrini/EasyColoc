<?php
   
   namespace App\Http\Repository;

use App\Models\Categorie;

   class CategorieRepository
   {
       public function CreateCategorie($name)
       {
           $categorie = Categorie::create([
            'name' => $name
           ]);
       }
   }

?>