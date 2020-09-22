<h1>course Name : {{ $course->title }}</h1>
<p>Description : {{ $course->description }}</p>
<p>Start Date : {{ $course->start_date }}</p>
<p>End Date : {{ $course->end_date }}</p>
image : <img src="{{ $course->image }}" alt="">
<br>

<a href="{{ route('departments.show', $course->department_id) }}"> Associated Department : {{ $course->department->name }}</a>
<br>
Course Material Topics : 
@foreach($course->course_material_topics as $course_material_topic)
    <li>
        <a href="{{ route('course-material-topics.show', $course_material_topic->id) }}">  
            {{ $course_material_topic->title }}
        </a>
        @foreach($course_material_topic->course_materials as $course_material)
            <li>
                <a href="{{ route('course-materials.show', $course_material->id) }}">  
                    {{ $course_material->title }}
                </a>
            </li>
        @endforeach
    </li>
@endforeach
