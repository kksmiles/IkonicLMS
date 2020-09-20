<h1>course Name : {{ $course->title }}</h1>
<p>Description : {{ $course->description }}</p>
<p>Start Date : {{ $course->start_date }}</p>
<p>End Date : {{ $course->end_date }}</p>
image : <img src="{{ $course->image }}" alt="">
<br>

<a href="{{ route('departments.show', $course->department_id) }}"> Associated Department : {{ $course->department->name }}</a>
