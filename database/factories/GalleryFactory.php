<?php

namespace Database\Factories;

use App\Models\Gallery;
use App\Models\Service;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\File;

class GalleryFactory extends Factory
{
    protected $model = Gallery::class;

    public function definition()
    {
        $title = fake()->sentence(4);

        $filename = fake()->uuid() . '.jpg';
        $filePath = storage_path('app/public/galleries/' . $filename);

        // Garante que a pasta existe
        if (!is_dir(dirname($filePath))) {
            mkdir(dirname($filePath), 0755, true);
        }

        try {
            // Contexto para ignorar SSL em dev
            $context = stream_context_create([
                "ssl" => [
                    "verify_peer"      => false,
                    "verify_peer_name" => false,
                ],
            ]);

            $imageContent = file_get_contents('https://picsum.photos/640/480', false, $context);

            // Se conseguiu baixar a imagem, salva
            if ($imageContent !== false) {
                File::put($filePath, $imageContent);
            } else {
                // fallback: cria arquivo vazio
                File::put($filePath, '');
            }
        } catch (\Exception $e) {
            // fallback em caso de erro
            File::put($filePath, '');
        }

        return [
            'service_id'  => class_exists(Service::class) ? Service::factory() : null,
            'title'       => $title,
            'description' => fake()->paragraph(),
            'image_path'  => 'galleries/' . $filename,
        ];
    }
}
