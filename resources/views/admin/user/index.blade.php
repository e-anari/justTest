@extends('layouts.app')

@section('content')
<div class="col-md-12 col-sm-12 ">
    <div class="x_panel">
        <div class="x_title">
            <h2>Responsive example<small>Users</small></h2>
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
                                        <div id="datatable-responsive_filter" class="col-sm-9 dataTables_filter">
                                            <label>Rank:
                                                <select class="form-control input-sm" id="rank" name="rank"
                                                    aria-controls="datatable-responsive">
                                                    <option value="all">All</option>
                                                    @foreach ( config('rank') as $key=>$val)
                                                    <option value="{{$key}}" {{old('rank'==$key)==$key ? 'selected' : ''
                                                        }}>
                                                        {{$val}}</option>
                                                    @endforeach
                                                </select></label>
                                            <label>Search:<input type="text" class="form-control input-sm"
                                                    placeholder="" id="search" name="search"
                                                    aria-controls="datatable-responsive"></label>
                                            <button type="submit" class="btn btn-base">
                                                <span class="fa fa-search"></span>
                                            </button>
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
                                            <th>User name
                                            </th>
                                            <th>First name</th>
                                            <th>Last name
                                            </th>
                                            <th>Job</th>
                                            <th>Country</th>
                                            <th>Join date</th>
                                            <th>IsAdmin</th>
                                            <th>E-mail</th>
                                            <th>Two factore auth state</th>
                                            <th>Verified email state</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($users as $user)
                                        <tr role="row" class="odd">
                                            <td tabindex="0" class="sorting_1">{{$user->username}}</td>
                                            <td>{{$user->firstname}}</td>
                                            <td>{{$user->lastname}}</td>
                                            <td>{{$user->job}}</td>
                                            <td>{{$user->country}}</td>
                                            <td>{{$user->created_at}}<br>{{Carbon\Carbon::parse($user->created_at)->diffForHumans()}}
                                            </td>
                                            <td style="text-align: center">
                                                @if ($user->is_admin)
                                                <span class="fa fa-check fa-lg" aria-hidden="true"
                                                    style="color: green"></span>
                                                @else
                                                <span class="fa fa-close fa-lg " aria-hidden="true"
                                                    style="color:red"></span>
                                                @endif
                                            </td>
                                            <td>{{$user->email}}</td>
                                            @if ($user->two_factor_type)
                                            <td><span class="btn btn-success btn-sm">{{$user->two_factor_type}}</span>
                                            </td>
                                            @else
                                            <td><span class="btn btn-danger btn-sm">inactive</span>
                                            </td>
                                            @endif

                                            @if ($user->email_verified_at)
                                            <td><span class="btn btn-success btn-sm">active</span>
                                            </td>
                                            @else
                                            <td><span class="btn btn-danger btn-sm">inactive</span>
                                            </td>
                                            @endif
                                            <td class="d-flex">
                                                <button onclick="window.location='{{ route('user.edit',$user) }}'"
                                                    class="btn btn-warning btn-sm" data-mdb-ripple-color="dark">
                                                    Edit
                                                </button>
                                                <form action="{{ route('user.destroy',$user) }}" method="post">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="submit" class="btn btn-danger btn-sm">
                                                        DELETE
                                                    </button>
                                                </form>
                                                @if ($user->is_admin)
                                                <button type="button"
                                                    onclick="window.location='{{ route('user.permission',$user)}}'"
                                                    class="btn btn-primary btn-sm"
                                                    data-mdb-ripple-color="dark">Permission</button>
                                                @endif
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
                                    aria-live="polite">Showing {{$users->firstItem()}} to {{$users->lastItem()}} of
                                    {{$users->total()}} entries</div>
                            </div>
                            <div class="col-sm-7">
                                {{-- pagination part --}}
                                {{ $users->links('/pagination.default') }}
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>
</div>
@endsection