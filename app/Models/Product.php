<?php

namespace App\Models;

use App\Models\Attribute;
use App\Models\AttributeProductValue;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'price',
        'inventory',
        'view_count ',
        'user_id',
        'image',
    ];

    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function categoriesList()
    {
        return $this->categories()->pluck('title')->toArray();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function attributes()
    {
        return $this->belongsToMany(Attribute::class)->using(AttributeProductValue::class)->withPivot(['value_id']);
    }

    public function gallery()
    {
        return $this->hasMany(Gallery::class);
    }
}
