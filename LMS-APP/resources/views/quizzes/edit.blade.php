<form action="{{ route('quizzes.update',  $quiz->id) }}" method="POST">
    @csrf
    @method('PATCH')
    Course ID : <input type="number" name="course_id" value="{{ $quiz->course_id }}"> <br>
    Quiz Title: <input type="text" name="title" value="{{ $quiz->title }}"> <br>
    Description : <input type="text" name="description" value="{{ $quiz->description }}"> <br>
    Due Date : <input type="text" name="due_date" value="{{ $quiz->due_date }}"> <br>
    Attempts Allowed : <input type="number" name="attempts_allowed" value="{{ $quiz->attempts_allowed }}"> <br>
    Pass percentage : <input type="number" name="pass_percentage" value="{{ $quiz->pass_percentage }}"> <br>
    Grading Method : <input type="text" name="grading_method" value="{{ $quiz->grading_method }}"> <br>
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