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

class TreeController extends Controller
{
    public function stats(Request $req)
    {
        $profile = $req->user()->profile;
        return response()->json([
            'level' => $profile->level,
            'exp' => $profile->exp,
            'tree_stage' => $profile->tree_stage,
            'tree_points' => $profile->tree_points,
        ]);
    }
}
