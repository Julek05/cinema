@extends('layouts.app')

@section('content')
    @include('partials.alert')
    <a href="{{ route('all_genres') }}">
        List of genres
    </a>

    <form action="{{ route('genre_store') }}" method="post">
        @csrf
        <label for="name">
            Name:
            <input type="text" name="name">
        </label>

        <label for="active">
            Active
            <input type="checkbox" name="active" value="1">
        </label>

        <button type="submit">
            Save
        </button>
    </form>
@endsection
