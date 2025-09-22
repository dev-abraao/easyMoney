<x-layout>

    @if (!Auth::user()->balance)
    <x-create-balance-modal/>
    @endif

    <div>
        <h1>User Dashboard</h1>
        <p>Welcome to your dashboard, {{ Auth::user()->name }}!</p>
        @if (Auth::user()->balance)
            <p>Balance: <span id="balance-amount">{{ Auth::user()->balance->amount }}</span>$</p>
        @else
            <p >Balance:<span id="balance-amount"></span></p>
        @endif
        <button onclick="openExpenseModal()">+</button>
        <x-create-expense-modal/>
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit">Logout</button>
        </form>
    </div>
</x-layout>