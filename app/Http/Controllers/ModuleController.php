<?php

namespace App\Http\Controllers;

use App\Models\Module;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ModuleController extends Controller
{
    // list modules
    public function index()
    {
        return Module::select('id','title','slug','status','created_at')->get();
    }

    // create module
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'content' => 'nullable',
            'status' => 'required|in:draft,published'
        ]);

        $slug = Str::slug($request->title);

        // ensure unique slug
        if (Module::where('slug',$slug)->exists()) {
            $slug .= '-' . time();
        }

        $module = Module::create([
            'title' => $request->title,
            'slug' => $slug,
            'content' => $request->content,
            'status' => $request->status
        ]);

        return response()->json($module, 201);
    }

    // show single module by slug
    public function show($slug)
    {
        return Module::where('slug', $slug)->firstOrFail();
    }

    // update module
    public function update(Request $request, $slug)
    {
        $module = Module::where('slug', $slug)->firstOrFail();

        $request->validate([
            'title' => 'required|string',
            'content' => 'nullable',
            'status' => 'required|in:draft,published'
        ]);

        $newSlug = Str::slug($request->title);

        // unique check if title changed
        if ($newSlug !== $slug && Module::where('slug',$newSlug)->exists()) {
            $newSlug .= '-' . time();
        }

        $module->update([
            'title' => $request->title,
            'slug' => $newSlug,
            'content' => $request->content,
            'status' => $request->status
        ]);

        return response()->json($module);
    }

    // delete
    public function destroy($slug)
    {
        $module = Module::where('slug',$slug)->firstOrFail();
        $module->delete();

        return response()->json(['message' => 'Module deleted']);
    }

    // Method untuk user melihat semua modul publik
public function userModules() {
    $modules = Module::where('status', 'published')->get(); // hanya modul published
    return response()->json($modules);
}

// Method untuk user melihat detail modul
public function userModule($slug) {
    $module = Module::with('challenges') // ambil semua challenge terkait
                    ->where('slug', $slug)
                    ->where('status', 'published')
                    ->firstOrFail();
    return response()->json($module);
}

}
