@component('layouts.content')
<div class="col-md-12">
    <div class="x_panel">
        <div class="x_title">
            <h2>Category <small>edit</small></h2>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">
            <br>
            <form id="demo-form2" data-parsley-validate="" class="form-horizontal form-label-left" novalidate=""
                action="{{ route('category.update',$category)}}" method="POST">
                @csrf
                @method('patch')

                <div class="item form-group">
                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="title">Title <span
                            class="required">*</span>
                    </label>
                    <div class="col-md-6 col-sm-6 ">
                        <input type="text" name="title" class="form-control" value="{{old('title',$category->title)}}">
                    </div>
                </div>

                <div class="item form-group">
                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="title">Category <span
                            class="required">*</span>
                    </label>
                    <div class="col-md-6 col-sm-6 ">
                        <select name="parent_id" class="form-control">
                            <option value="">Select father category</option>
                            @foreach ($allCategories as $oneCategory)
                            <option value="{{$oneCategory->id}}" @if ($oneCategory->id == $category->parent_id)
                                selected
                                @endif
                                >{{$oneCategory->title}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="item form-group">
                    <div class="col-md-6 col-sm-6 offset-md-3">
                        <button type="submit" class="btn btn-success">Submit</button>
                    </div>
                </div>

            </form>
        </div>
    </div>
</div>
@endcomponent