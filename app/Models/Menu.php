<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Menu extends Model
{
    use HasFactory;

    protected $fillable = ['title','href','parent_id', 'icon'];

    public function menuId(){
        return Str::slug($this->title, '_');
    }

    public function childs() {
        return $this->hasMany(Menu::class,'parent_id','id') ;
    }

    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }
}
