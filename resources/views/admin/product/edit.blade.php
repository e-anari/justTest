@extends('layouts.app')

@section('content')
<div class="col-md-12">
    <div class="x_panel">
        <div class="x_title">
            <h2>Product <small>edit</small></h2>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">
            <br>
            <form class="form-label-left input_mask" action="{{ route('product.update',$product)}}" method="POST"
                enctype="multipart/form-data">
                @csrf
                @method('Patch')


                <div class="item form-group">
                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="title">Title <span
                            class="required">*</span>
                    </label>
                    <div class="col-md-6 col-sm-6 ">
                        <input type="text" name="title" class="form-control" value="{{old('title',$product->title) }}">
                    </div>
                </div>

                <div class="item form-group">
                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="description">Description <span
                            class="required">*</span>
                    </label>
                    <div class="col-md-6 col-sm-6 ">
                        <textarea rows="10" cols="80" name="description" required
                            class="form-control">{{old('description',$product->description)}}</textarea>
                        <br>
                    </div>
                </div>

                <div class="item form-group">
                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="price">Price <span
                            class="required">*</span>
                    </label>
                    <div class="col-md-6 col-sm-6 ">
                        <input type="text" name="price" required class="form-control "
                            value="{{old('price',$product->price)}}">
                    </div>
                </div>

                <div class="item form-group">
                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="inventory">Inventory <span
                            class="required">*</span>
                    </label>
                    <div class="col-md-6 col-sm-6 ">
                        <input type="text" name="inventory" required class="form-control "
                            value="{{old('inventory',$product->inventory)}}">
                    </div>
                </div>

                <div class="item form-group">
                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="inventory">Categories <span
                            class="required">*</span>
                    </label>
                    <div class="col-md-6 col-sm-6 ">
                        <select name="categories[]" class="select2_multiple form-control" multiple="multiple">
                            <option>Choose option</option>
                            @foreach ($categories as $category)
                            <option value="{{$category->id}}" {{(in_array($category->
                                id,$product->categories()->pluck('id')->toArray()))?'selected':''}}>{{$category->title}}
                            </option>
                            @endforeach
                        </select>
                    </div>
                </div>


                <div class="item form-group">
                    <label class="col-form-label col-md-3 col-sm-3 label-align">Address Image</label>
                    <div class="col-md-6 col-sm-6 ">
                        @if(!empty($product->image))
                        <input type="text" value="{{$product->image}}" disabled>
                        <br>
                        <hr>
                        <img src="{{$product->image}}">
                        @endif
                    </div>
                </div>
                {{-- Upload file --}}
                <div class="item form-group">
                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="image">Main pic <span
                            class="required">*</span>
                    </label>
                    <div class="col-md-6 col-sm-6 ">
                        <input type="file" name="image" required class="form-control ">
                    </div>
                </div>



                <div class="form-group row">
                    <div class="col-md-9 col-sm-9  offset-md-3">
                        <button onclick="window.location='{{ route('product.index',$product) }}'"
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


</div>
@endsection