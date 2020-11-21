@extends('layouts.master')

@section('title')
    {{$user->full_name}}'s profile
@endsection

@section('body')

    {{$user->full_name}}

@endsection