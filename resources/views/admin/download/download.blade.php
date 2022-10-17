@extends('layouts.app')

@section('content')
<div class="col-md-12 col-sm-12 ">
    <div class="x_panel">
        <div class="x_title">
            <h2>Download<small>code</small></h2>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">
            <div class="row">
                <div class="card-box table-responsive">
                    <p class="text-muted font-13 m-b-30">
                        After click in this link,you just have 30 Minutes to download code.
                    </p>

                        <a 
                        {{-- href="{{route('download.file',['user' => auth()->user(),'path'=> '/myFiles/pic1.jpeg'])}}" --}}
                           {{-- Safe Url --}}
                        href="{{Illuminate\Support\Facades\URL::temporarySignedRoute('download.file',now()->addMinutes(30),['user' => auth()->user(),'path'=> '/myFiles/pic1.jpeg'])}}"
                            >
                            <p style="color: green"><b>Click Here</b></p>
                        </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection