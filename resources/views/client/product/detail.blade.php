@extends('layouts.app')

@section('content')
<div class="col-md-12 col-sm-12 ">
    <div class="x_panel">
        <div class="x_title">
            <h2>Shop<small>Detail Product</small></h2>
            <div class="clearfix"></div>
        </div>

        <div class="x_content">

            <div class="col-md-7 col-sm-7 ">
                <div class="product-image">
                    <img src="images/prod-1.jpg" alt="..." />
                </div>
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
                <br>
                <div>
                    <p>Categories :</p>
                    @foreach ($product->categoriesList() as $cat)
                    <a href=""> {{$cat}}</a>
                    @endforeach
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

                <div class="">
                    <button onclick="window.location='{{route('addToCart',$product )}}'" type="button"
                        class="btn btn-danger btn-lg">Add to Cart</button>
                    <button type="button" class="btn btn-success btn-lg">Add to Wishlist</button>
                </div>

            </div>


            <div class="col-md-12">

                <ul class="nav nav-tabs bar_tabs" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="description" data-toggle="tab" href="#description" role="tab"
                            aria-controls="description" aria-selected="true">Description</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" id="show-comment-tab" data-toggle="tab" href="#comments" role="tab"
                            aria-controls="comment" aria-selected="true">Comments(count)</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="profile-tab" data-toggle="tab" href="#write-comment" role="tab"
                            aria-controls="profile" aria-selected="false">Write a comment </a>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="description" role="tabpanel"
                        aria-labelledby="description-tab">

                        <ul class="list-unstyled msg_list">
                            {{$product->description}}
                        </ul>

                    </div>
                    <div class="tab-pane fade show" id="comments" role="tabpanel" aria-labelledby="show-comment-tab">

                        <ul class="list-unstyled msg_list">
                            @foreach ($product->comments()->where('parent_id',0)->get() as $comment)
                            <li>
                                <div class="row" style="width: 100%">
                                    <div class="col-12">
                                        <a>
                                            <span class="image">
                                                <img height="80px" width="80px !important"
                                                    src="/website-theme/images/img.jpg" alt="img">
                                            </span>
                                            <span>
                                                <span>{{$comment->user->username}} </span>
                                                <span class="time"> -
                                                    {{Carbon\Carbon::parse($comment->created_at)->diffForHumans()}}</span>
                                                <span> <button type="button" class="btn btn-link" data-toggle="collapse"
                                                        data-target="#demo-{{$comment->id}}"><span class="small"><i
                                                                class="fa fa-reply"></i> reply</span></button></span>
                                            </span>
                                            <p class="message">
                                                {{$comment->comment}}
                                            </p>
                                        </a>
                                    </div>
                                    <div class="col-12">
                                        <div id="demo-{{$comment->id}}" class="collapse">

                                            @guest
                                            <div class="alert alert-warning">Please log in to post a comment.</div>
                                            @endguest
                                            <hr>
                                            @auth
                                            <form data-parsley-validate="" class="form-horizontal form-label-left"
                                                novalidate="" action="{{ route('comment.store')}}" method="POST">
                                                @csrf

                                                <input type="hidden" name="commentable_id" value="{{$product->id}}">
                                                <input type="hidden" name="commentable_type"
                                                    value="{{get_class($product)}}">
                                                <input type="hidden" name="parent_id" value="{{$comment->id}}">


                                                <div class="item form-group">
                                                    <label class="col-form-label col-md-3 col-sm-3 label-align"
                                                        for="comment">Comment <span class="required">*</span>
                                                    </label>
                                                    <div class="col-md-6 col-sm-6 ">
                                                        <textarea placeholder="Write ... " rows="1" cols="8"
                                                            name="comment" required
                                                            class="form-control">{{old('comment')}}</textarea>
                                                        <br>
                                                    </div>

                                                    <div>
                                                        <button type="submit" class="btn btn-success">Post</button>
                                                    </div>
                                                </div>

                                            </form>
                                            @endauth
                                            @foreach ($comment->child as $commentChild)
                                            <ul>
                                                <li>
                                                    <a>
                                                        <span class="image">
                                                            <img height="80px" width="80px !important"
                                                                src="/website-theme/images/img.jpg" alt="img">
                                                        </span>
                                                        <span>
                                                            <span>{{$commentChild->user->username}} </span>
                                                            <span class="time"> -
                                                                {{Carbon\Carbon::parse($commentChild->created_at)->diffForHumans()}}</span>
                                                        </span>
                                                        <p class="message">
                                                            {{$commentChild->comment}}
                                                        </p>
                                                    </a>
                                                </li>
                                            </ul>
                                            @endforeach

                                        </div>
                                    </div>
                                </div>
                            </li>
                            @endforeach
                        </ul>

                    </div>
                    <div class="tab-pane fade" id="write-comment" role="tabpanel" aria-labelledby="write-comment">
                        <br>
                        @guest
                        <div class="alert alert-warning">Please log in to post a comment.</div>
                        @endguest
                        @auth
                        <form data-parsley-validate="" class="form-horizontal form-label-left" novalidate=""
                            action="{{ route('comment.store')}}" method="POST">
                            @csrf

                            <input type="hidden" name="commentable_id" value="{{$product->id}}">
                            <input type="hidden" name="commentable_type" value="{{get_class($product)}}">
                            <input type="hidden" name="parent_id" value="0">


                            <div class="item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align" for="comment">Comment <span
                                        class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 ">
                                    <textarea placeholder="Write ... " rows="10" cols="80" name="comment" required
                                        class="form-control">{{old('comment')}}</textarea>
                                    <br>
                                </div>
                            </div>

                            <div class="ln_solid"></div>
                            <div class="item form-group">
                                <div class="col-md-6 col-sm-6 offset-md-3">
                                    <button type="submit" class="btn btn-success">Post</button>
                                </div>
                            </div>

                        </form>
                        @endauth
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

@endsection