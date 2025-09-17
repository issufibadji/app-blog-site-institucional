<?php

namespace Database\Factories;

use App\Support\TextSanitizer;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $name = TextSanitizer::sanitizedFrom(fn () => fake()->unique()->word());
        $slug = str($name)->slug();
        return [
            'user_id' => rand(1,10),
            'name' => $name,
            'slug' => $slug,
        ];
    }
}
