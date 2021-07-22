<?php

namespace App\Models;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Cache;
use Spatie\YamlFrontMatter\YamlFrontMatter;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class Post
{
    public $title;
    public $excerpt;
    public $date;
    public $body;
    public $slug;

    /**
     * construct
     *
     * @param mixed $title
     * @param mixed $excerpt
     * @param mixed $date
     * @param mixed $body
     * @param mixed $slug
     * 
     * @return void
     */
    public function __construct($title, $excerpt, $date, $body, $slug)
    {
        $this->title = $title;
        $this->excerpt = $excerpt;
        $this->date = $date;
        $this->body = $body;
        $this->slug = $slug;
    }

    /**
     * all
     * 
     * @return mixed|object
     */
    public static function all()
    {
        Cache::remember('posts.all', 300, function () {
        });
        return collect(File::files(resource_path("posts")))
            ->map(fn ($file) => YamlFrontMatter::parseFile($file))
            ->map(fn ($document) => new Post(
                $document->matter('title'),
                $document->matter('excerpt'),
                $document->matter('date'),
                $document->body(),
                $document->matter('slug')
            ))
            ->sortBy('date');

        // ----------------------------------------------------------

        // return collect(File::files(resource_path("posts")))
        //     ->map(fn ($file) => YamlFrontMatter::parseFile($file))
        //     ->map(fn ($document) => new Post(
        //         $document->matter('title'),
        //         $document->matter('excerpt'),
        //         $document->matter('date'),
        //         $document->body(),
        //         $document->matter('slug')
        //     ))
        //     ->sortBy('date');

        // ----------------------------------------------------------

        // return collect(File::files(resource_path("posts")))
        // ->map(function ($file) {
        //     return YamlFrontMatter::parseFile($file);
        // })
        // ->map(function ($document) {
        //     return new Post(
        //         $document->matter('title'),
        //         $document->matter('excerpt'),
        //         $document->matter('date'),
        //         $document->body(),
        //         $document->matter('slug')
        //     );
        // });


        // ----------------------------------------------------------

        // $files = File::files(resource_path("posts"));
        // return collect($files)
        //     ->map(function ($file) {
        //         $document = YamlFrontMatter::parseFile($file);
        //         return new Post(
        //             $document->matter('title'),
        //             $document->matter('excerpt'),
        //             $document->matter('date'),
        //             $document->body(),
        //             $document->matter('slug')
        //         );
        //     });

        // ---------------------------------------------------------- 

        // return array_map(function ($file) {
        //     $document = YamlFrontMatter::parseFile($file);
        //     return new Post(
        //         $document->matter('title'),
        //         $document->matter('excerpt'),
        //         $document->matter('date'),
        //         $document->body(),
        //         $document->matter('slug')
        //     );
        // }, $files);

        //----------------------------------------------------------

        // $posts = [];
        // foreach ($files as $file) {
        //     $document = YamlFrontMatter::parseFile($file);
        //     $posts[] = new Post(
        //         $document->matter('title'),
        //         $document->matter('excerpt'),
        //         $document->matter('date'),
        //         $document->body(),
        //         $document->slug
        //     );
        // }
        // return $posts;
    }

    /**
     * find
     *
     * @param string $slug
     *
     * @return mixed|object
     */
    public static function find($slug)
    {
        return static::all()->firstWhere('slug', $slug);
    }

    public static function findOrFail($slug)
    {
        $post = static::all()->firstWhere('slug', $slug);

        if (!$post) {
            throw new ModelNotFoundException();
        }

        return $post;
    }
}
