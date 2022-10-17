@component('layouts.content')
<div class="col-md-12">
    <div class="x_panel">
        <div class="x_title">
            <h2>User <small>edit</small></h2>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">
            <br>
            <form action="{{ route('role.update',$role)}}" method="POST" id="demo-form2" data-parsley-validate=""
                class="form-horizontal form-label-left">
                @csrf
                @method('Patch')

                <div class="item form-group">
                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="name">Name <span
                            class="required">*</span>
                    </label>
                    <div class="col-md-6 col-sm-6 ">
                        <input type="text" id="name" name="name" required="required" class="form-control " value="{{$role->name}}">
                    </div>
                </div>
                <div class="item form-group">
                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="description">Description <span
                            class="required">*</span>
                    </label>
                    <div class="col-md-6 col-sm-6 ">
                        <input type="text" id="description" name="description" required="required" class="form-control" value="{{$role->description}}">
                    </div>
                </div>
                <div class="item form-group">
                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="permissions">Select
                        Permissions</label>
                    <div class="col-md-6 col-sm-6">
                        <select name="permissions[]" class="select2_multiple form-control" multiple="multiple">
                            @foreach ($permissions as $permission)
                            <option value="{{$permission->id}}" {{(in_array($permission->id,$role->permissions()->pluck('id')->toArray()))?'selected':''}}>{{$permission->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="ln_solid"></div>
                <div class="item form-group">
                    <div class="col-md-6 col-sm-6 offset-md-3">
                        <button onclick="window.location='{{ route('role.index') }}'" class="btn btn-primary"
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
@endcomponent