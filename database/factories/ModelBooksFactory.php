<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;
use App\Model\Books;
use App\Model\Authors;


$factory->define(\App\Model\Books::class, function (Faker $faker) {
    return [
        'authors' =>[$faker->name],
        'name' => $faker->sentence($nbWords = 3,  $variableNbWords = true),
        'isbn' => $faker->numerify("###").'-'.$faker->numerify("##########"),
        'number_of_pages' => $faker->numberBetween(250, 600),
        'publisher' => $faker->sentence($nbWords =3,  $variableNbWords = true),
        'country' => $faker->country,
        'release_date' => $faker->date('Y-m-d', 'now'),
    ];
});
