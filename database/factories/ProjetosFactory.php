<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Projetos;
use Faker\Generator as Faker;

$factory->define(Projetos::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
        'descricao' => $faker->paragraph(1),
    ];
});
