<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Services\BanService;

class BanController extends Controller
{
    private $BanService;

    public function __construct(BanService $BanService)
    {
        $this->BanService = $BanService;
    }

    public function banuser(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
        ]);

        $result = $this->BanService->banuser($request->email);

        if ($result) {
            return redirect()->back()->with('success', "L'utilisateur a été banni avec succès.");
        } else {
            return redirect()->back()->with('error', "Échec du bannissement de l'utilisateur.");
        }
    }

    public function debanuser(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
        ]);

        $result = $this->BanService->debanuser($request->email);

        if ($result) {
            return redirect()->back()->with('success', "L'utilisateur a été débanni avec succès.");
        } else {
            return redirect()->back()->with('error', "Échec de la levée du bannissement.");
        }
    }
}
