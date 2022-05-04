<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\Models\Media;
use Spatie\Permission\Traits\HasRoles;

class Product extends Model implements HasMedia
{
    use HasFactory, SoftDeletes, HasMediaTrait, HasRoles;

    protected $fillable = [
        'name', 'detail', 'price', 'slug', 'user_id'
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function registerMediaConversions(Media $media = null)
    {
        $this->addMediaConversion('thumb')
            ->width(200)
            ->height(200);
    }

    public function images() {

    }

    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }
}
