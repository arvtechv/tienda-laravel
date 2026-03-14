@extends('layouts.app')

@section('content')
<div class="content-card">
    <div class="content-header">Dashboard</div>
    <div class="content-body">
        @if (session('status'))
            <div class="alert alert-success">{{ session('status') }}</div>
        @endif
        <p style="color:#686B75;">Bienvenido, {{ auth()->user()->name ?? 'Usuario' }}.</p>
    </div>
</div>
@endsection
