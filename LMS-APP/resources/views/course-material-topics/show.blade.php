<h1>Course Material Topic : {{ $course_material_topic->title }}</h1>
<p>Description : {{ $course_material_topic->description }}</p>
<p>Hidden : {{ $course_material_topic->hidden }}</p>
<br>
Associated Course : 
<a href="{{ route('courses.show', $course_material_topic->course_id) }}"> 
    {{ $course_material_topic->course->title }}
</a>
<br>
Course Materials : 
@foreach($course_material_topic->course_materials as $course_material)
<li>
    <a href="{{ route('course-materials.show', $course_material->id) }}">  
        {{ $course_material->title }}
    </a>
</li>
@endforeach

