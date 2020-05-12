<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Demandas;
use Faker\Generator as Faker;

$factory->define(Demandas::class, function (Faker $faker) {
    return [
        'titulo' => $faker->sentence(2),
        'descricao' => $faker->paragraph(1),
        'estado' => 'nova',
        'projeto_id' => 1,
        'user_id' => 1
    ];
});
