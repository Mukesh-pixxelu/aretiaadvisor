<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>{{ $caseFile->title }}</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <main class="page">
        <p><a href="{{ route('cases.index') }}">Back to cases</a></p>
        @if (session('status'))
            <p class="status">{{ session('status') }}</p>
        @endif

        <form method="POST" action="{{ route('cases.subject.store', $caseFile) }}">
            @csrf

            <label for="first_name">First name</label>
            <input id="first_name" type="text" name="first_name" value="{{ old('first_name', $caseFile->subject->first_name ?? '') }}" required>

            <label for="middle_name">Middle name</label>
            <input id="middle_name" type="text" name="middle_name" value="{{ old('middle_name', $caseFile->subject->middle_name ?? '') }}">

            <label for="last_name">Last name</label>
            <input id="last_name" type="text" name="last_name" value="{{ old('last_name', $caseFile->subject->last_name ?? '') }}" required>

            <label for="ssn_masked">Masked SSN</label>
            <input id="ssn_masked" type="text" name="ssn_masked" value="{{ old('ssn_masked', $caseFile->subject->ssn_masked ?? '') }}" required>

            <label for="date_of_birth">Date of birth</label>
            <input id="date_of_birth" type="date" name="date_of_birth" value="{{ old('date_of_birth', optional($caseFile->subject?->date_of_birth)->toDateString()) }}">

            <label for="gender">Gender</label>
            <input id="gender" type="text" name="gender" value="{{ old('gender', $caseFile->subject->gender ?? '') }}">

            <label for="age">Age</label>
            <input id="age" type="number" name="age" value="{{ old('age', $caseFile->subject->age ?? '') }}">

            <label for="employer">Employer</label>
            <input id="employer" type="text" name="employer" value="{{ old('employer', $caseFile->subject->employer ?? '') }}">

            @foreach ($errors->all() as $error)
                <p class="error">{{ $error }}</p>
            @endforeach

            <button type="submit">Save subject</button>
        </form>

        <h2>Aliases</h2>

        <form method="POST" action="{{ route('cases.aliases.store', $caseFile) }}">
            @csrf
            <label for="alias_name">Another name</label>
            <input id="alias_name" type="text" name="name" required>
            <button type="submit">Add alias</button>
        </form>

        @if ($caseFile->subject && $caseFile->subject->aliases->isEmpty())
            <p>No aliases yet.</p>
        @elseif ($caseFile->subject)
            <ul>
                @foreach ($caseFile->subject->aliases as $alias)
                    <li>{{ $alias->name }}</li>
                @endforeach
            </ul>
        @endif


        <h2>Addresses</h2>

        <form method="POST" action="{{ route('cases.addresses.store', $caseFile) }}">
            @csrf
            <label for="address_line">Address</label>
            <input id="address_line" type="text" name="line" required>
            <button type="submit">Add address</button>
        </form>

        @if ($caseFile->subject && $caseFile->subject->addresses->isEmpty())
            <p>No addresses yet.</p>
        @elseif ($caseFile->subject)
            <ul>
                @foreach ($caseFile->subject->addresses as $address)
                    <li>{{ $address->line }}</li>
                @endforeach
            </ul>
        @endif


        <h2>Relatives</h2>

        <form method="POST" action="{{ route('cases.relatives.store', $caseFile) }}">
            @csrf
            <label for="relative_name">Name</label>
            <input id="relative_name" type="text" name="name" required>

            <label for="relative_relation">Relation</label>
            <input id="relative_relation" type="text" name="relation" required>

            <button type="submit">Add relative</button>
        </form>

        @if ($caseFile->subject && $caseFile->subject->relatives->isEmpty())
            <p>No relatives yet.</p>
        @elseif ($caseFile->subject)
            <ul>
                @foreach ($caseFile->subject->relatives as $relative)
                    <li>{{ $relative->name }} — {{ $relative->relation }}</li>
                @endforeach
            </ul>
        @endif

    </main>
</body>
</html>