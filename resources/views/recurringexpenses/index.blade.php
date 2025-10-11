<x-layout>
    <div>
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
    </div>
    <form action="{{ route('recurring.expenses.store') }}" method="POST">
        @csrf
        <div>
            @error('name')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required>
        </div>
        <div>
            @error('description')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <label for="description">Description:</label>
            <input type="text" id="description" name="description" required>
        </div>
        <div>
            @error('amount3')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <label for="amount3">Amount:</label>
            <x-amount id="amount3" name="amount3" submitButtonId="submit-recurring-expense" :validateBalance="true"/>
        </div>
        <div>
            @error('frequency')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <label for="frequency">Frequency:</label>
            <select id="frequency" name="frequency" required>
            @foreach($frequencies as $frequency)
                <option value="{{ $frequency->value }}">{{ ucfirst($frequency->value) }}</option>
            @endforeach
            </select>
        </div>
        <button type="submit" id="submit-recurring-expense">Add Recurring Expense</button>
    </form>
</x-layout>
