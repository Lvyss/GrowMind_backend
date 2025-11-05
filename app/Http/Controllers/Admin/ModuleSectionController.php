<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ModuleSection;
use App\Models\Module;
class ModuleSectionController extends Controller
{
public function store(Request $request, $slug)
{
    $module = Module::where('slug', $slug)->firstOrFail();

    $data = $request->validate([
        'title' => 'required|string',
        'order' => 'integer',
        'content' => 'nullable|json',
        'xp_reward' => 'integer'
    ]);

    $data['module_id'] = $module->id;

    $section = ModuleSection::create($data);
    return response()->json($section, 201);
}

public function show($id)
{
    $section = ModuleSection::findOrFail($id);
    return response()->json($section);
}


    public function update(Request $request, $id) {
        $section = ModuleSection::findOrFail($id);
        $data = $request->validate([
            'title' => 'sometimes|string',
            'order' => 'integer',
            'content' => 'nullable|json',
            'xp_reward' => 'integer'
        ]);
        $section->update($data);
        return response()->json($section);
    }

    public function destroy($id) {
        $section = ModuleSection::findOrFail($id);
        $section->delete();
        return response()->json(['message' => 'Section deleted']);
    }
}
