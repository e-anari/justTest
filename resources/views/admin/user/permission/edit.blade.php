@component('layouts.content')
<div class="col-md-12">
    <div class="x_panel">
        <div class="x_title">
            <h2>User <small>permission</small></h2>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">
            <br>
            <form action="{{ route('user.permission.update',$user)}}" method="POST" id="demo-form2"
                data-parsley-validate="" class="form-horizontal form-label-left">
                @csrf
                @method('Patch')

                <div class="item form-group">
                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="roles">Select
                        Roles</label>
                    <div class="col-md-6 col-sm-6">
                        <select id="select2" name="roles[]" class="select2_multiple form-control" multiple="multiple">
                            @foreach ($roles as $role)
                            <option value="{{$role->id}}" {{(in_array($role->
                                id,$user->roles()->pluck('id')->toArray()))?'selected':''}}>{{$role->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="item form-group">
                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="permissions">Select
                        Permissions</label>
                    <div class="col-md-6 col-sm-6">
                        <select name="permissions[]" class="select2_multiple form-control" multiple="multiple">
                            @foreach ($permissions as $permission)
                            <option value="{{$permission->id}}" {{(in_array($permission->
                                id,$user->permissions()->pluck('id')->toArray()))?'selected':''}}>{{$permission->name}}
                            </option>
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