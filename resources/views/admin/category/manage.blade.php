@extends('layouts.app')

@section('content')

<div class="col-md-12 col-sm-12 ">
    <div class="x_panel">
        <div class="x_title">
            <h2>Manage Category TreeView</h2>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">
            <div class="row">
                <div class="col-sm-12">
                    <div class="container">
                        <div class="panel panel-primary">
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h3>Category List</h3>
                                        <ul id="tree1">
                                            @foreach($categories as $category)
                                            <li>
                                                <div class="row">
                                                    {{ $category->title }}

                                                    <form action="{{route('category.destroy',$category)}}"
                                                        method="post">
                                                        @csrf
                                                        @method('delete')
                                                        <button class="btn btn-base" style="padding: 0px;">
                                                            <span class="fa fa-eraser" style="color: red;"></span>
                                                        </button>
                                                    </form>

                                                    <button class="btn btn-base" style="padding: 0px;"
                                                        onclick="window.location='{{route('category.edit',$category)}}'"><span
                                                            class="fa fa-edit"
                                                            style="color: rgba(255, 255, 0, 0.774);"></span></button>
                                                </div>
                                                @if(count($category->childs))
                                                @include('admin.category.manageChild',['childs' => $category->childs])
                                                @endif
                                            </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                    <div class="col-md-6">
                                        <h3>Add New Category</h3>
                                        @include('admin.category.create')
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('head')
<!-- Styles -->
<link href="{{ asset('/tree-view/tree-view.css') }}" rel="stylesheet">
<!-- Scripts -->
<script src="{{ asset('/tree-view/tree-view.js') }}"></script>
@endpush

@endsection