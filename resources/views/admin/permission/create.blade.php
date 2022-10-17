@component('layouts.content')
<div class="col-md-12">
    <div class="x_panel">
        <div class="x_title">
            <h2>Permission <small>create</small></h2>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">
            <br>
            <form id="demo-form2" data-parsley-validate="" class="form-horizontal form-label-left" novalidate="" action="{{ route('permission.store')}}" method="POST">
                @csrf

                <div class="item form-group">
                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="name">Name <span
                            class="required">*</span>
                    </label>
                    <div class="col-md-6 col-sm-6 ">
                        <input type="text" id="name" name="name" required="required" class="form-control ">
                    </div>
                </div>
                <div class="item form-group">
                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="description">Description <span
                            class="required">*</span>
                    </label>
                    <div class="col-md-6 col-sm-6 ">
                        <input type="text" id="description" name="description" required="required" class="form-control">
                    </div>
                </div>

                <div class="ln_solid"></div>
                <div class="item form-group">
                    <div class="col-md-6 col-sm-6 offset-md-3">
                        <button onclick="window.location='{{ route('permission.index') }}'" class="btn btn-primary"
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