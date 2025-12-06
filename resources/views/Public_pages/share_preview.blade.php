<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="utf-8">
    <!--Favicon-->
    <link rel="shortcut icon" href="{{ asset('style/reader/') }}/images/favicon.png" type="image/x-icon" />
    <link rel="icon" href="{{ asset('style/reader/') }}/images/favicon.png" type="image/x-icon" />

    @if (!isset($blog))
        <title>Bulunamadı</title>
    @else
        <title>{{ $blog->title }}</title>

        <meta property="og:title" content="{{ $blog->title }}" />
        <meta property="og:description"
            content="{{ \Illuminate\Support\Str::limit(strip_tags($blog->description), 160) }}" />
        <meta property="og:image" content="{{ asset('blog_images/cover_photos/' . $blog->cover_photo) }}" />
        <meta property="og:url" content="{{ route('blog_share', $blog->id) }}" />
        <meta property="og:type" content="article" />

        <meta name="twitter:card" content="summary_large_image">
        <meta name="twitter:title" content="{{ $blog->title }}">
        <meta name="twitter:description"
            content="{{ \Illuminate\Support\Str::limit(strip_tags($blog->description), 160) }}">
        <meta name="twitter:image" content="{{ asset('blog_images/cover_photos/' . $blog->cover_photo) }}">
    @endif

</head>

<body>
    @if (!isset($blog))
        <p>Bulunamadı</p>
    @else
        <p>
            Bu yazıyı okumak için
            <a href="{{ route('blogs.show', $blog->id) }}">giriş yap</a>.
        </p>
    @endif

</body>

</html>
