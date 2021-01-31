@extends('layouts.app')

@section('content')
    @include('partials.alert')
    <a href="{{ route('all_films') }}">
        List of films
    </a>

    <form action="{{ route('film_store') }}" method="post">
        @csrf
        <label for="title">
            Title:
            <input type="text" name="title">
        </label>

        <label for="release_date">
            Release date:
            <input type="date" name="release_date">
        </label>
        <added-genres :genres={{ $genres }} :actuallyAddedGenres={{ json_encode([]) }} ></added-genres>

        <button type="submit">
            Save
        </button>
    </form>
@endsection
