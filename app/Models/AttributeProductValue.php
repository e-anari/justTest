<?php

namespace App\Models;

use App\Models\AttributeValue;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AttributeProductValue extends Model
{
    use HasFactory;

    protected $table = 'attribute_product';

    public function attribute()
    {
        return $this->belongsTo(Attribute::class, 'attribute_id', 'id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }

    public function value()
    {
        return $this->belongsTo(AttributeValue::class, 'value_id', 'id');
    }
}
