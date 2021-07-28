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
                <?php
                    /**
                     * @todo on Hold
                     * /
                    ?>
                <a href="{{ url("catagories/$posts->category->id") }}">
                    {{ $post->category->name }}
                </a>
            </p>
        </article>
    @endforeach
@endsection
