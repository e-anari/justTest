<ul>
@foreach($childs as $child)
<li>
	<div class="row">
		{{ $child->title }}

		<form action="{{route('category.destroy',$child)}}"
			method="post">
			@csrf
			@method('delete')
			<button class="btn btn-base" style="padding: 0px;"
				onclick="window.location='{{route('category.destroy',$child)}}'"><span
					class="fa fa-eraser"
					style="color: red;"></span></button>
		</form>

		<button class="btn btn-base" style="padding: 0px;"
			onclick="window.location='{{route('category.edit',$child)}}'"><span
				class="fa fa-edit"
				style="color: rgba(255, 255, 0, 0.774);"></span></button>
	</div>
	@if(count($child->childs))
	@include('admin.category.manageChild',['childs' => $child->childs])
	@endif
</li>
@endforeach
</ul>