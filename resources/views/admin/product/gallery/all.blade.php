@extends('layouts.app')

@section('content')

<!-- page content -->
<div class="row">
    <div class="col-md-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Media Gallery <small> list</small></h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <div class="row">
                    <button onclick="window.location='{{ route('products.gallery.create',$product) }}'" type="button"
                        class="btn btn-info btn-sm">Add New</button>
                </div>
                <div class="row">
                    @foreach ($imgs as $img)
                    <div class="col-md-55">
                        <div class="thumbnail">
                            <div class="image view view-first">
                                <img style="width: 100%; display: block;" src="{{$img->url}}" alt="image" />
                                <div class="mask">
                                    <div class="row tools tools-bottom">
                                        <button
                                            onclick="window.location='{{ route('products.gallery.edit',[$product,$img]) }}'"
                                            class="btn btn-base"><span class="fa fa-edit" style="color: white;"></span>
                                        </button>
                                        <form
                                            action="{{  route('products.gallery.destroy',['product' => $product,'gallery'=>$img])}}"
                                            method="post">
                                            @method('delete')
                                            @csrf
                                            
                                            <button type="submit" class="btn btn-base"><span class="fa fa-close"
                                                    style="color: white;"></span>
                                            </button>

                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="caption">
                                <p>{{$img->alt}}</p>
                            </div>
                        </div>
                    </div>
                    @endforeach

                </div>
            </div>
        </div>
    </div>
</div>

<!-- /page content -->

@endsection