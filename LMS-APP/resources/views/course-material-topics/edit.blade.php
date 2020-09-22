<form action="{{ route('course-material-topics.update',  $course_material_topic->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PATCH')
    Course ID : <input type="number" name="course_id" value="{{ $course_material_topic->course_id }}"> <br>
    course Name : <input type="text" name="title" value="{{ $course_material_topic->title }}"> <br>
    course Description : <input type="text" name="description" value="{{ $course_material_topic->description }}"> <br>
    
        <input type="checkbox" name="hidden" value="1" 
        @if($course_material_topic->hidden)
            checked
        @endif
        >
    <label for="hidden"> Hidden </label><br>
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