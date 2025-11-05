<?php

namespace App\Http\Controllers;

use App\Models\ModuleSection;
use App\Models\UserSectionProgress;
use Illuminate\Http\Request;
use App\Models\ModuleSectionQuestion;

class SectionProgressController extends Controller
{
    public function index($moduleId)
    {
        $user = auth()->user();

        $sections = ModuleSection::where('module_id', $moduleId)
            ->orderBy('order')
            ->get();

        $progress = UserSectionProgress::where('user_id', $user->id)->get()
            ->keyBy('section_id');

        $unlocked = true;
        $result = [];

        foreach ($sections as $section) {
            $completed = isset($progress[$section->id]) && $progress[$section->id]->completed;

            $result[] = [
                'id' => $section->id,
                'title' => $section->title,
                'order' => $section->order,
                'xp_reward' => $section->xp_reward,
                'completed' => $completed,
                'locked' => !$unlocked,
            ];

            if (!$completed) {
                $unlocked = false;
            }
        }

        return response()->json($result);
    }

    public function show($sectionId)
{
    $user = auth()->user();

    $section = ModuleSection::findOrFail($sectionId);

    $questions = ModuleSectionQuestion::where('section_id', $sectionId)
        ->orderBy('order')
        ->get(['id','instruction','template','answers','order']);

    $progress = UserSectionProgress::where('user_id', $user->id)
        ->where('section_id', $sectionId)
        ->first();

    return response()->json([
        'section' => $section,
        'questions' => $questions,
        'completed' => $progress ? $progress->is_completed : false,
    ]);
}

   public function submit(Request $request, $sectionId)
{
    $user = auth()->user();
    $section = ModuleSection::with('questions')->findOrFail($sectionId);

    $progress = UserSectionProgress::where('user_id', $user->id)
        ->where('section_id', $sectionId)
        ->first();

    if ($progress && $progress->completed) {
        return response()->json(['message' => 'Already completed'], 400);
    }

    $answers = $request->answers ?? [];

    // ✅ normalize answers [["0"],["5"]] => ["0","5"]
    $answers = array_map(function ($a) {
        return is_array($a) ? ($a[0] ?? null) : $a;
    }, $answers);

    foreach ($section->questions as $i => $q) {
        $correct = strtolower(trim($q->answers[0] ?? "")); 
        $userAns = strtolower(trim($answers[$i] ?? ""));

        if ($correct !== $userAns) {
            return response()->json([
                'status' => 'wrong',
                'message' => 'Jawaban salah, coba lagi!'
            ]);
        }
    }

    UserSectionProgress::updateOrCreate(
        ['user_id' => $user->id, 'section_id' => $sectionId],
        ['completed' => true, 'completed_at' => now()]
    );

    if ($user->profile) {
    $user->profile->increment('exp', $section->xp_reward);
} else {
    $user->profile()->create([
        'exp' => $section->xp_reward,
        'level' => 1,
        'tree_stage' => 1,
        'tree_points' => 0,
    ]);
}


    return response()->json([
        'status' => 'correct',
        'message' => 'Benar! Section unlocked!',
    ]);
}
}
