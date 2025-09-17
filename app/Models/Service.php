<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Service extends Model
{
    use HasFactory;

    /**
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'icon',
        'description',
        'slug',
        'order',
    ];

    /**
     * @var array<string, string>
     */
    protected $casts = [
        'order' => 'integer',
    ];

    /**
     * Boot the model.
     */
    protected static function booted(): void
    {
        static::creating(function (Service $service): void {
            $service->slug = static::generateSlug($service);
        });

        static::updating(function (Service $service): void {
            $service->slug = static::generateSlug($service, $service->id);
        });
    }

    /**
     * Define the relationship with the gallery images.
     */
    public function galleries()
    {
        return $this->hasMany(Gallery::class);
    }

    /**
     * Scope a query to order services by the order column.
     */
    public function scopeOrdered(Builder $query): Builder
    {
        return $query->orderBy('order')->orderBy('title');
    }

    /**
     * Scope a query to filter a specific slug.
     */
    public function scopeWithSlug(Builder $query, string $slug): Builder
    {
        return $query->where('slug', $slug);
    }

    /**
     * Generate a unique slug for the service.
     */
    protected static function generateSlug(Service $service, ?int $ignoreId = null): string
    {
        $slugSource = $service->slug ?: $service->title;
        $baseSlug = Str::slug($slugSource);
        $slug = $baseSlug;
        $counter = 1;

        while (static::query()
            ->when($ignoreId, fn (Builder $query) => $query->whereKeyNot($ignoreId))
            ->where('slug', $slug)
            ->exists()) {
            $slug = $baseSlug . '-' . $counter;
            $counter++;
        }

        return $slug;
    }
}
