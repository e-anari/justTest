@extends('layouts.app')

@section('content')
<div class="col-md-12 col-sm-12 ">
    <div class="x_panel">
        <div class="x_title">
            <h2>Products<small>list</small></h2>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card-box table-responsive">
                        <p class="text-muted font-13 m-b-30">
                            Responsive is an extension for DataTables that resolves that problem by optimising the
                            table's layout for different screen sizes through the dynamic insertion and removal of
                            columns from the table.
                        </p>

                        <div id="datatable-responsive_wrapper"
                            class="dataTables_wrapper container-fluid dt-bootstrap no-footer">
                            <form>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="dataTables_length" id="datatable-responsive_length"><label>Sort By:
                                                <select name="datatable-responsive_length"
                                                    aria-controls="datatable-responsive" class="form-control input-sm">
                                                    <option value="desc">Newest</option>
                                                    <option value="asc">Oldest</option>
                                                    <option value="az">Names (A-Z)</option>
                                                    <option value="za">Names (Z-A)</option>
                                                </select></label></div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div id="datatable-responsive_filter" class="col-sm-9 dataTables_filter"
                                            style="float: right">
                                            <label>Search:<input type="text" class="form-control input-sm"
                                                    placeholder="" id="search" name="search"
                                                    aria-controls="datatable-responsive"></label>
                                            <button type="submit" class="btn btn-base">
                                                <span class="fa fa-search"></span>
                                            </button>

                                            <button onclick="window.location='{{ route('product.create') }}'"
                                                type="button" class="btn btn-info btn-sm">Add New</button>
                                        </div>
                                    </div>
                            </form>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <table id="datatable-responsive"
                                    class="table table-striped table-bordered dt-responsive nowrap dataTable no-footer dtr-inline"
                                    cellspacing="0" width="100%" role="grid"
                                    aria-describedby="datatable-responsive_info" style="width: 100%;">
                                    <thead>
                                        <tr role="row">
                                            <th>Title</th>
                                            <th>Price</th>
                                            <th>Inventory</th>
                                            <th>Writher</th>
                                            <th>Seen</th>
                                            <th>Comments</th>
                                            <th>Categories</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($products as $product)
                                        <tr role="row" class="odd">
                                            <td>{{$product->title}}</td>
                                            <td>{{$product->price}}</td>
                                            <td>{{$product->inventory}}</td>
                                            <td>{{$product->user->username}}</td>
                                            <td>{{$product->view_count}}</td>
                                            {{-- Counting Related Models --}}
                                            <td>{{$product->comments_count}}</td>
                                            <td>@foreach ($product->categoriesList() as $cat)
                                                {{$cat}}
                                                @endforeach</td>
                                            <td class="d-flex">
                                                <button onclick="window.location='{{ route('product.show',$product) }}'"
                                                    class="btn btn-primary btn-sm" data-mdb-ripple-color="dark">
                                                    View
                                                </button>
                                                <button onclick="window.location='{{ route('product.edit',$product) }}'"
                                                    class="btn btn-warning btn-sm" data-mdb-ripple-color="dark">
                                                    Edit
                                                </button>
                                                <form action="{{ route('product.destroy',$product) }}" method="post">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="submit" class="btn btn-danger btn-sm">
                                                        DELETE
                                                    </button>
                                                </form>
                                                <button onclick="window.location='{{ route('products.gallery.index',$product)}}'" class="btn btn-dark btn-sm">Gallery</button>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-5">
                                <div class="dataTables_info" id="datatable-responsive_info" role="status"
                                    aria-live="polite">Showing {{$products->firstItem()}} to
                                    {{$products->lastItem()}} of
                                    {{$products->total()}} entries</div>
                            </div>
                            <div class="col-sm-7">
                                {{-- pagination part --}}
                                {{ $products->links('/pagination.default') }}
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>
</div>
@endsection