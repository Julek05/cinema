@extends('layouts.app')

@section('content')
    <a href="{{ route('genre_create') }}">
        Add new genre
    </a><br/><br/>
        @include('partials.genres', ['genres' => $genres])
@endsection
