<?php

use App\Entities\Course;
use App\Enums\CourseStatus;
use Illuminate\Support\Arr;

/* @var LaravelDoctrine\ORM\Testing\Factory $factory */
$factory->define(Course::class, function (Faker\Generator $faker, array $attributes) {
    $id = Arr::get($attributes, 'id');
    $num = Arr::get($attributes, 'num', 1);
    $status = Arr::get($attributes, 'status', $faker->randomElement(CourseStatus::cases()));
    $isPremium = Arr::get($attributes, 'isPremium', $faker->boolean);
    $createdAt = Arr::get($attributes, 'createdAt', new DateTime());

    return [
        'id' => $id,
        'title' => sprintf('Test Title %d', $num),
        'description' => sprintf('Test Description %d', $num),
        'status' => $status,
        'isPremium' => $isPremium,
        'createdAt' => $createdAt,
    ];
});
