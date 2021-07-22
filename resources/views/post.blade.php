<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>My Blog</title>

    <link rel="stylesheet" href="<?= url("css/app.css");?>">
</head>
<body>
        <article>
            <h1>
                <a href="<?= url("/posts/{$post->slug}") ?>">
                <?= $post->title ?>
                </a>
            </h1>
            <p><?= $post->body?></p>
        </article>
        <span><a href="/posts">Go Back</a></span>

</body>
</html>