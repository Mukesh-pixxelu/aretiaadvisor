<x-guest-layout>
    @if (session('status'))
        <p class="status">{{ session('status') }}</p>
    @endif

    <h1>Log in</h1>

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <label for="email">Email</label>
        <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus>

        @foreach ($errors->get('email') as $error)
            <p class="error">{{ $error }}</p>
        @endforeach

        <label for="password">Password</label>
        <input id="password" type="password" name="password" required>

        @foreach ($errors->get('password') as $error)
            <p class="error">{{ $error }}</p>
        @endforeach

        <label class="remember">
            <input id="remember_me" type="checkbox" name="remember">
            Remember me
        </label>

        <button type="submit">Log in</button>
    </form>
</x-guest-layout>