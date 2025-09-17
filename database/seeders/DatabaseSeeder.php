<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Setting::factory(1)->create();
        \App\Models\User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'role_id' => 1,
        ]);
        \App\Models\User::factory(19)->create();
        \App\Models\Category::factory(5)->create();
        \App\Models\Post::factory(50)->create();
        \App\Models\Page::factory(10)->create();
        \App\Models\Tag::factory(10)->create();

        if (
            class_exists(\App\Models\Service::class)
            && class_exists(\App\Models\Gallery::class)
            && Schema::hasTable('services')
            && Schema::hasTable('galleries')
        ) {
            \App\Models\Service::factory(5)
                ->create()
                ->each(function ($service) {
                    \App\Models\Gallery::factory(4)
                        ->for($service)
                        ->create();
                });
        }
    }
}
