<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Gallery;
use App\Models\Service;

class GallerySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Garante que existem alguns serviços antes
        if (Service::count() === 0) {
            Service::factory(5)->create();
        }

        // Cria 20 imagens de galeria, ligadas a serviços
        Gallery::factory(20)->create();
    }
}
