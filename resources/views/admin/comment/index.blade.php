@component('layouts.content')

<div class="col-md-12 col-sm-12 ">
    <div class="x_panel">
        <div class="x_title">
            <h2>Comments<small>list</small></h2>
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
                                            <th>Subject</th>
                                            <th>Writer</th>
                                            <th>Comment</th>
                                            <th>Approved</th>
                                            <th>Date</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($comments as $comment)
                                        <tr role="row" class="odd">
                                            <td>{{$comment->commentable_type}}</td>
                                            <td>{{$comment->user->username}}</td>
                                            <td>{{\Illuminate\Support\Str::limit(strip_tags($comment->comment),100,'...')}}
                                            </td>
                                            <td>{{$comment->approved}}</td>
                                            <td>{{$comment->created_at}}</td>
                                            <td class="d-flex">

                                                {{-- View Modal --}}
                                                <button class="btn btn-primary btn-sm" data-mdb-ripple-color="dark"
                                                    data-toggle="modal" data-target=".view-modal-{{$comment->id}}">
                                                    View
                                                </button>
                                                <div class="modal fade view-modal-{{$comment->id}}" tabindex="-1"
                                                    role="dialog" style="display: none;" aria-hidden="true">
                                                    <div class="modal-dialog modal-lg">
                                                        <div class="modal-content">

                                                            <div class="modal-header">
                                                                <h4 class="modal-title" id="myModalLabel">Comment
                                                                    content</h4>
                                                                <button type="button" class="close"
                                                                    data-dismiss="modal"><span
                                                                        aria-hidden="true">×</span>
                                                                </button>
                                                            </div>

                                                            <div class="modal-body">
                                                                <p>
                                                                <h4> Writer : </h4>{{$comment->user->username}}</p>
                                                                <h4> Comment : </h4>
                                                                <p>{{$comment->comment}}</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                {{-- Edit Modal --}}
                                                <button class="btn btn-warning btn-sm" data-mdb-ripple-color="dark"
                                                    data-toggle="modal" data-target=".edit-modal-{{$comment->id}}">
                                                    Edit
                                                </button>
                                                <div class="modal fade edit-modal-{{$comment->id}}" tabindex="-1"
                                                    role="dialog" style="display: none;" aria-hidden="true">
                                                    <div class="modal-dialog modal-lg">
                                                        <div class="modal-content">

                                                            <div class="modal-header">
                                                                <h4 class="modal-title" id="myModalLabel">Comment
                                                                    edit</h4>
                                                                <button type="button" class="close"
                                                                    data-dismiss="modal"><span
                                                                        aria-hidden="true">×</span>
                                                                </button>
                                                            </div>

                                                            <div class="modal-body">
                                                                @include('admin.comment.edit')
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                {{-- Delete Button --}}
                                                <form action="{{ route('comment.destroy',$comment) }}" method="post">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="submit" class="btn btn-danger btn-sm">
                                                        DELETE
                                                    </button>
                                                </form>

                                                {{-- Approved Button --}}
                                                <form action="{{ route('comment.approved',$comment) }}" method="post">
                                                    @csrf
                                                    @method('patch')
                                                    <button type="submit" class="btn btn-dark btn-sm">
                                                        {{($comment->approved) ? 'Approved' : 'Not Approved'}}
                                                    </button>
                                                </form>

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
                                    aria-live="polite">Showing {{$comments->firstItem()}} to
                                    {{$comments->lastItem()}} of
                                    {{$comments->total()}} entries</div>
                            </div>
                            <div class="col-sm-7">
                                {{-- pagination part --}}
                                {{ $comments->links('/pagination.default') }}
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endcomponent