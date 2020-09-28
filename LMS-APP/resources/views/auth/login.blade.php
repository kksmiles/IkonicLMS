@extends('layouts.app')

@section('content')
<form action="{{ route('login') }}" method="POST">
    @csrf
    User Name : <input type="text" name="username"> <br>
    Password : <input type="password" name="password"> <br>
    <input type="checkbox" name="remember"> Remember password?
    <button type="submit">Login</button>
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

@endsection
