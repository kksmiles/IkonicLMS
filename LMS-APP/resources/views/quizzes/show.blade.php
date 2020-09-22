<h1>Associated Course : {{ $quiz->course->title }}</h1>
<h1>Quiz Title : {{ $quiz->title }} </h1>
<h2>Quiz Description : {{ $quiz->description }} </h2>
<p>Due Date : {{ $quiz->due_date }} </p>
<p>Attempts Allowed : {{ $quiz->attempts_allowed }} </p>
<p>Pass Percentage : {{ $quiz->pass_percentage }} </p>
<p>Grading Method : {{ $quiz->grading_method }} </p>

@foreach($quiz->questions as $question)
    {{ $question->question }}
    @foreach($question->options as $option)
        {{ $option->option }}
    @endforeach
@endforeach


