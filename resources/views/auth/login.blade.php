@extends('layouts.app')

@section('content')
<div class="login-wrapper">
    <div class="login-card">
        <div class="login-logo">
            <h2>🖥️ TechStore</h2>
            <p>Inicia sesión en tu cuenta</p>
        </div>

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div>
                <label class="form-label-custom">Correo electrónico</label>
                <input type="email" name="email" class="form-control-custom"
                       value="{{ old('email') }}" required>
                @error('email')
                    <span class="text-danger" style="font-size:0.8rem">{{ $message }}</span>
                @enderror
            </div>

            <div>
                <label class="form-label-custom">Contraseña</label>
                <input type="password" name="password" class="form-control-custom" required>
                @error('password')
                    <span class="text-danger" style="font-size:0.8rem">{{ $message }}</span>
                @enderror
            </div>

            <button type="submit" class="btn-login-submit">Iniciar Sesión</button>
        </form>

        <p class="text-center mt-3" style="font-size:0.9rem; color:#94a3b8">
            ¿No tienes cuenta?
            <a href="{{ route('register') }}" style="color:#2563eb; font-weight:600">Regístrate</a>
        </p>
    </div>
</div>
@endsection
