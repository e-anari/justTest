<div class="x_content">
    <form id="demo-form2" data-parsley-validate="" class="form-horizontal form-label-left" novalidate=""
        action="{{ route('category.store')}}" method="POST">
        @csrf

        <div class="item form-group">
            <div class="col-md-6 col-sm-6 ">
                <input type="text" name="title" class="form-control" value="{{old('title')}}" placeholder="Title">
            </div>
        </div>

        <div class="form-group item">
            <div class="col-md-6 col-sm-6 ">
                <select name="parent_id" class="form-control">
                    <option value="">Select father category</option>
                    @foreach ($allCategories as $category)
                        <option value="{{$category->id}}">{{$category->title}}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="item form-group">
            <div class="col-md-6 col-sm-6">
                <button type="submit" class="btn btn-success">Submit</button>
            </div>
        </div>

    </form>
</div>