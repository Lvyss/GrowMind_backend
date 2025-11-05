<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ModuleSectionQuestion;
use Illuminate\Http\Request;
use App\Models\ModuleSection;
class ModuleSectionQuestionController extends Controller
{
public function index($sectionId)
{
    $section = ModuleSection::findOrFail($sectionId);

    $questions = ModuleSectionQuestion::where('section_id', $sectionId)
        ->orderBy('order')
        ->get();

    return response()->json([
        'section' => $section,
        'questions' => $questions
    ]);
}


public function store(Request $request, $sectionId)
{
    $section = ModuleSection::findOrFail($sectionId);

    $data = $request->validate([
        'instruction' => 'nullable|string',
        'template' => 'required|string', // teks soal dengan ___
        'answers' => 'required|array',   // jawaban berupa array
        'points' => 'nullable|integer',
        'order' => 'nullable|integer',
    ]);

    $nextOrder = ModuleSectionQuestion::where('section_id', $sectionId)->count() + 1;

    $question = ModuleSectionQuestion::create([
        'section_id' => $sectionId,
        'type' => 'fill_code', // fixed
        'instruction' => $data['instruction'] ?? null,
        'template' => $data['template'],
        'answers' => json_encode($data['answers']), // simpan JSON
        'points' => $data['points'] ?? 1,
        'order' => $data['order'] ?? $nextOrder,
    ]);

    return response()->json([
        'message' => 'Question created!',
        'question' => $question,
    ], 201);
}


    public function show($sectionId)
    {
        return ModuleSectionQuestion::findOrFail($sectionId);
    }

    public function update(Request $request, $sectionId)
    {
        $question = ModuleSectionQuestion::findOrFail($sectionId);
        $question->update($request->all());
        return response()->json($question);
    }

    public function destroy($sectionId)
    {
        ModuleSectionQuestion::findOrFail($sectionId)->delete();
        return response()->json(['message' => 'Deleted']);
    }
}
