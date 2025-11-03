<?php

namespace App\Http\Controllers;

use App\Models\ModuleFillChallenge;
use Illuminate\Http\Request;
use App\Models\Module;
class ModuleFillChallengeController extends Controller
{
public function index($moduleId)
{
    $module = Module::findOrFail($moduleId);
    $challenges = ModuleFillChallenge::where('module_id', $moduleId)
        ->orderBy('order')
        ->get();

    return response()->json([
        'module' => $module,
        'challenges' => $challenges
    ]);
}


public function store(Request $request, $moduleId)
{
    $validated = $request->validate([
        'info' => 'required|string',
        'code' => 'required|string',
        'blanks' => 'required|array',
        'blanks.*' => 'required|string',
        'explanation' => 'nullable|string',
        'order' => 'nullable|integer',
        'language' => 'nullable|string', // opsional
    ]);

    $validated['module_id'] = $moduleId;
    $validated['language'] = $validated['language'] ?? 'cpp'; // default C++

    return ModuleFillChallenge::create($validated);
}

public function update(Request $request, $moduleId, ModuleFillChallenge $challenge)
{
    $validated = $request->validate([
        'info' => 'required|string',
        'code' => 'required|string',
        'blanks' => 'required|array',
        'blanks.*' => 'required|string',
        'explanation' => 'nullable|string',
        'order' => 'nullable|integer',
        'language' => 'nullable|string',
    ]);

    $validated['language'] = $validated['language'] ?? 'cpp';

    $challenge->update($validated);
    return $challenge;
}


    public function show($moduleId, ModuleFillChallenge $challenge)
    {
        return $challenge;
    }

    public function destroy($moduleId, ModuleFillChallenge $challenge)
    {
        $challenge->delete();
        return response()->json(['message' => 'Deleted successfully']);
    }
}
