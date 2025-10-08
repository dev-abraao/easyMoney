<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&family=Oswald:wght@200..700&display=swap" rel="stylesheet">

        <title>{{  $title ?? config('app.name') }}</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])

    </head>
    <body>
        <div>
            <form action="{{ route('login') }}" method="POST">
                @csrf
                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif
                <input type="email" name="email" placeholder="E-mail" value="{{ old('email') }}" required>
                    @error('email')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                <input type="password" name="password" placeholder="Password" required>
                    @error('password')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    @error('auth')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                <button type="submit">Log in</button>
            </form>
        </div>

        <a href="{{ route('register.view') }}">Sign up</a>
    </body>
</html>