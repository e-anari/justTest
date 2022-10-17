@extends('layouts.app')

@section('content')
<div class="col-md-12">
    <div class="x_panel">
        <div class="x_title">
            <h2>User <small>edit</small></h2>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">
            <br>
            <form class="form-label-left input_mask" action="{{ route('user.update',$user)}}" method="POST">
                @csrf
                @method('Patch')

                <div class="col-md-6 col-sm-12  form-group has-feedback">
                    <label>Change access:<select class="form-control" id="rank" name="rank">
                            @foreach ( config('rank') as $key=>$val)
                            <option value="{{$key}}" {{old('rank'==$key) || $user->rank ==$key ? 'selected' : ''}}
                                {{$key == 'highest' ? 'disabled' : ''}}
                                >{{$val}}</option>
                            @endforeach
                        </select></label>
                </div>


                <div class="form-group row">
                    <div class="col-md-9 col-sm-9  offset-md-3">
                        <button onclick="window.location='{{ route('user.index',$user) }}'" class="btn btn-primary"
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