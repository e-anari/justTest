@extends('layouts.app')

@section('content')
<div class="x_panel">
    <div class="x_title">
        <h2>Edit Galley <small> {{$product->title}} </small></h2>
        <div class="clearfix"></div>
    </div>
    <div class="x_content">
        <form action="{{route('products.gallery.update',[$product,$gallery])}}" enctype="multipart/form-data"
            method="post">
            @csrf
            @method('patch')

            <div class="item form-group">
                <label class="col-form-label col-md-3 col-sm-3 label-align">Address Image</label>
                <div class="col-md-6 col-sm-6 ">
                    <input type="text" value="{{$gallery->url}}" class="form-control " disabled>
                </div>
            </div>
            <div class="item form-group">
                <label class="col-form-label col-md-3 col-sm-3 label-align">Show Image</label>
                <div class="col-md-6 col-sm-6 ">
                    <img src="{{$gallery->url}}">
                </div>
            </div>
            <br>
            <hr>
            <div class="item form-group">
                <div class="col-md-6 col-sm-6">
                    <div class="form-group">
                        <input type="file" class="form-control" name="url" aria-label="Image">

                    </div>
                </div>
                <div class="col-md-6 col-sm-6">
                    <div class="form-group">
                        <input type="text" name="alt" class="form-control" value="{{$gallery->alt}}">
                    </div>
                </div>
            </div>

            <div class="ln_solid"></div>
            <div class="item form-group">
                <div class="col-md-6 col-sm-6 offset-md-3">
                    <button onclick="window.location='{{ route('products.gallery.index',$product) }}'"
                        class="btn btn-primary" type="button">
                        Cancel
                    </button>
                    <button type="reset" class="btn btn-primary">Reset</button>
                    <button type="submit" class="btn btn-success">Submit</button>
                </div>
            </div>

        </form>
    </div>
</div>
@endsection