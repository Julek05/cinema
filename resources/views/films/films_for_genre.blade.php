@extends('layouts.app')

@section('content')
    <a href="{{ route('film_create') }}">
        Add new film
    </a><br/><br/>
    <h4>{{ $genre->name }}:</h4>
    @include('partials.films', ['films' => $genre->films])
@endsection
