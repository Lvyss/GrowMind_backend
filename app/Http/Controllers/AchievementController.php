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

class AchievementController extends Controller
{
    public function list()
    {
        return response()->json(Achievement::all());
    }


    public function claim(Request $req, $id)
    {
        $user = $req->user();
        $ach = Achievement::findOrFail($id);


        // check already
        if ($user->achievements()->where('achievement_id', $id)->exists()) {
            return response()->json(['message' => 'Already claimed']);
        }


        UserAchievement::create(['user_id' => $user->id, 'achievement_id' => $id, 'earned_at' => now()]);


        // award exp
        app(ExperienceService::class)->awardExp($user, $ach->exp_reward, 'achievement');


        return response()->json(['message' => 'Achievement claimed', 'exp' => $ach->exp_reward]);
    }
}
