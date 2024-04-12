<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }} - Controle de Séries</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a href="{{ route('series.index') }}" class="navbar-brand">Home</a>
            @auth
                <a href="{{ route('logout') }}">Sair</a>
            @endauth
            @guest
                <a href="{{ route('login') }}">Entrar</a>
            @endguest
        </div>
    </nav>
    <div class="container">
        <h1>{{ $title }}</h1>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @isset($mensagemSucesso)
        <div class="alert alert-success">
            {{ $mensagemSucesso }}
        </div>
        @endisset
        {{ $slot }}
    </div>
</body>
</html>
