<div class="container">
    <ul>
        @foreach ($course_materials as $course_material)
       
            <li>
                <a href="{{ route('course-materials.show', $course_material->id) }}">
                    {{ $course_material->title }}
                </a>  
                <form action="{{ route('course-materials.destroy', $course_material->id) }}" method="POST">
                    @method('DELETE')
                    @csrf
                    <a href="{{ route('course-materials.edit', $course_material->id) }}">
                        edit
                    </a>  
                    <button type="submit">Delete</button>
                </form>
            </li>
        

        @endforeach
    </ul>
</div>

<a href="{{ route('course-materials.create') }}">Create new course</a>
