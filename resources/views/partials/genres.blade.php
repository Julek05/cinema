
@foreach($genres as ['id' => $id, 'name' => $name, 'active' => $active])
    <form action="{{ route('genre_delete', [$id]) }}" method='post'>
        <input type="hidden" name="_method" value="delete">
        @csrf
        <h5>{{ $name }}</h5>
        <button onclick="return confirm('Are you sure?')" type="submit">
            delete
        </button>
        <a href="{{ route('genre_edit', [$id]) }}" type="button">
            edit
        </a>

        <a href="{{ route('films_for_genre', [$name]) }}">
            {{ "films for {$name}" }}:
        </a>

        <label>
            <input type="checkbox" @if($active === ACTIVE) checked='checked' @endif disabled>
        </label>
    </form>
@endforeach
