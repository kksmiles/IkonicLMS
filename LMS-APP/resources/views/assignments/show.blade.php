<h1>Title : {{ $assignment->title }}</h1>
<p>Description : {{ $assignment->description }}</p>
<a href="{{ $assignment->assignment_file }}" download>
    Download {{ $assignment->title }}
</a>
<br>
Associated Topic :
<a href="{{ route('course-material-topics.show', $assignment->course_material_topic_id) }}"> 
    {{ $assignment->course_material_topic->title }}
</a>
