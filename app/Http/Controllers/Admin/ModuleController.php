<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Module;
use Illuminate\Support\Facades\Log;
class ModuleController extends Controller
{
    public function index() {
        return Module::all();
    }



    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string',
            'slug' => 'required|string|unique:modules',
            'description' => 'nullable|string',
            'published' => 'sometimes|boolean',
        ]);

        // Pastikan published boolean
        $data['published'] = isset($data['published']) ? filter_var($data['published'], FILTER_VALIDATE_BOOLEAN) : false;

        $module = Module::create($data);

        return response()->json($module, 201);
    }


public function show($slug) {
    try {
        $module = Module::where('slug', $slug)->with('sections.questions')->firstOrFail();
        return response()->json($module);
    } catch (\Exception $e) {
        Log::error($e->getMessage());
        return response()->json(['error' => $e->getMessage()], 500);
    }
}


    public function update(Request $request, $slug) {
        $module = Module::where('slug', $slug)->firstOrFail();
        $data = $request->validate([
            'title' => 'sometimes|string',
            'description' => 'nullable|string',
            'published' => 'boolean'
        ]);
        $module->update($data);
        return response()->json($module);
    }

    public function destroy($slug) {
        $module = Module::where('slug', $slug)->firstOrFail();
        $module->delete();
        return response()->json(['message' => 'Module deleted']);
    }
}
