<form action="{{ route('departments.update', $department->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PATCH')
    Department Name : <input type="text" name="name" value="{{ $department->name }}"> <br>
    Department Description : <input type="text" name="description" value="{{ $department->description }}">
    Image : <input type="file" name="image">
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