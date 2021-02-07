@extends('layouts.app')

@section('content')
    @include('partials.alert')
    <a href="{{ route('all_genres') }}">
        List of genres
    </a>

    <form action={{ route('genre_update', [$genre->id]) }} method="post">
        <input type="hidden" name="_method" value="put">
        @csrf
        <label for="name">
            Name:
            <input type="text" name="name" value="{{ $genre->name }}">
        </label>

        <label for="active">
            Active:
            <input type="checkbox" name="active" @if($genre->active === ACTIVE) checked='checked' @endif>
        </label>

        <button type="submit">
            Save
        </button>
    </form>
@endsection
