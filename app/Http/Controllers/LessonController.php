<?php


namespace App\Http\Controllers;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\Profile;
use App\Models\Module;
use App\Models\Lesson;
use App\Models\Quiz;
use App\Models\QuizQuestion;
use App\Models\QuizOption;
use App\Models\UserProgress;
use App\Models\Achievement;
use App\Models\UserAchievement;
use App\Services\ExperienceService;
/*
|--------------------------------------------------------------------------
| LessonController
|--------------------------------------------------------------------------
*/
class LessonController extends Controller
{
protected $expService;


public function __construct(ExperienceService $expService)
{
$this->expService = $expService;
}


public function show($id)
{
$lesson = Lesson::findOrFail($id);
return response()->json($lesson);
}


// mark lesson completed -> award EXP
public function complete(Request $req, $id)
{
$user = $req->user();
$lesson = Lesson::findOrFail($id);


// create/update progress
$progress = UserProgress::firstOrCreate([
'user_id'=>$user->id,
'module_id'=>$lesson->module_id,
'lesson_id'=>$lesson->id,
], ['is_completed'=>false, 'exp_earned'=>0]);


if ($progress->is_completed) return response()->json(['message'=>'Already completed']);


// default exp per lesson (can be adjusted)
$exp = 20;
$progress->update(['is_completed'=>true, 'exp_earned'=>$exp]);


// award exp via service
$this->expService->awardExp($user, $exp, "lesson_complete");


return response()->json(['message'=>'Lesson completed','exp'=>$exp]);
}
}