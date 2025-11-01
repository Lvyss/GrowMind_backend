<?php

namespace Database\Seeders;


use Illuminate\Database\Seeder;
use App\Models\Module;
use App\Models\Lesson;
use App\Models\Quiz;
use App\Models\QuizQuestion;
use App\Models\QuizOption;
use App\Models\Achievement;


class DatabaseSeeder extends Seeder
{
public function run()
{
$mod = Module::create([
'title'=>'Belajar Dasar Algoritma',
'slug'=>'algoritma-dasar',
'description'=>'Pengantar algoritma untuk pemula',
'thumbnail'=>'/images/modules/algoritma.png',
'difficulty'=>'beginner',
'theme'=>'forest',
]);


$l1 = Lesson::create(['module_id'=>$mod->id,'title'=>'Pengenalan Algoritma','content'=>'<p>Konten...</p>','order'=>1]);
$l2 = Lesson::create(['module_id'=>$mod->id,'title'=>'Flowchart & Pseudocode','content'=>'<p>Konten...</p>','order'=>2]);


$quiz = Quiz::create(['module_id'=>$mod->id,'title'=>'Quiz Algoritma','description'=>'Uji pemahaman dasar']);


$q1 = QuizQuestion::create(['quiz_id'=>$quiz->id,'question'=>'Apa itu algoritma?','type'=>'fill','correct_answer'=>'urutan langkah penyelesaian masalah']);


Achievement::create(['title'=>'Starter','description'=>'Selesaikan 1 module','exp_reward'=>50,'icon'=>'starter.png']);
}
}