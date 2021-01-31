@extends('layouts.app')

@section('content')
    <a href="{{ route('film_create') }}">
        Add new film
    </a><br/><br/>
    @foreach($genres as $genre)
        <a href="{{ route('films_for_genre', [$genre->name]) }}" style="font-size: 40px">{{ $genre->name }}:</a>
        @include('partials.films', ['films' => $genre->films])
    @endforeach
@endsection
