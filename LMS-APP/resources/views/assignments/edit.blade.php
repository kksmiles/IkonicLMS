<form action="{{ route('assignments.update', $assignment->id    ) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PATCH')
    Course Material Topic ID : <input type="number" name="course_material_topic_id" value="{{ $assignment->course_material_topic_id }}"> <br>
    Title : <input type="text" name="title" value="{{ $assignment->title }}"> <br>
    Description : <input type="text" name="description" value="{{ $assignment->description }}"> <br>
    Full Grade : <input type="number" name="full_grade" value="{{ $assignment->full_grade }}"> <br>
    Due Date : <input type="date" name="due_date" value="{{ $assignment->due_date }}"> <br>
    File : <input type="file" name="assignment_file"> <br>
    <button type="submit">Create Assignment</button>
</form>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif