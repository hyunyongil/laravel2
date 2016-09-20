<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(App\User::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->safeEmail,
        'password' => bcrypt(str_random(10)),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Project::class, function (Faker\Generator $faker) {
    // 집계함수를 사용하여 id 의 최소, 최대값을 가져옴
    $min = App\User::min('id');
    $max = App\User::max('id');
    return [
        'user_id' => $faker->numberBetween($min, $max),
        'name' => $faker->word,       
        'created_at' => $faker->dateTimeBetween($startDate = '-2 years', $endDate = '-1 years'),
        'updated_at' => $faker->dateTimeBetween($startDate = '-1 years', $endDate = 'now'),
    ];
});

$factory->define(App\Task::class, function (Faker\Generator $faker) {
    $min = App\Project::min('id');    
    $max = App\Project::max('id');
    return [
        'project_id' => $faker->numberBetween($min, $max),
        'name' => $faker->sentence,
        'description' => $faker->text,
        'created_at' => $faker->dateTimeBetween($startDate = '-2 years', $endDate = '-1 years'),
        'updated_at' => $faker->dateTimeBetween($startDate = '-1 years', $endDate = 'now'),
        'due_date' => $faker->dateTimeBetween($startDate = '-2 weeks', $endDate = '+1 months'),
    ];
});
$factory->define(App\Profile::class, function (Faker\Generator $faker) {
    $min = App\User::min('id');    
    $max = App\User::max('id');
    return [
        'user_id' => $faker->numberBetween($min, $max),
        'email' => $faker->safeEmail,
        'phone' => $faker->tollFreePhoneNumber,
        'website' => 'www.'.$faker->word.'.com',
        'created_at' => $faker->dateTimeBetween($startDate = '-2 years', $endDate = '-1 years'),
        'updated_at' => $faker->dateTimeBetween($startDate = '-1 years', $endDate = 'now'),
    ];
});

$factory->define(App\Role::class, function ($faker) {
    $role = ['guest', 'reporter', 'developer', 'owner', 'master'];
    $num = $faker->numberBetween(0, 4);
    return [
        'name' => $role[$num] . $num,  
        'created_at' => $faker->dateTimeBetween($startDate = '-2 years', $endDate = '-1 years'),
        'updated_at' => $faker->dateTimeBetween($startDate = '-1 years', $endDate = 'now'),
    ];
});

$factory->define(App\RoleUser::class, function ($faker) {
    $user_id_min = App\User::min('id');
    $user_id_max = App\User::max('id');
    $role_id_min = App\Role::min('id');
    $role_id_max = App\Role::max('id');
    return [
        'user_id' => $faker->numberBetween($user_id_min, $user_id_max),
        'role_id' => $faker->numberBetween($role_id_min, $role_id_max),
        'created_at' => $faker->dateTimeBetween($startDate = '-2 years', $endDate = '-1 years'),
        'updated_at' => $faker->dateTimeBetween($startDate = '-1 years', $endDate = 'now'),
    ];
});

$factory->define(App\Product::class, function ($faker) {
    
    return [
        'name' => $faker->sentence,
        'price' => $faker->randomNumber(5),  
        'created_at' => $faker->dateTimeBetween($startDate = '-2 years', $endDate = '-1 years'),
        'updated_at' => $faker->dateTimeBetween($startDate = '-1 years', $endDate = 'now'),
    ];
});

$factory->define(App\Picture::class, function ($faker) {
    
 if (rand(0,1) == 0) :
        $type = 'App\User';
        $min = App\User::min('id');
        $max = App\User::max('id');
   else :
        $type = 'App\Product';
        $min = App\Product::min('id');
        $max = App\Product::max('id');
   endif;
    
   return [
        'title' => $faker->text,
        'path' => $faker->image($dir = 'storage', $width = 640, $height = 480) ,
        'imageable_id' => $faker->numberBetween($min, $max),  
        'imageable_type' =>  $type,
        'created_at' => $faker->dateTimeBetween($startDate = '-2 years', $endDate = '-1 years'),
        'updated_at' => $faker->dateTimeBetween($startDate = '-1 years', $endDate = 'now'),
    ];
});