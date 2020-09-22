<form action="{{ route('courses.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    Department ID : <input type="number" name="department_id"> <br>
    course Name : <input type="text" name="title"> <br>
    course Description : <input type="text" name="description"> <br>
    Start Date : <input type="date" name="start_date"> <br>
    End Date : <input type="date" name="end_date"> <br>
    Image : <input type="file" name="image"> <br>
    <button type="submit">Create course</button>
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