<div class="container">
    <ul>
        @foreach ($quizzes as $quiz)
       
            <li>
                <a href="{{ route('quizzes.show', $quiz->id) }}">
                    {{ $quiz->title }}
                </a>  
                <form action="{{ route('quizzes.destroy', $quiz->id) }}" method="POST">
                    @method('DELETE')
                    @csrf
                    <a href="{{ route('quizzes.edit', $quiz->id) }}">
                        edit
                    </a>  
                    <button type="submit">Delete</button>
                </form>
            </li>
        

        @endforeach
    </ul>
</div>

<a href="{{ route('quizzes.create') }}">Create new quiz</a>
