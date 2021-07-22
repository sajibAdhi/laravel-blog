@extends('layout')

@section('content')
    <article>
        <h1>
            {{ $post->title }}
        </h1>
        <div> {!! $post->body !!} </div>
    </article>
    <span><a href="{{ url('/posts') }}">Go Back</a></span>
@endsection
