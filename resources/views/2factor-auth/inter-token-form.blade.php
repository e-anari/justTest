
{{-- <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Two Factor Authentication') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('post-token-2factor-auth') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="token" class="col-md-4 col-form-label text-md-end"
                                placeholder="Enter your token number">{{ __('token') }}</label>

                            <div class="col-md-6">
                                <input id="token" type="token" class="form-control" name="token" required autocomplete="token"
                                    autofocus>

                                @error('token')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>


                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Send') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div> --}}



@component('layouts.content')

<div class="row">
    <div class="col-md-12 col-sm-12 ">
        <div class="x_panel">
            <div class="x_title">
                <h2>Profile <small>Two Factor Authentication</small><small>Inter Code Form</small></h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <br>
                <form method="POST" action="{{ route('post-token-2factor-auth') }}" id="demo-form2" class="form-horizontal form-label-left" >
                    @csrf
                    @method("PATCH")

                    <div class="item form-group">
                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="token">Enter Code : </label>
                        <div class="col-md-6 col-sm-6 ">
                            <input name="token" type="text" id="token" required="required" class="form-control ">
                        </div>
                        @error('token')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="ln_solid"></div>
                    <div class="item form-group">
                        <div class="col-md-6 col-sm-6 offset-md-3">
                            <button class="btn btn-primary" type="button">Cancel</button>
                            <button class="btn btn-primary" type="reset">Reset</button>
                            <button type="submit" class="btn btn-success">Submit</button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
@endcomponent