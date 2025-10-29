<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ModuleController extends Controller
{
    private $modules = [
        ['id' => 1, 'title' => 'Modul 1: Pengenalan'],
        ['id' => 2, 'title' => 'Modul 2: Dasar'],
        ['id' => 3, 'title' => 'Modul 3: Lanjutan'],
    ];

    public function index()
    {
        return response()->json($this->modules);
    }

public function complete($id, Request $request)
{
    $user = $request->user();

    // Tambah EXP dummy per modul
    $expGain = 10;
    $user->exp = ($user->exp ?? 0) + $expGain;

    // Simpan modul yang sudah diselesaikan
    $completedModules = $user->completed_modules ?? [];
    if (!in_array($id, $completedModules)) {
        $completedModules[] = $id;
    }
    $user->completed_modules = $completedModules;
    $user->save();

    return response()->json([
        'message' => "Modul $id selesai! EXP +$expGain",
        'total_exp' => $user->exp,
        'completed_modules' => $completedModules,
    ]);
}

}
