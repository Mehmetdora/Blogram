<!doctype html>
<html lang="tr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Untree.co">
    <link rel="shortcut icon" href="favicon.png">
    <meta name="description" content=""/>
    <meta name="keywords" content="bootstrap, bootstrap5"/>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Work+Sans:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- READER CSS -->
    <link rel="stylesheet" href="{{ asset('style/') }}/reader/plugins/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('style/') }}/reader/plugins/themify-icons/themify-icons.css">
    <link rel="stylesheet" href="{{ asset('style/') }}/reader/plugins/slick/slick.css">
    <link rel="stylesheet" href="{{ asset('style/') }}/reader/css/style.css" media="screen">
    <link rel="stylesheet" href="{{ asset('style/reader/css/blogStyle.css') }}">


    <link type="text/css" rel="stylesheet" href="{{asset('Jodit/jodit.min.css')}}"/>
    <link rel="stylesheet" href="{{ asset('highlight/') }}/styles/monokai.css">


    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
          integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.6.2/cropper.css"
          integrity="sha512-087vysR/jM0N5cp13Vlp+ZF9wx6tKbvJLwPO8Iit6J7R+n7uIMMjg37dEgexOshDmDITHYY5useeSmfD1MYiQA=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>


    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">


    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }


        :root {
            --blue: #0071FF;
            --light-blue: #B6DBF6;
            --dark-blue: #005DD1;
            --grey: #f2f2f2;
        }

        .inputs {
            display: flex;
            justify-content: center;

        }

        .container-image {
            max-width: 30%;
            width: 100%;
            background: #fff;
            padding: 30px;
            border-radius: 30px;
        }

        .img-area {
            position: relative;
            width: 100%;
            height: 240px;
            background: var(--grey);
            margin-bottom: 30px;
            border-radius: 15px;
            overflow: hidden;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
        }

        .img-area .icon {
            font-size: 100px;
        }

        .img-area h3 {
            font-size: 20px;
            font-weight: 500;
            margin-bottom: 6px;
        }

        .img-area p {
            color: #999;
        }

        .img-area p span {
            font-weight: 600;
        }

        .img-area img {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            object-position: center;
            z-index: 100;
        }

        .img-area::before {
            content: attr(data-img);
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, .5);
            color: #fff;
            font-weight: 500;
            text-align: center;
            display: flex;
            justify-content: center;
            align-items: center;
            pointer-events: none;
            opacity: 0;
            transition: all .3s ease;
            z-index: 200;
        }

        .img-area.active:hover::before {
            opacity: 1;
        }

        .select-image {
            display: block;
            width: 100%;
            padding: 16px 0;
            border-radius: 15px;
            background: var(--blue);
            color: #fff;
            font-weight: 500;
            font-size: 16px;
            border: none;
            cursor: pointer;
            transition: all .3s ease;
        }

        .select-image:hover {
            background: var(--dark-blue);
        }
    </style>

    {{-- tagify --}}
    <link href="https://cdn.jsdelivr.net/npm/@yaireo/tagify/dist/tagify.css" rel="stylesheet" type="text/css"/>
    <style>
        .tagify--custom-dropdown {
            min-width: 100%;
        }

        .tags-look .tagify__dropdown__item {
            display: inline-block;
            vertical-align: middle;
            border-radius: 3px;
            padding: .3em .5em;
            border: 1px solid #CCC;
            background: #F3F3F3;
            margin: .2em;
            font-size: .85em;
            color: black;
            transition: 0s;
        }

        .tags-look .tagify__dropdown__item--active {
            border-color: black;
        }

        .tags-look .tagify__dropdown__item:hover {
            background: lightyellow;
            border-color: gold;
        }

        .tags-look .tagify__dropdown__item--hidden {
            max-width: 0;
            max-height: initial;
            padding: .3em 0;
            margin: .2em 0;
            white-space: nowrap;
            text-indent: -20px;
            border: 0;
        }
    </style>

    <!-- image cropper css -->
    <style>
        .label {
            cursor: pointer;
        }

        .img-container img {
            max-width: 70%;
        }

        #modal {
            z-index: 1500;
        }

        @media screen and (max-width: 700px) {
            #modal {
                width: 90%;
                left: 5%;
            }
        }
    </style>

    {{-- category selection --}}
    <style>
        :root {
            --primary-color: #4a90e2;
            --secondary-color: #f5f5f5;
            --text-color: #333;
            --border-radius: 8px;
            --transition: all 0.3s ease;
        }

        .select-box {
            z-index: 2;
            position: relative;
            width: 100%;
        }

        .select-box__current {
            border: 2px solid var(--primary-color);
            border-radius: var(--border-radius);
            padding: 12px 16px;
            cursor: pointer;
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: white;
            transition: var(--transition);
        }

        .select-box__current:hover {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .select-box__value {
            color: var(--text-color);
            font-weight: 500;
        }

        .select-box__arrow {
            color: var(--primary-color);
            transition: var(--transition);
        }

        .select-box__list {
            position: absolute;
            top: 100%;
            left: 0;
            right: 0;
            background: white;
            border: 2px solid var(--primary-color);
            border-top: none;
            border-radius: 0 0 var(--border-radius) var(--border-radius);
            list-style: none;
            padding: 0;
            margin: 0;
            max-height: 0;
            overflow-y: auto;
            opacity: 0;
            transition: var(--transition);
        }

        .select-box__list.active {
            max-height: 300px;
            opacity: 1;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .select-box__list-item {
            padding: 12px 16px;
            cursor: pointer;
            transition: var(--transition);
        }

        .select-box__list-item:hover {
            background-color: var(--secondary-color);
        }

        .select-box__search {
            width: 100%;
            padding: 12px 16px;
            border: none;
            border-bottom: 1px solid var(--secondary-color);
            box-sizing: border-box;
            font-size: 14px;
            outline: none;
        }

        .select-box__list-item.hide {
            display: none;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .select-box__list-item {
            animation: fadeIn 0.3s ease;
        }
    </style>

    {{-- sayfa css --}}
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            margin-bottom: 60px;
        }

        h1 {
            text-align: center;
            margin-bottom: 30px;
            color: #2c3e50;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
            color: #34495e;
        }

        input[type="text"],
        textarea,
        select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 16px;
        }

        textarea {
            resize: vertical;
        }

        .cover-image-label {
            display: block;
            position: relative;
            width: 100%;
            aspect-ratio: 16 / 9;
            background-color: #ecf0f1;
            border: 2px dashed #bdc3c7;
            border-radius: 4px;
            cursor: pointer;
            overflow: hidden;
        }

        .cover-image-label img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .cover-image-label span {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: rgba(0, 0, 0, 0.5);
            color: #fff;
            padding: 10px 15px;
            border-radius: 4px;
        }

        #submit-btn {
            display: inline-block;
            background-color: #3498db;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }

        #submit-btn:hover {
            background-color: #2980b9;
        }

        @media (max-width: 700px) {
            .container {
                padding: 10px;
            }

            h1 {
                font-size: 24px;
            }

            .form-group {
                margin-bottom: 15px;
            }

            input[type="text"],
            textarea,
            select {
                font-size: 14px;
            }

            #submit-btn {
                width: 100%;
            }
        }
    </style>

    <title>{{ $site_setting->site_name }}</title>
    @include('Authenticated_pages.layouts.header_style')

</head>

<body>

@include('Authenticated_pages.layouts.header')


<div class="banner text-center">


    <svg class="banner-shape-1" width="39" height="40" viewBox="0 0 39 40" fill="none"
         xmlns="http://www.w3.org/2000/svg">
        <path d="M0.965848 20.6397L0.943848 38.3906L18.6947 38.4126L18.7167 20.6617L0.965848 20.6397Z"
              stroke="#040306" stroke-miterlimit="10"/>
        <path class="path"
              d="M10.4966 11.1283L10.4746 28.8792L28.2255 28.9012L28.2475 11.1503L10.4966 11.1283Z"/>
        <path d="M20.0078 1.62949L19.9858 19.3804L37.7367 19.4024L37.7587 1.65149L20.0078 1.62949Z" stroke="#040306"
              stroke-miterlimit="10"/>
    </svg>

    <svg class="banner-shape-2" width="39" height="39" viewBox="0 0 39 39" fill="none"
         xmlns="http://www.w3.org/2000/svg">
        <g filter="url(#filter0_d)">
            <path class="path"
                  d="M24.1587 21.5623C30.02 21.3764 34.6209 16.4742 34.435 10.6128C34.2491 4.75147 29.3468 0.1506 23.4855 0.336498C17.6241 0.522396 13.0233 5.42466 13.2092 11.286C13.3951 17.1474 18.2973 21.7482 24.1587 21.5623Z"/>
            <path
                d="M5.64626 20.0297C11.1568 19.9267 15.7407 24.2062 16.0362 29.6855L24.631 29.4616L24.1476 10.8081L5.41797 11.296L5.64626 20.0297Z"
                stroke="#040306" stroke-miterlimit="10"/>
        </g>
        <defs>
            <filter id="filter0_d" x="0.905273" y="0" width="37.8663" height="38.1979" filterUnits="userSpaceOnUse"
                    color-interpolation-filters="sRGB">
                <feFlood flood-opacity="0" result="BackgroundImageFix"/>
                <feColorMatrix in="SourceAlpha" type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0"/>
                <feOffset dy="4"/>
                <feGaussianBlur stdDeviation="2"/>
                <feColorMatrix type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.25 0"/>
                <feBlend mode="normal" in2="BackgroundImageFix" result="effect1_dropShadow"/>
                <feBlend mode="normal" in="SourceGraphic" in2="effect1_dropShadow" result="shape"/>
            </filter>
        </defs>
    </svg>


    <svg class="banner-shape-3" width="39" height="40" viewBox="0 0 39 40" fill="none"
         xmlns="http://www.w3.org/2000/svg">
        <path d="M0.965848 20.6397L0.943848 38.3906L18.6947 38.4126L18.7167 20.6617L0.965848 20.6397Z"
              stroke="#040306" stroke-miterlimit="10"/>
        <path class="path"
              d="M10.4966 11.1283L10.4746 28.8792L28.2255 28.9012L28.2475 11.1503L10.4966 11.1283Z"/>
        <path d="M20.0078 1.62949L19.9858 19.3804L37.7367 19.4024L37.7587 1.65149L20.0078 1.62949Z"
              stroke="#040306" stroke-miterlimit="10"/>
    </svg>


    <svg class="banner-border" height="240" viewBox="0 0 2202 240" fill="none"
         xmlns="http://www.w3.org/2000/svg">
        <path
            d="M1 123.043C67.2858 167.865 259.022 257.325 549.762 188.784C764.181 125.427 967.75 112.601 1200.42 169.707C1347.76 205.869 1901.91 374.562 2201 1"
            stroke-width="2"/>
    </svg>
</div>

@include('Authenticated_pages.layouts.spinner')


<div class="container">
    @include('Public_pages.layouts._message')

    <form action="{{ route('myBlogs.edited') }}" method="post" id="blogForm" enctype="multipart/form-data">
        @csrf

        <label class=" mb-4 label" style="aspect-ratio:2; position: relative; " data-toggle="tooltip"
               title="" data-original-title="CHOOSE COVER IMAGE" aria-describedby="tooltip480018">

            <img class="rounded " style="width: 100%; height:100%; box-shadow: 0 8px 16px rgba(0, 0, 0, 0.5);"
                 id="avatar" src="{{ asset('blog_images/cover_photos/' . $blog->cover_photo) }}"
                 alt="avatar">
            <input type="file" class="sr-only" id="input" name="photo" accept="image/*">
            <input type="hidden" id="cropped-image" name="photo">
        </label>
        <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel"
             aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalLabel">Crop the image</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="img-container">
                            <img id="image" src="https://avatars0.githubusercontent.com/u/3456749">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-primary" id="crop">Crop</button>
                    </div>
                </div>
            </div>
        </div>
        <input type="hidden" name="mevcut_cover_photo" value="{{ $blog->cover_photo }}">

        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" class="  form-control" value="{{ $blog->title }}" id="title"
                   name="title" placeholder="Blog Title" required>
            <input name="blog_id" type="hidden" value="{{ $blog->id }}">
        </div>

        <div class="form-group">
            <label for="summery text-center">Summery</label>
            <textarea name="summery" maxlength="255" rows="3" required id="summery">{{ $blog->summery }}</textarea>
            <label id="charCount" style="display:none">{{ 255 - strlen($blog->summery) }} characters
                remaining</label>
        </div>

        <div class="category-select form-group">
            <label for="category">Kategori Seçiniz</label>
            <div class="select-box">
                <div class="select-box__current " tabindex="1">
                    <input type="hidden" name="category_id" id="category_name">
                    <span class="select-box__value" id="selected-category"
                          data-id="{{ $selected_category->id }}">
                            {{ $selected_category->name }}</span>
                    <span class="select-box__arrow">▼</span>
                </div>
                <ul class="select-box__list ">
                    <li>
                        <input class="select-box__search" placeholder="Search..." type="text">
                    </li>
                    @if (isset($categories))
                        @foreach ($categories as $kategori)
                            <li class="select-box__list-item" data-id="{{ $kategori->id }}"
                                data-value="option1">{{ $kategori->name }}</li>
                        @endforeach
                    @endif


                </ul>
            </div>
        </div>

        <div class="form-group">
            <label for="editor">Content</label>
            <textarea name="description" required id="editor">{{ $blog->description }}</textarea>
        </div>

        <div class="form-group">
            <label for="tags">Add tag:</label>
            <input name='tags' class='tagify--custom-dropdown' placeholder='Add tag(s)'
                   value="
                    @foreach ($selected_tags as $tag)
                    {{ $tag }}, @endforeach"
                   data-tags='@json($tags)'>
        </div>

        <button id="submit-btn" type="submit" class="btn-primary">Post Your Blog</button>
    </form>
</div>

@include('Authenticated_pages.layouts.footer')

{{-- tagify --}}
<script src="https://cdn.jsdelivr.net/npm/@yaireo/tagify"></script>
<script src="https://cdn.jsdelivr.net/npm/@yaireo/tagify/dist/tagify.polyfills.min.js"></script>
<script>
    var tags;
    var input = document.querySelector('input[name="tags"]'),
        // init Tagify script on the above inputs
        tags = input.getAttribute('data-tags');
    tagify = new Tagify(input, {
        whitelist: JSON.parse(tags),
        maxTags: 10,
        dropdown: {
            maxItems: 20, // <- mixumum allowed rendered suggestions
            classname: 'tags-look', // <- custom classname for this dropdown, so it could be targeted
            enabled: 0, // <- show suggestions on focus
            closeOnSelect: false // <- do not hide the suggestions dropdown once an item has been selected
        }
    })
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.6.2/cropper.js"
        integrity="sha512-lR8d1BXfYQuiqoM/LeGFVtxFyspzWFTZNyYIiE5O2CcAGtTCRRUMLloxATRuLz8EmR2fYqdXYlrGh+D6TVGp3g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous">
</script>
<script>
    window.addEventListener('DOMContentLoaded', function () {
        var avatar = document.getElementById('avatar');
        var image = document.getElementById('image');
        var input = document.getElementById('input');
        var $progress = $('.progress');
        var $modal = $('#modal');
        var cropper;

        $('[data-toggle="tooltip"]').tooltip();

        // Resim yüklendiğinde croplamak için modal göster
        input.addEventListener('change', function (e) {
            var files = e.target.files;
            var done = function (url) {
                input.value = '';
                image.src = url;
                $modal.modal('show');
            };
            var reader;
            var file;

            if (files && files.length > 0) {
                file = files[0];

                if (URL) {
                    done(URL.createObjectURL(file));
                } else if (FileReader) {
                    reader = new FileReader();
                    reader.onload = function (e) {
                        done(reader.result);
                        alert(reader.result);
                    };
                    reader.readAsDataURL(file);
                }
            }
        });


        function loadImage(url) {
            var img = new Image();
            img.onload = function () {
                var canvas = document.createElement('canvas');
                var ctx = canvas.getContext('2d');

                // Set proper canvas dimensions before transform & export
                if (4 < img.width * img.height / 1000000) {
                    canvas.width = img.width * 0.5;
                    canvas.height = img.height * 0.5;
                } else {
                    canvas.width = img.width;
                    canvas.height = img.height;
                }

                ctx.drawImage(img, 0, 0, canvas.width, canvas.height);
                image.src = canvas.toDataURL('image/jpeg');
                $modal.modal('show');
            };
            img.src = url;
        }

        // Modal açıldığında Cropper.js başlat
        $modal.on('shown.bs.modal', function () {
            cropper = new Cropper(image, {
                aspectRatio: 2, // yükseklik 1 , genişlik 2
                viewMode: 1,
            });
        }).on('hidden.bs.modal', function () {
            cropper.destroy();
            cropper = null;
        });

        // Croplama işlemi yapıldığında
        document.getElementById('crop').addEventListener('click', function () {
            var initialAvatarURL;
            var canvas;
            var new_blog_form = document.getElementById('new-blog');

            $modal.modal('hide');

            if (cropper) {
                // Croplama işlemini yap
                canvas = cropper.getCroppedCanvas();
                initialAvatarURL = avatar.src;
                avatar.src = canvas.toDataURL('image/jpeg'); // Croplanmış resmi avatar'a koyma

                $progress.show();

                // Cropladığın resmi bir Blob formatına çevir
                canvas.toBlob(function (blob) {
                    // Blob'u bir dosya olarak input'a ekle
                    var file = new File([blob], "cropped_avatar.jpg", {
                        type: 'image/jpeg'
                    });

                    // Input dosyasına Blob'u ekle
                    var dataTransfer = new DataTransfer();
                    dataTransfer.items.add(file);
                    input.files = dataTransfer
                        .files; // Burada 'input' elementine dosya ekleniyor
                }, 'image/jpeg');
            }
        });
    });
</script>

{{--highlight -- jodit--}}
<script type="text/javascript" src="{{asset('Jodit/jodit.min.js')}}"></script>
<script src="{{ asset('highlight/') }}/highlight.js"></script>
<script>
    const editor = Jodit.make('#editor', {
        "uploader": {
            "insertImageAsBase64URI": true
        },
        "language": "tr",
        "height": 500,
        "askBeforePasteHTML": false, // HTML içerik yapıştırılırken onay sormayı kapatır
        "events": {
            beforePaste: function (event, html) {
                // HTML içeriği temizle ve sadece düz metin olarak yapıştır
                return html.replace(/<[^>]+>/g, '');
            }
        },
        "extraButtons": [{
            name: 'insertCode',
            iconURL: '{{asset('img/')}}/code.png', // Özelleştirilmiş bir simge URL'si
            exec: function (editor) {


                const currentSelection = editor.selection.save();


                // Modal veya textarea ile kullanıcıdan kod alın
                const modal = document.createElement('div');
                modal.id = 'code-modal';
                modal.style.position = 'fixed';
                modal.style.top = '50%';
                modal.style.left = '50%';
                modal.style.transform = 'translate(-50%, -50%)';
                modal.style.backgroundColor = 'white';
                modal.style.padding = '20px';
                modal.style.boxShadow = '0 0 10px rgba(0, 0, 0, 0.5)';
                modal.style.zIndex = '1000';
                modal.style.width = '350px';


                const textarea = document.createElement('textarea');
                textarea.style.width = '%100';
                textarea.style.height = '150px';
                textarea.placeholder = 'Paste your code here and select language...';

                const selectBox = document.createElement('select');
                selectBox.id = 'mySelectBox';

                // Seçenekler (options) oluşturma
                const options = [
                    {value: 'vbscript-html', text: 'HTML'},
                    {value: 'c', text: 'C'},
                    {value: 'cpp', text: 'C++'},
                    {value: 'csharp', text: 'C#'},
                    {value: 'css', text: 'CSS'},
                    {value: 'go', text: 'GO'},
                    {value: 'java', text: 'Java'},
                    {value: 'javascript', text: 'JavaScript'},
                    {value: 'kotlin', text: 'Kotlin'},
                    {value: 'perl', text: 'Perl'},
                    {value: 'php', text: 'PHP'},
                    {value: 'python', text: 'Python'},
                    {value: 'r', text: 'R'},
                    {value: 'ruby', text: 'Ruby'},
                    {value: 'rust', text: 'Rust'},
                    {value: 'sql', text: 'SQL'},
                    {value: 'swift', text: 'Swift'},
                    {value: 'typescript', text: 'TypeScript'}
                ];

                // Seçenekleri select box'a ekleme
                options.forEach(option => {
                    const optionElement = document.createElement('option');
                    optionElement.value = option.value;
                    optionElement.text = option.text;
                    selectBox.appendChild(optionElement);
                });

                const buttons = document.createElement('code-buttons');
                buttons.style.display = 'flex';
                buttons.style.justifyContent = 'space-between';
                buttons.style.marginTop = '5px';


                const insertButton = document.createElement('button');
                insertButton.textContent = 'ADD';
                insertButton.style.padding = '6px 6px 6px 6px';
                insertButton.style.backgroundcolor = 'red';


                insertButton.onclick = function () {
                    const userCode = textarea.value;
                    if (userCode) {
                        // İmlecin konumunu geri yükle
                        editor.selection.restore(currentSelection);

                        const language = document.getElementById('mySelectBox').value;

                        // HTML kodunu olduğu gibi ekleyin (escape etmeyin)
                        try {

                            const codeBlock = document.createElement('pre');
                            codeBlock.style.borderRadius = "3px";
                            codeBlock.style.margin = "0";
                            codeBlock.style.overflowX = 'auto';
                            codeBlock.style.tabSize = '4';

                            const codeElement = document.createElement('code');
                            codeElement.className = `language-${language}`;
                            codeElement.textContent = userCode; // XSS saldırılarına karşı escape edilmiş bir içerik

                            codeBlock.appendChild(codeElement);

                            editor.selection.insertHTML(codeBlock.outerHTML);

                            setTimeout(() => {
                                hljs.highlightAll();
                            }, 0);

                        } catch (error) {
                            console.error(`Dil desteklenmiyor: ${language}`, error);
                            alert(`Dil desteklenmiyor: ${language}`);
                        }


                    }
                    document.body.removeChild(modal);
                };

                const cancelButton = document.createElement('button');
                cancelButton.textContent = 'Cancel';
                cancelButton.style.marginLeft = 'auto';
                cancelButton.style.padding = '6px 6px 6px 6px';
                cancelButton.style.color = 'red';
                cancelButton.style.fontWeight = 'bold';

                cancelButton.onclick = function () {
                    document.body.removeChild(modal);
                };


                setTimeout(() => {
                    window.onclick = function (event) {
                        if (!modal.contains(event.target)) { // Modal'ın dışına tıklandıysa
                            document.body.removeChild(modal); // Modal'ı kaldır
                            window.onclick = null; // Olay dinleyicisini kaldır
                        }
                    };
                }, 0); // Kısa bir gecikme ekleyerek olayın tetiklenmesini engelleyin

                buttons.appendChild(insertButton);
                buttons.appendChild(cancelButton);

                modal.appendChild(textarea);
                modal.appendChild(selectBox);
                modal.appendChild(buttons);

                document.body.appendChild(modal);


            }
        }],

    });
</script>
{{-- highlight.js --}}
<script src="{{ asset('highlight/') }}/highlight.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('code').forEach((block) => {
            block.style.borderRadius = '3px';
        });
        setTimeout(() => {
            hljs.highlightAll();
        }, 0);
    });
</script>


{{-- category selection --}}
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const selectBox = document.querySelector('.select-box');
        const selectBoxCurrent = selectBox.querySelector('.select-box__current');
        const selectBoxList = selectBox.querySelector('.select-box__list');
        const selectBoxValue = selectBox.querySelector('.select-box__value');
        const selectBoxListItems = selectBox.querySelectorAll('.select-box__list-item');
        const selectBoxSearch = selectBox.querySelector('.select-box__search');
        const selectBoxArrow = selectBox.querySelector('.select-box__arrow');
        const selected_category_span = document.querySelector('#selected-category');

        // seçim yapılmama durumu olduğu için başta id al
        document.querySelector('#category_name').value = selected_category_span.getAttribute('data-id');

        selectBoxCurrent.addEventListener('click', function () {
            selectBoxList.classList.toggle('active');
            selectBoxArrow.style.transform = selectBoxList.classList.contains('active') ?
                'rotate(180deg)' : 'rotate(0)';
        });

        selectBoxListItems.forEach(item => {
            item.addEventListener('click', function () {
                selectBoxValue.textContent = this.textContent;
                document.querySelector('#category_name').value = this.getAttribute('data-id');
                selectBoxList.classList.remove('active');
                selectBoxArrow.style.transform = 'rotate(0)';
            });
        });

        selectBoxSearch.addEventListener('input', function () {
            const filter = this.value.toLowerCase();
            selectBoxListItems.forEach(item => {
                const text = item.textContent.toLowerCase();
                if (text.includes(filter)) {
                    item.classList.remove('hide');
                } else {
                    item.classList.add('hide');
                }
            });
        });

        document.addEventListener('click', function (e) {
            if (!selectBox.contains(e.target)) {
                selectBoxList.classList.remove('active');
                selectBoxArrow.style.transform = 'rotate(0)';
            }
        });
    });
</script>

{{-- live input remaining --}}
<script>
    const textInput = document.getElementById('summery');
    const charCount = document.getElementById('charCount');
    const maxLength = parseInt(textInput.getAttribute('maxlength'), 10); // Max length'i doğrudan al

    console.log(textInput.maxLength);

    function updateCharCount() {
        const remainingChars = maxLength - textInput.value.length;
        charCount.textContent = `${remainingChars} character${remainingChars !== 1 ? 's' : ''} remaining`;
    }

    textInput.addEventListener('input', () => {
        updateCharCount();
        textInput.value = textInput.value.trim();
    });
    textInput.addEventListener('focus', () => {
        charCount.style.display = 'block';
    });
    textInput.addEventListener('blur', () => {
        charCount.style.display = 'none';
    });

    // Sayfa yüklendiğinde başlangıç değerini güncelle
    updateCharCount();
</script>


</body>

</html>
