<?php

namespace Database\Factories;

use App\Support\TextSanitizer;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Tag>
 */
class TagFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => TextSanitizer::sanitizedFrom(fn () => fake()->unique()->word()),
        ];
    }
}
