<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!--Favicon-->
    <link rel="shortcut icon" href="{{ asset('style/reader/') }}/images/favicon.png" type="image/x-icon" />
    <link rel="icon" href="{{ asset('style/reader/') }}/images/favicon.png" type="image/x-icon" />

    @if (!isset($blog))
        <title>Bulunamadı</title>
    @else
        <title>{{ $blog->title }}</title>

        <meta property="og:title" content="{{ $blog->title }}" />
        <meta property="og:description"
            content="{{ \Illuminate\Support\Str::limit(strip_tags($blog->summery), 160) }}" />
        <meta property="og:image" content="{{ asset('blog_images/cover_photos/' . $blog->cover_photo) }}" />
        <meta property="og:url" content="{{ route('blog_share', $blog->id) }}" />
        <meta property="og:type" content="article" />

        <meta name="twitter:card" content="summary_large_image">
        <meta name="twitter:title" content="{{ $blog->title }}">
        <meta name="twitter:description"
            content="{{ \Illuminate\Support\Str::limit(strip_tags($blog->summery), 160) }}">
        <meta name="twitter:image" content="{{ asset('blog_images/cover_photos/' . $blog->cover_photo) }}">
    @endif

    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: "Inter", system-ui, sans-serif;
            background: #f9fafb;
            height: 100vh;
            display: flex;
            align-items: center;
            /* Dikey ortalama */
            justify-content: center;
            /* Yatay ortalama */
        }

        .container {
            background: white;
            padding: 28px 35px;
            border-radius: 14px;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.08);
            max-width: 400px;
            width: 90%;
            /* Mobil uyum */
            text-align: center;
        }

        .container h2 {
            font-size: 20px;
            margin-bottom: 16px;
            color: #111827;
            font-weight: 600;
        }

        .container p {
            font-size: 15px;
            color: #4b5563;
            margin-bottom: 20px;
        }

        .btn-login {
            display: inline-block;
            padding: 12px 20px;
            background: #2563eb;
            color: white;
            border-radius: 8px;
            text-decoration: none;
            font-size: 15px;
            font-weight: 500;
            transition: 0.15s ease;
        }

        .btn-login:hover {
            background: #1d4ed8;
        }
    </style>

</head>

<body>

    @if (!isset($blog))
        <div class="container">
            <h2>Blog Not Found</h2>
            <p>The content you are trying to share is no longer available.</p>
        </div>
    @else
        <div class="container">
            <h2>{{ $blog->title }}</h2>
            <p>You need to log in to read this article.</p>

            <a href="{{ route('blogs.show', $blog->id) }}" class="btn-login">
                Log In & Open Article
            </a>
        </div>
    @endif

</body>

</html>
