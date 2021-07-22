<?php

namespace App\Models;

use Illuminate\Support\Facades\File;
use Spatie\YamlFrontMatter\YamlFrontMatter;

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
        return cache()->rememberForever('posts.all', function () {
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
        });

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
}
