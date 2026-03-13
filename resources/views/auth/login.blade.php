@extends('layouts.app')

@section('content')
<div class="login-page">
    <div class="login-box">
        <div class="logo-text">str<span>APP</span>berry</div>

        <form method="POST" action="{{ route('login') }}">
            @csrf

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

            <button type="submit" class="btn-primary-custom">Ingresar</button>
        </form>

        <p style="margin-top:24px; color:#686B75; font-size:0.9rem;">
            ¿Aún no tienes cuenta?<br>
            <a href="{{ route('register') }}" style="color:#353C59; font-weight:700; text-decoration:none;">Regístrate</a>
        </p>

        <p style="margin-top:16px; color:#9CA3AF; font-size:0.8rem;">
            Carlos Del Angel Ramirez | carlosdar_13@outlook.com
        </p>
    </div>
</div>
@endsection
