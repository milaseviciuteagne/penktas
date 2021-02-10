@extends('layouts.app')
@section('content')
    <h1>Welcome page</h1>
    {{-- @if ($var === "1")
        First section!
    @elseif ($var === "2")
        Second section!
    @endif --}}
    {{-- @foreach($letters as $letter)
        <h1>{{ $letter }}</h1>
        <br>
    @endforeach --}}
    {{-- {{ $person->name . " " . $person->age }} --}}
    {{-- @if ($people)
        @foreach($people as $person)
            {{ $person->age }}
            {{ $person->name }}
            <br>
        @endforeach
    @endif --}}
@endsection
