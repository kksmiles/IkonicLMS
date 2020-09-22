<div class="container">
    <ul>
        @foreach ($course_material_topics as $course_material_topic)
       
            <li>
                <a href="{{ route('course-material-topics.show', $course_material_topic->id) }}">
                    {{ $course_material_topic->title }}
                </a>  
                <form action="{{ route('course-material-topics.destroy', $course_material_topic->id) }}" method="POST">
                    @method('DELETE')
                    @csrf
                    <a href="{{ route('course-material-topics.edit', $course_material_topic->id) }}">
                        edit
                    </a>  
                    <button type="submit">Delete</button>
                </form>
            </li>
        

        @endforeach
    </ul>
</div>

<a href="{{ route('course-material-topics.create') }}">Create new course_material_topic</a>
