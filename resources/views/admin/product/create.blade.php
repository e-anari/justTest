@extends('layouts.app')

@section('scripts')

{{-- CKEditor : start --}}
<script src="https://cdn.ckeditor.com/ckeditor5/35.0.1/classic/ckeditor.js"></script>
<script>
    ClassicEditor
            .create( document.querySelector( '#editor' ) )
            .then( editor => {
                    console.log( editor );
            } )
            .catch( error => {
                    console.error( error );
            } );
</script>
{{-- CKEditor : end --}}

{{-- Attribute Dynamic Button --}}
<script>
    let changeAttributeValues = (event , id) => {
        let valueBox = $(`select[name='attributes[${id}][value]']`);

        $.ajaxSetup({
            headers : {
                'X-CSRF-TOKEN' : document.head.querySelector('meta[name="csrf-token"]').content,
                'Content-Type' : 'application/json'
            }
        })

        $.ajax({
            type : 'POST',
            url : '/admin/product',
            data : JSON.stringify({
                name : event.target.value
            }),
            success : function(data) {
                valueBox.html(`
                    <option selected>Select ...</option>
                    ${
                    data.data.map(function (item) {
                        return `<option value="${item}">${item}</option>`
                    })
                }
                `);

                $('.attribute-select').select2({ tags : true });
            }
        });
    }

    let createNewAttr = ({ attributes , id }) => {
        return `
            <div class="row" id="attribute-${id}">
                <div class="col-5">
                    <div class="form-group">
                         <select name="attributes[${id}][name]" onchange="changeAttributeValues(event, ${id});" class="attribute-select form-control">
                            <option value="">Select attribute name</option>
                            ${
                                attributes.map(function(item) {
                                    return `<option value="${item}">${item}</option>`
                                })
                            }
                         </select>
                    </div>
                </div>
                <div class="col-5">
                    <div class="form-group">
                         <select name="attributes[${id}][value]" class="attribute-select form-control">
                                <option value="">Select attribute value</option>
                         </select>
                    </div>
                </div>
                 <div class="col-2">
                    <div>
                        <button type="button" class="btn btn-sm btn-warning" onclick="document.getElementById('attribute-${id}').remove()">DELETE</button>
                    </div>
                </div>
            </div>
        `
    }

    $('#add_product_attribute').click(function() {
        let attributesSection = $('#attribute_section');
        let id = attributesSection.children().length;

        attributesSection.append(
            createNewAttr({
                attributes : [],
                id
            })
        );

        $('.attribute-select').select2({ tags : true });
    });
</script>
@endsection

@section('content')
<div class="col-md-12">
    <div class="x_panel">
        <div class="x_title">
            <h2>Products <small>create</small></h2>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">
            <br>
            <form id="demo-form2" data-parsley-validate="" class="form-horizontal form-label-left" novalidate=""
                action="{{ route('product.store')}}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="item form-group">
                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="title">Title <span
                            class="required">*</span>
                    </label>
                    <div class="col-md-6 col-sm-6 ">
                        <input type="text" name="title" class="form-control" value="{{old('title')}}">
                    </div>
                </div>

                <div class="item form-group">
                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="description">Description <span
                            class="required">*</span>
                    </label>
                    <div class="col-md-6 col-sm-6 ">
                        <textarea id="editor" name="description" rows="10" cols="80" required
                            class="form-control">{{old('description')}}</textarea>
                        <br>
                    </div>
                </div>

                <div class="item form-group">
                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="price">Price <span
                            class="required">*</span>
                    </label>
                    <div class="col-md-6 col-sm-6 ">
                        <input type="text" name="price" required class="form-control " value="{{old('price')}}">
                    </div>
                </div>

                <div class="item form-group">
                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="inventory">Inventory <span
                            class="required">*</span>
                    </label>
                    <div class="col-md-6 col-sm-6 ">
                        <input type="text" name="inventory" required class="form-control " value="{{old('inventory')}}">
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
                            <option value="{{$category->id}}">{{$category->title}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                {{-- Attribute --}}
                <div class="item form-group">
                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="inventory">Attributes <span
                            class="required">*</span>
                    </label>
                    <div class="col-md-6 col-sm-6 ">
                        <div id="attribute_section">

                        </div>
                        <button class="btn btn-sm btn-danger" type="button" id="add_product_attribute">New
                            Attribute</button>

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


                <div class="ln_solid"></div>
                <div class="item form-group">
                    <div class="col-md-6 col-sm-6 offset-md-3">
                        <button onclick="window.location='{{ route('permission.index') }}'" class="btn btn-primary"
                            type="button">
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