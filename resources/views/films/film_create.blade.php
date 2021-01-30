@extends('layouts.app')

@section('content')
    @include('partials.alert')
    <a href="{{ route('all_films') }}">
        List of films
    </a>

    <form action={{ route('film_store') }} method="post">
        @csrf
        <label for="title">
            Title:
            <input type="text" name="title">
        </label>

        <label for="release_date">
            Release date:
            <input type="date" name="release_date">
        </label>
{{--TODO use Vue to add film to many categories--}}
        <label for="genre">
            Genre:
            <select name="genres" id="genres">
                @foreach($genres as ['id' => $id, 'name' => $name])
                    <option value={{ $id }}>
                        {{ $name }}
                    </option>
                @endforeach
            </select>
        </label>

        <button type="submit">
            Save
        </button>
    </form>
@endsection


{{--@section('script')--}}
{{--    <script>--}}

{{--    </script>--}}
{{--@endsection--}}

