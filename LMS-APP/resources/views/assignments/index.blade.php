<div class="container">
    <ul>
        @foreach ($assignments as $assignment)
       
            <li>
                <a href="{{ route('assignments.show', $assignment->id) }}">
                    {{ $assignment->title }}
                </a>  
                <form action="{{ route('assignments.destroy', $assignment->id) }}" method="POST">
                    @method('DELETE')
                    @csrf
                    <a href="{{ route('assignments.edit', $assignment->id) }}">
                        edit
                    </a>  
                    <button type="submit">Delete</button>
                </form>
            </li>
        

        @endforeach
    </ul>
</div>

<a href="{{ route('assignments.create') }}">Create new course</a>
