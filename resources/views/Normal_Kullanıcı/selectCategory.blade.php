<!DOCTYPE html>
<html lang="en-us">

<head>
    <meta charset="utf-8">
    <title>Blogram</title>

    <!-- mobile responsive meta -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="description" content="This is meta description">
    <meta name="author" content="Themefisher">
    <meta name="generator" content="Hugo 0.74.3" />

    <!-- theme meta -->
    <meta name="theme-name" content="reader" />

    <link rel="stylesheet" href="{{ asset('style/reader/') }}/plugins/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('style/reader/') }}/plugins/themify-icons/themify-icons.css">
    <link rel="stylesheet" href="{{ asset('style/reader/') }}/plugins/slick/slick.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Kendi css lerim -->
    <link rel="stylesheet" href="{{ asset('style/reader/css/') }}/style2.css">
    <link rel="stylesheet" href="{{ asset('style/reader/css') }}/header.css">

    <!-- Main Stylesheet -->
    <link rel="stylesheet" href="{{ asset('style/reader/') }}/css/style.css" media="screen">

    <style>
        body {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            margin: 0;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background-color: #f5f5f5;
        }

        .container {
            background: white;
            padding: 2rem;
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            width: 90%;
            max-width: 600px;
        }

        h1 {
            text-align: center;
            color: #333;
            margin-bottom: 2rem;
            font-size: 1.5rem;
            font-weight: 600;
        }

        .categories {
            display: flex;
            gap: 1rem;
            flex-wrap: wrap;
            margin-bottom: 2rem;
            justify-content: center;
        }

        .category-btn {
            padding: 0.75rem 1.5rem;
            border: 2px solid #e0e0e0;
            border-radius: 50px;
            background: transparent;
            cursor: pointer;
            font-size: 1rem;
            font-weight: 500;
            transition: all 0.3s ease;
            min-width: 120px;
            position: relative;
        }

        .category-btn::before {
            content: '';
            position: absolute;
            left: 12px;
            top: 50%;
            transform: translateY(-50%);
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background-color: #e0e0e0;
            transition: background-color 0.3s ease;
        }

        .category-btn:hover {
            border-color: #4CAF50;
        }

        .category-btn.active {
            background-color: #4CAF50;
            border-color: #4CAF50;
            color: white;
        }

        .category-btn.active::before {
            background-color: white;
        }

        .save-btn {
            display: block;
            margin: 0 auto;
            padding: 0.75rem 2.5rem;
            border: 2px solid #333;
            border-radius: 50px;
            background: transparent;
            cursor: pointer;
            font-size: 1rem;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .save-btn:hover {
            background: #333;
            color: white;
        }

        @media (max-width: 480px) {
            .categories {
                flex-direction: column;
                align-items: stretch;
            }

            .category-btn {
                width: 100%;
            }
        }

        .selected {}
    </style>

    {{-- spinner --}}
    <style>
        /* From Uiverse.io by Chriskoziol */
        .spinnerContainer {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            /* Ortalamak için */
            display: flex;
            flex-direction: column;
            align-items: center;
            z-index: 50;
        }

        .spinner {
            width: 56px;
            height: 56px;
            display: grid;
            border: 4px solid #0000;
            border-radius: 50%;
            border-right-color: #299fff;
            animation: tri-spinner 1s infinite linear;
        }

        .spinner::before,
        .spinner::after {
            content: "";
            grid-area: 1/1;
            margin: 2px;
            border: inherit;
            border-radius: 50%;
            animation: tri-spinner 2s infinite;
        }

        .spinner::after {
            margin: 8px;
            animation-duration: 3s;
        }

        @keyframes tri-spinner {
            100% {
                transform: rotate(1turn);
            }
        }

        .loader {
            color: #4a4a4a;
            font-family: "Poppins", sans-serif;
            font-weight: 500;
            font-size: 25px;
            -webkit-box-sizing: content-box;
            box-sizing: content-box;
            height: 40px;
            padding: 10px 10px;
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            border-radius: 8px;
        }

        .words {
            overflow: hidden;
        }

        .word {
            display: block;
            height: 100%;
            padding-left: 6px;
            color: #299fff;
            animation: cycle-words 5s infinite;
        }

        @keyframes cycle-words {
            10% {
                -webkit-transform: translateY(-105%);
                transform: translateY(-105%);
            }

            25% {
                -webkit-transform: translateY(-100%);
                transform: translateY(-100%);
            }

            35% {
                -webkit-transform: translateY(-205%);
                transform: translateY(-205%);
            }

            50% {
                -webkit-transform: translateY(-200%);
                transform: translateY(-200%);
            }

            60% {
                -webkit-transform: translateY(-305%);
                transform: translateY(-305%);
            }

            75% {
                -webkit-transform: translateY(-300%);
                transform: translateY(-300%);
            }

            85% {
                -webkit-transform: translateY(-405%);
                transform: translateY(-405%);
            }

            100% {
                -webkit-transform: translateY(-400%);
                transform: translateY(-400%);
            }
        }
    </style>

</head>
<title>Blog Sayfası</title>

<body>
    <header>
        <div class="logo">
            <a href="#"> <img src="{{ asset('site_settings/site_logo/') }}/{{ $site_setting->logo_url }}"
                    alt="Logo" class="logo-img">
            </a>
        </div>
    </header>

    @include('Kayıtsız_Görüntülemeler.layouts._message')

    @include('Normal_Kullanıcı.blogy_Layouts.spinner')




    <div class="container">
        <h1>KATEGORILER</h1>
        <div class="categories">
            @if (isset($categories))
                @foreach ($categories as $category)
                    <button class="category-btn" id="{{ $category->id }}">{{ $category->name }}</button>
                @endforeach
            @endif
        </div>
        <form action="{{ route('category.selected') }}" method="post">
            @csrf
            <input type="hidden" name="selectedCategories" id="selectedCategories" value="">
            <button type="submit" class="save-btn">KAYDET</button>
        </form>

    </div>



    <!-- Kendi JS dosyalarım -->
    <script src="{{ asset('style/reader/JS/') }}/header.js"></script>
    <script src="{{ asset('style/reader/') }}/plugins/jQuery/jquery.min.js"></script>
    <script src="{{ asset('style/reader/') }}/plugins/bootstrap/bootstrap.min.js"></script>
    <script src="{{ asset('style/reader/') }}/plugins/slick/slick.min.js"></script>
    <script src="{{ asset('style/reader/') }}/plugins/instafeed/instafeed.min.js"></script>

    <!-- Main Script -->
    <script src="js/script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    {{-- category seçme --}}
    <script>

        const input_selecteds_catg = document.getElementById('selectedCategories');
        document.querySelectorAll('.category-btn').forEach(button => {
            button.addEventListener('click', function() {
                this.classList.toggle('active');

                const selectedCategories = Array.from(document.querySelectorAll('.category-btn.active'))
                    .map(btn => btn.id);
                input_selecteds_catg.value = selectedCategories;



                // Add subtle animation
                this.style.transform = 'scale(0.95)';
                setTimeout(() => {
                    this.style.transform = 'scale(1)';
                }, 100);
            });
        });


    </script>

    {{-- spinner --}}
    <script>
        // public/js/loader.js
        document.addEventListener("DOMContentLoaded", function() {
            document.getElementById("loader").style.display = "none";
        });

        // Sayfa yüklendiğinde spinner'ı gizle
        document.addEventListener("DOMContentLoaded", function() {
            document.getElementById("loader").style.display = "none";
        });

        // Sayfalar arası geçişlerde ve form gönderimlerinde spinner'ı göster
        window.addEventListener("beforeunload", function() {
            document.getElementById("loader").style.display = "flex";
        });
    </script>
</body>

</html>
