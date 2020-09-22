<form action="{{ route('courses.update', $course->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PATCH')
    Department ID : <input type="number" name="department_id" value="{{ $course->department_id }}"> <br>
    course Name : <input type="text" name="title" value="{{ $course->title }}"> <br>
    course Description : <input type="text" name="description" value="{{ $course->description }}"> <br>
    Start Date : <input type="date" name="start_date" value="{{ $course->start_date }}"> <br>
    End Date : <input type="date" name="end_date" value="{{ $course->end_date }}"> <br>
    Image : <input type="file" name="image"> <br>
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