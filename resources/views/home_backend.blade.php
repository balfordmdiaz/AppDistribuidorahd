@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
        @if (Auth::check())
            <div class="card" style="border-color: black;">
                <div class="card-header" style="background-color: sandybrown;"><p>Bienvenido, {{ Auth::user()->username }}!</p></div>
        @else  
        </div>
        @endif
    </div>
</div>
@endsection
