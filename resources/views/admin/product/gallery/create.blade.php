@extends('layouts.app')

@section('scripts')
{{-- Attribute Dynamic Button --}}
<script>
    let createNewPic = ({ id }) => {
                return `
                    <div class="row item form-group" id="image-${id}">
                        <div class="col-md-5 col-sm-5">
                            <div class="form-group">
                                    <input type="file" class="form-control image_label" name="images[${id}][image]"
                                           aria-label="Image">
                                    
                            </div>
                        </div>
                        <div class="col-md-5 col-sm-5">
                            <div class="form-group">
                                 <input type="text" name="images[${id}][alt]" class="form-control" placeholder="Write alt">
                            </div>
                        </div>
                         <div class="col-md-2 col-sm-2">
                            <div>
                                <button type="button" class="btn btn-sm btn-warning" onclick="document.getElementById('image-${id}').remove()">Delete</button>
                            </div>
                        </div>
                    </div>
                `
            }

            $('#add_product_image').click(function() {
                let imagesSection = $('#images_section');
                let id = imagesSection.children().length;

                imagesSection.append(
                    createNewPic({
                        id
                    })
                );

            });
            $('#add_product_image').click();


            // input
            let image;

            // set file link
            function fmSetLink($url) {
                image.find('.image_label').first().val($url);
            }
</script>
@endsection

@section('content')
<div class="x_panel">
    <div class="x_title">
        <h2>Add To Gallery For:<small> {{$product->title}} </small></h2>
        <div class="clearfix"></div>
    </div>
    <div class="x_content">
        <form action="{{route('products.gallery.store',$product)}}" enctype="multipart/form-data" method="post">
            @csrf

            <div id="images_section"></div>
            <button class="btn btn-sm btn-danger" type="button" id="add_product_image">Add
                Image</button>

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