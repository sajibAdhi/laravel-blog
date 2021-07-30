<x-layout>
    @foreach ($posts as $post)
        <article>
            <h1>

                <a href="{{ url("/posts/$post->slug") }}">
                    {{ $post->title }}
                </a>
            </h1>
            <p>
                By <a href="{{ url('/authors/' . $post->author->username) }}">{{ $post->author->name }}</a> in
                <a href="{{ url('categories/' . $post->category->slug) }}">
                    {{ $post->category->name }}
                </a>
            </p>
            <div>
                <p>
                    {{ $post->excerpt }}
                </p>
            </div>
        </article>
    @endforeach
</x-layout>
