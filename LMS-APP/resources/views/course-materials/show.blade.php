<h1>Title : {{ $course_material->title }}</h1>
<p>Description : {{ $course_material->description }}</p>
<a href="{{ $course_material->course_material_file }}" download>
    Download {{ $course_material->title }}
</a>
<br>
Associated Topic :
<a href="{{ route('course-material-topics.show', $course_material->course_material_topic_id) }}"> 
    {{ $course_material->course_material_topic->title }}
</a>
