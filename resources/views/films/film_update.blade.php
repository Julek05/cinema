@extends('layouts.app')

@section('content')
    @include('partials.alert')
    <a href="{{ route('all_films') }}">
        List of films
    </a>

    <form action={{ route('film_update', [$film->id]) }} method="post">
        <input type="hidden" name="_method" value="put">
        @csrf
        <label for="title">
            Title:
            <input type="text" name="title" value={{ $film->title }}>
        </label>

        <label for="release_date">
            Release date:
            <input type="date" name="release_date" value={{ $film->release_date }}>
        </label>
        <added-genres :genres={{ $genres }} :actuallyAddedGenres={{ $film->genres->pluck('id') }}></added-genres>

        <button type="submit">
            Save
        </button>
    </form>
@endsection
