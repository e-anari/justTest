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
                <div class="product_gallery">
                    <a>
                        <img src="images/prod-2.jpg" alt="..." />
                    </a>
                    <a>
                        <img src="images/prod-3.jpg" alt="..." />
                    </a>
                    <a>
                        <img src="images/prod-4.jpg" alt="..." />
                    </a>
                    <a>
                        <img src="images/prod-5.jpg" alt="..." />
                    </a>
                </div>
            </div>

            <div class="col-md-5 col-sm-5 " style="border:0px solid #e5e5e5;">

                <h3 class="prod_title">{{$product->title}}</h3>

                <p>{{$product->comment}}</p>
                <br />

                <div class="">
                    <h2>Available Colors</h2>
                    <ul class="list-inline prod_color display-layout">
                        <li>
                            <p>Green</p>
                            <div class="color bg-green"></div>
                        </li>
                        <li>
                            <p>Blue</p>
                            <div class="color bg-blue"></div>
                        </li>
                        <li>
                            <p>Red</p>
                            <div class="color bg-red"></div>
                        </li>
                        <li>
                            <p>Orange</p>
                            <div class="color bg-orange"></div>
                        </li>

                    </ul>
                </div>
                <br />

                <div class="">
                    <h2>Size <small>Please select one</small></h2>
                    <ul class="list-inline prod_size display-layout">
                        <li>
                            <button type="button" class="btn btn-default btn-xs">Small</button>
                        </li>
                        <li>
                            <button type="button" class="btn btn-default btn-xs">Medium</button>
                        </li>
                        <li>
                            <button type="button" class="btn btn-default btn-xs">Large</button>
                        </li>
                        <li>
                            <button type="button" class="btn btn-default btn-xs">Xtra-Large</button>
                        </li>
                    </ul>
                </div>
                <br />

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