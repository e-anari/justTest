@component('layouts.content')
<div class="col-md-12">
    <div class="x_panel">
        <div class="x_title">
            <h2>Profile <small>edit</small></h2>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">
            <br>
            <form class="form-label-left input_mask" action="{{ route('profile.update',$user)}}" method="POST">
                @csrf
                @method('Patch')

                <div class="col-md-6 col-sm-6  form-group has-feedback">
                    <input type="text" class="form-control has-feedback-left" id="firstname" placeholder="First Name"
                        name="firstname" value="{{$user->firstname}}">
                    <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
                </div>

                <div class="col-md-6 col-sm-6  form-group has-feedback">
                    <input type="text" class="form-control" id="lastname" placeholder="Last Name" name="lastname"
                        value="{{$user->lastname}}">
                    <span class="fa fa-user form-control-feedback right" aria-hidden="true"></span>
                </div>

                <div class="col-md-6 col-sm-6  form-group has-feedback">
                    <input type="email" class="form-control has-feedback-left" id="email" placeholder="Email"
                        name="email" value="{{$user->email}}">
                    <span class="fa fa-envelope form-control-feedback left" aria-hidden="true"></span>
                </div>

                <div class="col-md-6 col-sm-6  form-group has-feedback">
                    <input type="tel" class="form-control" id="phone" placeholder="Phone" name="phone"
                        value="{{$user->phone}}">
                    <span class="fa fa-phone form-control-feedback right" aria-hidden="true"></span>
                </div>

                <div class="col-md-6 col-sm-6  form-group has-feedback">
                    <select class="form-control has-feedback-left" id="country" name="country">
                        <option>Choose option</option>
                        @foreach ( config('profile-country') as $key=>$val)
                        <option value="{{$key}}" {{old('country'==$key) || $user->country ==$key ? 'selected' : ''}}
                            >{{$val}}</option>
                        @endforeach
                    </select>
                    <span class="fa fa-map-marker  form-control-feedback left" aria-hidden="true"></span>
                </div>

                <div class="col-md-6 col-sm-6  form-group has-feedback">
                    <input type="text" class="form-control has-feedback-right" id="job" placeholder="Job" name="job"
                        value="{{$user->job}}">
                    <span class="fa fa-briefcase form-control-feedback right" aria-hidden="true"></span>
                </div>

                <div class="form-group row">
                    <label class="col-form-label col-md-3 col-sm-3 ">Username </label>
                    <div class="col-md-9 col-sm-9 ">
                        <input value="{{$user->username}}" class="form-control" disabled="disabled"
                            placeholder="Disabled Input">
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-form-label col-md-3 col-sm-3 ">Password</label>
                    <div class="col-md-9 col-sm-9 ">
                        <input type="password" class="form-control" placeholder="Password" name="password">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-form-label col-md-3 col-sm-3 ">Confirm Password</label>
                    <div class="col-md-9 col-sm-9 ">
                        <input type="password" class="form-control" placeholder="Confirm Password">
                    </div>
                </div>

                <div class="ln_solid"></div>
                <div class="form-group row">
                    <div class="col-md-9 col-sm-9  offset-md-3">
                        <button onclick="window.location='{{ route('profile.show',$user) }}'"
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