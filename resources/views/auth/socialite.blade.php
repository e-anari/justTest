@extends('layouts.app')

@section('content')
<div class="container">
    <div class="list-group">
        <a href="{{ route('auth.google') }}" class="list-group-item list-group-item-action active">Login With Google</a>
        <a href="#" class="list-group-item list-group-item-action">Login With Github</a>
    </div>
</div>
@endsection