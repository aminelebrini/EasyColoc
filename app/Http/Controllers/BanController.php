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
            return redirect()->back()->with('success', 'User banned successfully.');
        } else {
            return redirect()->back()->with('error', 'Failed to ban user.');
        }
    }

    public function debanuser(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
        ]);

        $result = $this->BanService->debanuser($request->email);

        if ($result) {
            return redirect()->back()->with('success', 'User unbanned successfully.');
        } else {
            return redirect()->back()->with('error', 'Failed to unban user.');
        }
    }
}
