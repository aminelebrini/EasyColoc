<?php
namespace App\Http\Services;
use App\Http\Repository\BanRepository;

class BanService
{
    protected $BanRepository;

    public function __construct(BanRepository $BanRepository)
    {
        $this->BanRepository = $BanRepository;
    }

    public function banuser($email)
    {
        return $this->BanRepository->banuer($email);
    }

    public function debanuser($email)
    {
        return $this->BanRepository->debanuer($email);
    }
}

?>