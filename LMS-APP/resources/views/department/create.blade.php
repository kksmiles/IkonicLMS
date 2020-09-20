<form action="{{ route('departments.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    Department Name : <input type="text" name="name"> <br>
    Department Description : <input type="text" name="description"> <br>
    Image : <input type="file" name="image"> <br>
    <button type="submit">Create Department</button>
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