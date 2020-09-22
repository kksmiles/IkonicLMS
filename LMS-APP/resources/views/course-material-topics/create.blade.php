<form action="{{ route('course-material-topics.store') }}" method="POST">
    @csrf
    Course ID : <input type="number" name="course_id"> <br>
    course Name : <input type="text" name="title"> <br>
    course Description : <input type="text" name="description"> <br>
    <input type="checkbox" name="hidden" value="1" checked>
    <label for="hidden"> Hidden </label><br>
    <button type="submit">Create course material topic</button>
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