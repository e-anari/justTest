@extends('layouts.app')

@section('content')
<div class="col-md-12 col-sm-12 ">
    <div class="x_panel">
        <div class="x_title">
            <h2>Shop</h2>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">
            <div class="col-md-12 col-sm-12  text-center">
                <ul class="pagination pagination-split">
                    <li><a href="#">A</a></li>
                    <li><a href="#">B</a></li>
                    <li><a href="#">C</a></li>
                    <li><a href="#">D</a></li>
                    <li><a href="#">E</a></li>
                    <li>...</li>
                    <li><a href="#">W</a></li>
                    <li><a href="#">X</a></li>
                    <li><a href="#">Y</a></li>
                    <li><a href="#">Z</a></li>
                </ul>
            </div>

            <div class="clearfix"></div>

            @foreach ($products as $product)
            <div class="col-md-4 col-sm-4  profile_details">
                <div class="well profile_view" style="width: 100%">
                    <div class="col-sm-12">
                        <h4 class="brief"><i>{{$product->title}}</i></h4>
                        <div class="left col-md-7 col-sm-7">
                            <h2>{{$product->title}}</h2>
                            <p><strong>About: </strong>{{ Str::limit($product->description, 100, ' (...)')}}</p>
                            <ul class="list-unstyled">
                                <li><i class="fa fa-money"></i> Price: {{$product->price}}</li>
                                <li><i class="fa fa-archive"></i> Count: {{$product->inventory}}</li>
                            </ul>
                        </div>
                        <div class="right col-md-5 col-sm-5 text-center">
                            <img src="{{$product->image}}" alt="" class="img-circle img-fluid">
                        </div>
                    </div>
                    <div class=" profile-bottom text-center">
                        <div class=" col-sm-6 emphasis">
                            <p class="ratings">
                                <a>4.0</a>
                                <a href="#"><span class="fa fa-star"></span></a>
                                <a href="#"><span class="fa fa-star"></span></a>
                                <a href="#"><span class="fa fa-star"></span></a>
                                <a href="#"><span class="fa fa-star"></span></a>
                                <a href="#"><span class="fa fa-star-o"></span></a>
                            </p>
                        </div>
                        <div class=" col-sm-6 emphasis ">
                            <button type="button" class="btn btn-success btn-sm"> <i class="fa fa-user">
                                </i> <i class="fa fa-comments-o"></i> </button>
                            <button onclick="window.location='{{route('detail',$product)}}'" type="button"
                                class="btn btn-primary btn-sm">
                                <i class="fa fa-shopping-cart"> </i> View Detail
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach


        </div>
    </div>
</div>

@endsection