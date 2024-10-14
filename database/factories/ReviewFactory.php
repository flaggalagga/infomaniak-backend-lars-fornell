<?php

namespace Database\Factories;

use App\Models\Model;
use App\Models\Review;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReviewFactory extends Factory
{
    protected $model = Review::class;

    public function definition()
    {
        return [
            'author' => $this->faker->name,
            'body' => $this->faker->paragraph
        ];
    }
}
