<x-layout>

    @if (!Auth::user()->balance)
    <x-create-balance-modal/>
    @endif

    <div>
        <h1>User Dashboard</h1>
        <p>Welcome to your dashboard, {{ Auth::user()->name }}!</p>
        @if (Auth::user()->balance)
            <p>Balance: {{ Auth::user()->balance->amount }}$</p>
        @else
            <p id="balance-amount"></p>
        @endif
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit">Logout</button>
        </form>
    </div>
</x-layout>