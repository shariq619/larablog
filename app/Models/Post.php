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

    // In your Post model
    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('optimized')
            ->width(1920)
            ->height(1080)
            ->quality(80)
            ->optimize()
            ->withResponsiveImages();
    }
}
