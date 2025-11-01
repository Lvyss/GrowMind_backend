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
| ProfileController
|--------------------------------------------------------------------------
*/

class ProfileController extends Controller
{
public function show(Request $request) {
    return response()->json([
        'user' => $request->user(),         // info user
        'profile' => $request->user()->profile // info profil
    ]);
}



    public function update(Request $req)
    {
        $profile = $req->user()->profile;
        $profile->update($req->only(['bio', 'avatar']));
        return response()->json($profile);
    }
}
