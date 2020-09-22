<form action="{{ route('course-materials.update', $course_material->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    Course Material Topic ID : <input type="number" name="course_material_topic_id" value="{{ $course_material->course_material_topic_id }}"> <br>
    Title : <input type="text" name="title" value="{{ $course_material->title }}"> <br>
    Description : <input type="text" name="description" value="{{ $course_material->description }}"> <br>
    Image : <input type="file" name="course_material_file"> <br>
    <button type="submit">Save</button>
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