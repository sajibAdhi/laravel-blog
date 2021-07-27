@extends('components.layout')

@section('content')
    <article>
        <h1>
            {{ $post->title }}
        </h1>
        <p><a href="#">{{ $post->category->name }}</a></p>
        <div>
            <p> {{ $post->body }} </p>
        </div>
    </article>
    <span><a href="{{ url('/posts') }}">Go Back</a></span>
@endsection
