<?php

namespace App\Helpers\Cart;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class CartService
{
    protected $cart;

    public function __construct()
    {
        $this->cart = session()->get('cart') ?? collect([]);
    }

    public function put(array $value, $object = null)
    {
        if (!is_null($object) && $object instanceof Model) {
            $value = array_merge($value, [
                'id' => Str::random(10),
                'object_id' => $object->id,
                'object_type' => \get_class($object),

            ]);
        }

        // $this-> cart is a collection.you can use put method
        $this->cart->put($value['id'], $value);
        session()->put('cart', $this->cart);

        return $this;
    }

    # return one object in cart
    public function get($key)
    {
        # Key can be object or string.
        $item = $key instanceof Model ? $this->cart->where('object_id', $key->id)->where('object_type', get_class($key))->first() : $this->cart->firstWhere('id', $key);

        return $this->subject($item);

        # clean code
        // if ($key instanceof Model) {
        //     return $this->cart->where('object_id', $key->id)->where('object_type', get_class($key))->first();
        // }
        // return $this->cart->where('id', $key)->first();
    }

    # return all objects in cart
    public function all()
    {
        $cart = $this->cart;
        $cart = $cart->map(function ($item) {
            return $this->subject($item);
        });

        return $cart;

    }

    public function subject($item)
    {
        if (isset($item['object_id']) && isset($item['object_type'])) {
            $class = new $item['object_type'];
            $subject = $class->find($item['object_id']);
            $item[Str::lower(\class_basename($item['object_type']))] = $subject;
            return $item;
        }

        return $item;
    }
}
