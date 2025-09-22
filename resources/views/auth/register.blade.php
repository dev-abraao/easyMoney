<x-layout>
    <div>
        <form action="{{ route('register') }}" method="POST">
            @csrf
            <input type="text" name="name" placeholder="Name" value="{{ old('name') }}" required>
                @error('name')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
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
            <button type="submit">Register</button>
        </form>
    </div>
</x-layout>