@if(session()->has('success'))

<div class="alert alert-success">
	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
	<i class="icon fa fa-check"></i> {{session()->get('success')}}
</div>
@endif
@if ($errors->any())
<ul class="alert alert-danger">
	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
	@foreach ($errors->all() as $error)
	<i class="icon fa fa-ban"> {{ $error }}</i><br>
	@endforeach
</ul>
@endif