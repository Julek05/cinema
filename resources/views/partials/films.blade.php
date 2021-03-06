
@foreach($films as ['id' => $id, 'title' => $title, 'release_date' => $release_date])
    <form action="{{ route('film_delete', [$id]) }}" method='post'>
        <input type="hidden" name="_method" value="delete">
        @csrf
        <h5>{{ $title }}</h5>
        <button onclick="return confirm('Are you sure?')" type="submit">
            delete
        </button>
        <a href="{{ route('film_edit', [$id]) }}" type="button">
            update
        </a>
        <ul>
            <li>{{ $release_date }}</li>
        </ul>
    </form>
@endforeach
