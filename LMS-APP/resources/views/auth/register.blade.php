@extends('layouts.app')

@section('content')
<form action="{{ route('register') }}" method="POST">
    @csrf
    Full Name : <input type="text" name="full_name"> <br>
    User Name : <input type="text" name="username"> <br>
    Email : <input type="text" name="email"> <br>
    Password : <input type="password" name="password"> <br>
    Confirm Password : <input type="password" name="password_confirmation"> <br>
    <button type="submit">Register</button>
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
