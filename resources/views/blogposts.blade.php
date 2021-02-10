@extends('layouts.app')
@section('content')

    {{-- Validation error, for invalid incoming data display logic --}}
    @if ($errors->any())
        <div>
            @foreach ($errors->all() as $error)
                <p style="color: red">{{ $error }}</p>
            @endforeach
        </div>
    @endif

    {{-- Database error/success display logic --}}
    @if (session('status_success'))
        <p style="color: green"><b>{{ session('status_success') }}</b></p>
    @else
        <p style="color: red"><b>{{ session('status_error') }}</b></p>
    @endif

    @foreach ($posts as $post)
        <h1>{{ $post['title'] }}</h1>
        <p>{{ $post['text'] }}</p>
        <p style="font-size: 10px">Comment count: {{ count($post->comments) }} 
            | <a href="{{ route('posts.show', $post['id']) }}">View post details and comment on it</a>
            | Author: {{ $post['user']['name'] }} , {{ $post['user']['email'] }}</p>
        {{-- Hide buttons if the user is not logged in  --}}
        @if (auth()->check())
            <div class="btn-group" style="overflow: auto">
                @if (auth()->user()->id === $post['user_id'])
                    <form style='float: left;' action="{{ route('posts.destroy', $post['id']) }}" method="POST">
                        @method('DELETE') @csrf
                        <input class="btn btn-danger" type="submit" value="DELETE"> 
                    </form>
                @endif
                &nbsp;
                <form style='float: left;' action="{{ route('posts.show', $post['id']) }}" method="GET">
                    <input class="btn btn-primary" type="submit" value="UPDATE">
                </form>
            </div>
        @endif
        <br>
        <hr>
    @endforeach
    <hr>
    <form method="POST" action="/posts">
        @csrf

        @error('title')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <label for="title">Post title:</label><br>
        <input type="text" id="title" name="title"><br>

        <br>
        @error('text')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <label for="text">Post text:</label><br>
        <input type="text" id="text" name="text"><br><br>

        <input class="btn btn-primary" type="submit" value="Submit">
    </form>
@endsection