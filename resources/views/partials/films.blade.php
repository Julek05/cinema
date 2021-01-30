
@foreach($films as ['id' => $id, 'title' => $title, 'release_date' => $release_date])
    <form action={{ route('film_delete', [$id]) }} method='post'>
        @csrf
        <h5>{{ $title }}</h5>
        <button onclick="return confirm('Are you sure?')" type="submit">
            delete
        </button>
        <ul>
            <li>{{ $release_date }}</li>
        </ul>
    </form>
@endforeach
