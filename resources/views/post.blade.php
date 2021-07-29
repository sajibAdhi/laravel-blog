<x-layout>
    <article>
        <h1>
            {{ $post->title }}
        </h1>
        <p>
            By <a href="#">{{ $post->user->name }}</a> in
            <a href="{{ url('categories/' . $post->category->slug) }}">
                {{ $post->category->name }}
            </a>
        </p>
        <div>
            <p> {{ $post->body }} </p>
        </div>
    </article>
    <span><a href="{{ url('/posts') }}">Go Back</a></span>
</x-layout>
