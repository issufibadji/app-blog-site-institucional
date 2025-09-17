<?php

namespace Database\Factories;

use App\Models\Gallery;
use App\Models\Service;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Gallery>
 */
class GalleryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var class-string<\Illuminate\Database\Eloquent\Model>
     */
    protected $model = Gallery::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $title = fake()->sentence(4);

        return [
            'service_id' => class_exists(Service::class) ? Service::factory() : null,
            'title' => $title,
            'description' => fake()->paragraph(),
            'image' => 'portfolio/' . fake()->uuid() . '.jpg',
        };
    }
}
