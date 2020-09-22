<div class="container">
    <ul>
        @foreach ($courses as $course)
       
            <li>
                <a href="{{ route('courses.show', $course->id) }}">
                    {{ $course->title }}
                </a>  
                <form action="{{ route('courses.destroy', $course->id) }}" method="POST">
                    @method('DELETE')
                    @csrf
                    <a href="{{ route('courses.edit', $course->id) }}">
                        edit
                    </a>  
                    <button type="submit">Delete</button>
                </form>
            </li>
        

        @endforeach
    </ul>
</div>

<a href="{{ route('courses.create') }}">Create new course</a>
