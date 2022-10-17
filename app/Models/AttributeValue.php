<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AttributeValue extends Model
{
    use HasFactory;

    protected $fillable = ['value', 'attribute_name'];

    public function attributes()
    {
        return $this->belongsTo(Attribute::class);
    }
}
