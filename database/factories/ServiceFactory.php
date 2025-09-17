<?php

namespace Database\Factories;

use App\Models\Service;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Service>
 */
class ServiceFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var class-string<\Illuminate\Database\Eloquent\Model>
     */
    protected $model = Service::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $title = fake()->unique()->sentence(3);

        return [
            'title' => $title,
            'description' => fake()->paragraph(3),
            'icon' => fake()->randomElement([
                'fa-solid fa-chart-line',
                'fa-solid fa-lightbulb',
                'fa-solid fa-shield-halved',
                'fa-solid fa-users',
                'fa-solid fa-mobile-screen',
                'fa-solid fa-gears',
            ]),
            'image' => 'services/' . fake()->uuid() . '.jpg',
        };
    }
}
