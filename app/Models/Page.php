<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Page extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title',
        'body',
        'user_id',
        'parent_id',
        'slug'
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function parent()
    {
        return $this->belongsTo(Page::class,'parent_id')->where('parent_id',0);
    }

    public function children()
    {
        return $this->hasMany(Page::class,'parent_id');
    }

    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }
}
