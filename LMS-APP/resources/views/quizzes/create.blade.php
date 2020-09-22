<form action="{{ route('quizzes.store') }}" method="POST">
    @csrf
    Course ID : <input type="number" name="course_id"> <br>
    Quiz Title: <input type="text" name="title"> <br>
    Description : <input type="text" name="description"> <br>
    Due Date : <input type="text" name="due_date"> <br>
    Attempts Allowed : <input type="number" name="attempts_allowed"> <br>
    Pass percentage : <input type="number" name="pass_percentage"> <br>
    Grading Method : <input type="text" name="grading_method"> <br>
    <button type="submit">Create Quiz</button>
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