@component('layouts.content')

<div class="row">
    <div class="col-md-12 col-sm-12 ">
        <div class="x_panel">
            <div class="x_title">
                <h2>Profile <small>Two Factor Authentication</small><small>How To Send?</small></h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <br>
                <form method="POST" action="{{ route('post-type-2factor-auth') }}" id="demo-form2"
                    data-parsley-validate="" class="form-horizontal form-label-left" novalidate="">
                    @csrf
                    <div class="item form-group">
                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Send Code By:</label>
                        <div class="col-md-6 col-sm-6 ">
                            <div id="type" class="btn-group" data-toggle="buttons">
                                <label class="btn btn-secondary" data-toggle-class="btn-primary"
                                    data-toggle-passive-class="btn-default">
                                    <input type="radio" name="type" value="email" class="join-btn"
                                        data-parsley-multiple="type"> &nbsp; Email &nbsp;
                                </label>
                                <label class="btn btn-primary" data-toggle-class="btn-primary"
                                    data-toggle-passive-class="btn-default">
                                    <input type="radio" name="type" value="sms" class="join-btn"
                                        data-parsley-multiple="type"> SMS
                                </label>
                            </div>
                        </div>


                    </div>
                    <div class="item form-group">
                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="phone">Phone Number</label>
                        <div class="col-md-6 col-sm-6 ">
                            <input name="phone" type="text" id="phone" required="required" class="form-control ">
                        </div>
                        @error('phone')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="item form-group">
                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="email">Email
                            Address</label>
                        <div class="col-md-6 col-sm-6 ">
                            <input type="text" id="email" name="email" required="required"
                                class="form-control">
                        </div>
                        @error('email')
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