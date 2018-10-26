<?php

use Faker\Generator as Faker;

$factory->define(App\Section::class, function (Faker $faker) {
    return [
        "codigo_area" => $faker->unique()->numberBetween(1, 255),
        "nombre" => $faker->unique->numerify('Seccion ###'),
        "base_ip" => "192.168.",
        "registros_posibles" => 255
    ];
});
