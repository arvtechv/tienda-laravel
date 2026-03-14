@extends('layouts.app')

@section('content')
<div class="login-page">
    <div class="login-box">
        <div class="logo-text">str<span>APP</span>berry</div>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <input type="text" name="name" class="input-custom"
                   placeholder="Nombre" value="{{ old('name') }}" required>
            @error('name')
                <p style="color:#D15253; font-size:0.8rem; margin-top:-10px; margin-bottom:10px;">{{ $message }}</p>
            @enderror

            <input type="email" name="email" class="input-custom"
                   placeholder="Email" value="{{ old('email') }}" required>
            @error('email')
                <p style="color:#D15253; font-size:0.8rem; margin-top:-10px; margin-bottom:10px;">{{ $message }}</p>
            @enderror

            <input type="password" name="password" class="input-custom"
                   placeholder="Contraseña" required>
            @error('password')
                <p style="color:#D15253; font-size:0.8rem; margin-top:-10px; margin-bottom:10px;">{{ $message }}</p>
            @enderror

            <input type="password" name="password_confirmation" class="input-custom"
                   placeholder="Confirmar contraseña" required>

            <button type="submit" class="btn-primary-custom">Registrarse</button>
        </form>

        <p style="margin-top:24px; color:#686B75; font-size:0.9rem;">
            ¿Ya tienes cuenta?<br>
            <a href="{{ route('login') }}" style="color:#353C59; font-weight:700; text-decoration:none;">Inicia sesión</a>
        </p>
    </div>
</div>
@endsection
