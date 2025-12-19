<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Post extends Model implements HasMedia // <-- add this
{
    use InteractsWithMedia;

    protected $fillable = [
        'category_id',
        'title',
        'slug',
        'excerpt',
        'content',
        'status', // remove 'featured_image' from fillable when using MediaLibrary
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

//    public function registerMediaConversions(\Spatie\MediaLibrary\MediaCollections\Models\Media $media = null): void
//    {
//        $this->addMediaConversion('thumb')
//            ->width(300)
//            ->height(200)
//            ->sharpen(10);
//    }

    public function registerMediaConversions(\Spatie\MediaLibrary\MediaCollections\Models\Media $media = null): void
    {
        $this->addMediaConversion('thumb')
            ->width(368)
            ->height(232)
            ->sharpen(10);

        $this->addMediaConversion('optimized')
            ->width(1920)
            ->height(1080)
            ->quality(80)
            ->optimize()
            ->withResponsiveImages();

        // Optional: Add a webp conversion for better performance
        $this->addMediaConversion('webp')
            ->format('webp')
            ->quality(80)
            ->width(1920)
            ->height(1080);
    }

    // Optional: Also update registerMediaCollections if you have it
    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('featured_images')
            ->singleFile()
            ->acceptsMimeTypes(['image/jpeg', 'image/png', 'image/webp', 'image/gif']);

        $this->addMediaCollection('post_images')
            ->acceptsMimeTypes(['image/jpeg', 'image/png', 'image/webp', 'image/gif']);
    }
}
