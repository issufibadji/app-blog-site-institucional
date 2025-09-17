<?php

namespace Database\Factories;

use App\Support\TextSanitizer;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Setting>
 */
class SettingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'site_name' => TextSanitizer::sanitizedFrom(fn () => fake()->word()),
            'contact_email' => fake()->email(),
            'description' => TextSanitizer::sanitizedFrom(fn () => fake()->sentence()),
            'about' => TextSanitizer::sanitizedFrom(fn () => fake()->paragraph(1)),
            'copy_rights' => TextSanitizer::sanitizedFrom(fn () => fake()->sentence()),
            'url_fb' => fake()->url(),
            'url_twitter' => fake()->url(),
            'url_insta' => fake()->url(),
            'url_linkedin' => fake()->url(),
        ];
    }
}
