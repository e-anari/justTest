@component('layouts.content')
<div class="col-md-12">
    <div class="x_panel">
        <div class="x_title">
            <h2>User <small>edit</small></h2>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">
            <br>
            <form class="form-label-left input_mask" action="{{ route('permission.update',$permission)}}" method="POST">
                @csrf
                @method('Patch')


                <div class="col-md-6 col-sm-6  form-group has-feedback">
                    <input type="text" class="form-control has-feedback-left" id="name" placeholder="Name" name="name"
                        value="{{$permission->name}}">
                    <span class="fa fa-key form-control-feedback left" aria-hidden="true"></span>
                </div>

                <div class="col-md-6 col-sm-6  form-group has-feedback">
                    <input type="text" class="form-control has-feedback-left" id="description" placeholder="Description"
                        value="{{$permission->description}}" name="description">
                    <span class="fa fa-bars form-control-feedback left" aria-hidden="true"></span>
                </div>


                <div class="form-group row">
                    <div class="col-md-9 col-sm-9  offset-md-3">
                        <button onclick="window.location='{{ route('permission.index',$permission) }}'"
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
@endcomponent