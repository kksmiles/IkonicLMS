<div class="container">
    <ul>
        @foreach ($departments as $department)
       
            <li>
                <a href="{{ route('departments.show', $department->id) }}">
                    {{ $department->name }}
                </a>  
                <form action="{{ route('departments.destroy', $department->id) }}" method="POST">
                    @method('DELETE')
                    @csrf
                    <a href="{{ route('departments.edit', $department->id) }}">
                        edit
                    </a>  
                    <button type="submit">Delete</button>
                </form>
            </li>
        

        @endforeach
    </ul>
</div>

<a href="{{ route('departments.create') }}">Create new Department</a>
