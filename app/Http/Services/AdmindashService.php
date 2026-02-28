<?php
 
 namespace App\Http\Services;

 use App\Http\Repository\AdmindashRepository;

    class AdmindashService
    {
        private $AdmindashRepository;
    
        public function __construct(AdmindashRepository $AdmindashRepository)
        {
            $this->AdmindashRepository = $AdmindashRepository;
        }
    
        public function getAllUsers()
        {
            return $this->AdmindashRepository->getAllUsers();
        }
    
        public function getColocations($user)
        {
            return $this->AdmindashRepository->getColocations($user);
        }
    
        public function getAllExpenses()
        {
            return $this->AdmindashRepository->getAllExpenses();
        }
        public function getAllCreatedColocations()
        {
            return $this->AdmindashRepository->getAllCreatedColocations();
        }
    }


?>