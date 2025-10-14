<x-layout> 
    <div>
        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
        <h1>Cards</h1>
        <p>Manage your cards here.</p>
            <form action="{{ route('cards.store') }}" method="POST">
                @csrf
                <div>
                    @error('name')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <label for="name">Name:</label>
                    <input type="text" id="name" name="name" required>
                </div>
                <div>
                    @error('last4')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <label for="last4">Last four digits::</label>
                    <input type="text" id="last4" name="last4" required>
                </div>
                <div>
                    @error('limit')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <label for="limit">Limit:</label>
                    <input type="text" id="limit" name="limit" required>
                </div>
                <button type="submit" id="submit-card">Add Card</button>
            </form>
    </div>
    <div>
        @forelse($cards as $card)
            <div>
                <h2>{{ $card->name }} <span>&#40;{{ $card->last4 }}&#41;</span></h2>
                <p>Last 4 Digits: </p>
                <p>Limit: {{ $card->limit }}</p>
            </div>
        @empty
            <p>No cards found.</p>
        @endforelse
    </div>
</x-layout>