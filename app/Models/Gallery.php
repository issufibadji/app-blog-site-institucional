<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Gallery extends Model
{
    use HasFactory;

    /**
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'image_path',
        'description',
        'service_id',
    ];

    /**
     * @var array<int, string>
     */
    protected $appends = [
        'image_url',
    ];

    /**
     * Get the related service.
     */
    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    /**
     * Scope a query to eager load the service relation.
     */
    public function scopeWithService(Builder $query): Builder
    {
        return $query->with('service:id,title');
    }

    /**
     * Accessor for the public image url.
     */
    public function getImageUrlAttribute(): string
    {
        $path = $this->image_path;

        if (is_null($path) || $path === '') {
            return asset('import/assets/post-pic-dummy.png');
        }

        if (filter_var($path, FILTER_VALIDATE_URL)) {
            return $path;
        }

        $normalizedPath = str_replace('\\', '/', $path);
        $normalizedPath = ltrim($normalizedPath, '/');

        $prefixesToStrip = [
            'public/',
            'storage/public/',
            'storage/app/public/',
        ];

        foreach ($prefixesToStrip as $prefix) {
            if (str_starts_with($normalizedPath, $prefix)) {
                $normalizedPath = substr($normalizedPath, strlen($prefix));
            }
        }

        if (str_starts_with($normalizedPath, 'storage/')) {
            $publicPath = public_path($normalizedPath);
            if (file_exists($publicPath)) {
                return asset($normalizedPath);
            }

            $normalizedPath = ltrim(substr($normalizedPath, strlen('storage/')), '/');
        }

        if (Storage::disk('public')->exists($normalizedPath)) {
            return Storage::disk('public')->url($normalizedPath);
        }

        if (file_exists(public_path($normalizedPath))) {
            return asset($normalizedPath);
        }

        $publicStoragePath = 'storage/' . ltrim($normalizedPath, '/');
        if (file_exists(public_path($publicStoragePath))) {
            return asset($publicStoragePath);
        }

        return asset('import/assets/post-pic-dummy.png');
    }

    /**
     * Boot model events.
     */
    protected static function booted(): void
    {
        static::updating(function (Gallery $gallery): void {
            if ($gallery->isDirty('image_path') && !is_null($gallery->getRawOriginal('image_path'))) {
                Storage::disk('public')->delete($gallery->getRawOriginal('image_path'));
            }
        });

        static::deleting(function (Gallery $gallery): void {
            if (!is_null($gallery->getRawOriginal('image_path'))) {
                Storage::disk('public')->delete($gallery->getRawOriginal('image_path'));
            }
        });
    }
}
