<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Cases</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <main class="page">
        <h1>Cases</h1>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit">Log out</button>
        </form>

        <form method="POST" action="{{ route('cases.store') }}">
            @csrf
            <label for="title">Case title</label>
            <input id="title" type="text" name="title" value="{{ old('title') }}" required>

            @foreach ($errors->get('title') as $error)
                <p class="error">{{ $error }}</p>
            @endforeach

            <button type="submit">Open case</button>
        </form>

        @if ($cases->isEmpty())
            <p>No cases yet.</p>
        @else
            <ul>
                @foreach ($cases as $case)
                    <li>
                        <a href="{{ route('cases.show', $case) }}">{{ $case->title }}</a>
                        — {{ $case->status }}
                    </li>
                @endforeach
            </ul>
        @endif
    </main>
</body>
</html>