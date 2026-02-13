<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Brand extends Model implements HasMedia
{
    use InteractsWithMedia;
    protected $fillable = [
        "name",
        "slug",
    ];

    public function registerMediaConversions(?Media $media = null): void
    {
        $this->addMediaConversion('thumb')
            ->width(50)
            ->height(50)
            ->fit('crop')
            ->performOnCollections('brand-image');

        $this->addMediaConversion('preview')
            ->width(1200)
            ->height(1200)
            ->fit('crop')
            ->performOnCollections('brand-image');
    }
}
