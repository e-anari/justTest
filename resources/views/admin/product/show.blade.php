@extends('layouts.app')

@section('content')
<div class="col-md-12 col-sm-12 ">
    <div class="x_panel">
        <div class="x_title">
            <h2>Product<small>Detail</small></h2>
            <div class="clearfix"></div>
        </div>

        <div class="x_content">

            <div class="col-md-7 col-sm-7 ">
                <img src="{{$product->image}}" />
                <div class="product_gallery">
                    {{-- @dd($gallery); --}}
                    @foreach ($gallery as $img)
                    <a>
                        <img src="{{$img->url}}" alt="{{$img->alt}}" />
                    </a>
                    @endforeach

                </div>
            </div>

            <div class="col-md-5 col-sm-5 " style="border:0px solid #e5e5e5;">

                <h3 class="prod_title">{{$product->title}}</h3>

                <p>{{$product->description}}</p>
                <br />

                {{-- attributes --}}
                <ul>
                    {{-- @dd($product->attributes); --}}
                    @foreach ($product->attributes as $attr)
                    @dd($attr);
                    <li>{{$attr->name}} : </li>
                    @endforeach
                </ul>

                <div class="">
                    <div class="product_price">
                        <h1 class="price">{{$product->price}}</h1>
                        <span class="price-tax">Ex Tax: Ksh80.00</span>
                        <br>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection