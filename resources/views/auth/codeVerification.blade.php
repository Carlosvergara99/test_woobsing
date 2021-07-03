@extends('layouts.app')
@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card-group">
            <div class="card p-4">
                <div class="card-body">
                    @if(session()->has('message'))
                        <p class="alert alert-info">
                            {{ session()->get('message') }}
                        </p>
                    @endif
                    <form method="POST" action="{{ route('code.store') }}">
                        {{ csrf_field() }}
                        <h1>Autenticación por Two Factor </h1>
                        <p class="text-muted">
                            ha recibido un correo electrónico que contiene un código de inicio de sesión
                            Si no lo ha recibido, presione<a href="{{ route('code.resend') }}">aqui</a>.
                        </p>

                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                
                            </div>
                            <input name="code" type="text"class="form-control{{ $errors->has('code') ? ' is-invalid' : '' }}" required autofocus placeholder="Code">
                            @if($errors->has('code'))
                            <div class="invalid-feedback">
                                {{ $errors->first('code') }}
                            </div>
                        @endif
                        </div>

                        <div class="row">
                            <div class="col-6">
                                <button type="submit" class="btn btn-primary">
                                    Verificar
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection