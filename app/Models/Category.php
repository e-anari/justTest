<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'parent_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function products()
    {
        return $this->morphedByMany(Product::class, 'categoriable');
    }

    public function childs()
    {
        return $this->hasMany(Category::class, 'parent_id', 'id');
    }

    // public function hasChild()
    // {
    //     // dd(count($this->hasMany(Category::class, 'parent_id'))) ;
    //     return $this->hasMany(Category::class, 'parent_id', 'id');
    // }

    public function parent()
    {
        return $this->belongsTo(Category::class);
    }

}
