@component('layouts.content')

<div class="row">
    <div class="col-md-12 col-sm-12 ">
        <div class="x_panel">
            <div class="x_title">
                <h2>Profile <small>Active Email Verify</small></h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <br>
                <p>At first,enter or edit your email address from <a href="{{ route('profile.edit',$user)}}">This Link</a>.
                </p>
            </div>
        </div>
    </div>
</div>
@endcomponent