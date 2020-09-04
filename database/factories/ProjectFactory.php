<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Project;
use Faker\Generator as Faker;

$factory->define(Project::class, function (Faker $faker) {
    return [
        'title'=> $faker->sentence(4),      //create a title with 4 words in a sentence...
        'description'=> $faker->paragraph(4),
        'owner_id'=> factory(App\User::class)
    ];
});
