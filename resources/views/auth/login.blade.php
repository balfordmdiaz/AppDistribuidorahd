@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @if (Auth::check())
            <div class="card" style="border-color: black;">
                <div class="card-header" style="background-color: sandybrown;"><p>Bienvenido, {{ Auth::user()->username }}!</p></div>
            @else
            <div class="card">
                <div class="card-header">{{ __('Login') }}</div>

                <div class="card-body">
                    <form id="form-login" method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Correo Electronico') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Contraseña') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button id="btn_login" type="submit" class="btn btn-primary">
                                    {{ __('Iniciar sesion') }}
                                </button>
                            </div>
                        </div>
                    </form>
                @endif
                </div>
            </div>
        </div>
    </div>
</div>


    <script> //Validacion de evitar carga de datos varias veces

        $('#form-login').submit(function(e)
        {
            $('#btn_login').on("click", function(e){
            e.preventDefault();
            });
        });

    </script>

@endsection
