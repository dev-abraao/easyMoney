<x-layout>
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
</x-layout>