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


class QuizController extends Controller
{
    protected $expService;


    public function __construct(ExperienceService $expService)
    {
        $this->expService = $expService;
    }


    public function start($quizId)
    {
        $quiz = Quiz::with('questions.options')->findOrFail($quizId);
        // For simplicity, return quiz payload to frontend
        return response()->json($quiz);
    }


    public function submit(Request $req, $quizId)
    {
        $user = $req->user();
        $quiz = Quiz::with('questions')->findOrFail($quizId);
        $answers = $req->input('answers', []); // [question_id => answer]


        $correct = 0;
        $total = $quiz->questions->count();


        foreach ($quiz->questions as $q) {
            $given = $answers[$q->id] ?? null;
            if ($given !== null && trim(strtolower($given)) == trim(strtolower($q->correct_answer))) {
                $correct++;
            }
        }


        $score = (int) round(($correct / max(1, $total)) * 100);
        $exp = (int) round(($score / 100) * 100); // up to 100 EXP per quiz


        // save progress
        UserProgress::create([
            'user_id' => $user->id,
            'module_id' => $quiz->module_id,
            'lesson_id' => null,
            'is_completed' => true,
            'score' => $score,
            'exp_earned' => $exp,
        ]);


        // award exp
        $this->expService->awardExp($user, $exp, 'quiz_complete');


        return response()->json(['score' => $score, 'exp' => $exp]);
    }
}
