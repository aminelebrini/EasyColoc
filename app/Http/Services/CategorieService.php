<?php
  
  namespace App\Http\Services;

  use App\Http\Repository\CategorieRepository;

  class CategorieService
  {
        private $CategorieRepository;
        public function __construct(CategorieRepository $CategorieRepository)
        {
            $this->CategorieRepository = $CategorieRepository;
        }

        public function CreateCategorie($name)
        {
            return $this->CategorieRepository->CreateCategorie($name);
        }

  }

?>