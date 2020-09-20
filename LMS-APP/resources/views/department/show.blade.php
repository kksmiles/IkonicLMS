<h1>Department Name : {{ $department->name }}</h1>
<p>Description : {{ $department->description }}</p>
image : <img src="{{$department->image}}" alt="">

<h2>Associated Courses</h2>
<ul>
    @foreach($department->courses as $course)
        <a href="{{ route('courses.show', $course->id) }}">
            <li>{{ $course->title }}</li>
        </a>
    @endforeach
</ul>