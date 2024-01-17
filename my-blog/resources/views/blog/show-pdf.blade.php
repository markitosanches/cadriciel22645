<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
    <h2>{{ $blogPost->title }}</h2>
    <hr>
    <p>
        {!! $blogPost->body !!}
    </p>
    <p>
        <strong>Author:</strong> {{ $blogPost->blogHasUser?->name }}
    </p>
    <p>
        <strong>Category:</strong> {{ $blogPost->blogHasCategory?->category }}
    </p>
</body>
</html>

