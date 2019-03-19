<?php

use Faker\Generator as Faker;

$factory->define(App\Ip::class, function (Faker $faker) {
    return [
        "codigo_final" => 1,
        "estado" => 1,
    ];
});
