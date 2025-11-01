<?php

namespace App\Services;


use App\Models\User;
use App\Models\Profile;


class ExperienceService
{
// formula: exp_needed = level * 150
public function expNeededForLevel(int $level): int
{
return $level * 150;
}


// award exp to user and handle level-up
public function awardExp(User $user, int $exp, string $source = null)
{
$profile = $user->profile;
if (!$profile) {
$profile = Profile::create(['user_id'=>$user->id]);
}


$profile->exp += $exp;
$profile->tree_points += $exp; // points used for visual growth milestones


// level up loop
$leveled = false;
while ($profile->exp >= $this->expNeededForLevel($profile->level + 1)) {
$profile->level += 1;
$leveled = true;


// optionally reduce exp or keep cumulative depending on design
// keep cumulative: do nothing else
}


// update tree_stage based on level
$profile->tree_stage = $this->calculateTreeStage($profile->level);
$profile->save();


return ['leveled' => $leveled, 'level'=>$profile->level];
}


protected function calculateTreeStage(int $level): int
{
if ($level <= 1) return 1; // seed
if ($level == 2) return 2; // sprout
if ($level == 3) return 3; // young
if ($level == 4) return 4; // strong
return 5; // wise/golden
}
}