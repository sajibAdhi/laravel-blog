@extends('components.layout')

@section('content')
    @foreach ($posts as $post)
        <article>
            <h1>
                <a href="{{ url("/posts/$post->slug") }}">
                    {{ $post->title }}
                </a>
            </h1>
            <div>
                {{ $post->excerpt }}
            </div>
            <p>
                <a href="#">
                    {{ $post->category->name }}
                </a>
            </p>
        </article>
    @endforeach
@endsection
