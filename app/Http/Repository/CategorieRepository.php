<?php
   
   namespace App\Http\Repository;

use App\Models\Categorie;

   class CategorieRepository
   {
       public function CreateCategorie($name, $colocationId)
       {
           $categorie = Categorie::create([
            'name' => $name,
            'colocation_id' => $colocationId,
            'created_at' => now(),
            'updated_at' => now(),
           ]);

           $categorie->save();

           return $categorie;
       }
   }

?>