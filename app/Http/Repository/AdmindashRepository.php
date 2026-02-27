<?php
  
  namespace App\Http\Repository;

    use App\Models\User;
    use App\Models\Colocation;
    use App\Models\Expense;
    use Illuminate\Support\Facades\DB;

    class AdmindashRepository
    {
        public function getAllUsers()
        {
            return User::all();
        }
    
        public function getAllColocations()
        {
            return Colocation::all();
        }
    
        public function getAllExpenses()
        {
            return Expense::all();
        }
        public function getAllCreatedColocations()
        {
            return DB::table('memberships')->join('colocations', 'memberships.colocation_id', '=', 'colocations.id')
            ->join('users', 'memberships.member_id', '=', 'users.id')
            ->where('memberships.role', 'owner')
            ->select('colocations.*', 'users.firstname', 'users.lastname')->get();
        }
    }


?>