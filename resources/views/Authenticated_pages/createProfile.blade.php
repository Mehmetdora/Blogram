<!doctype html>
<html lang="en">

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

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
          integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.6.2/cropper.css"
          integrity="sha512-087vysR/jM0N5cp13Vlp+ZF9wx6tKbvJLwPO8Iit6J7R+n7uIMMjg37dEgexOshDmDITHYY5useeSmfD1MYiQA=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <style type="text/css">
        .label {
            position: relative;
            border: 5px solid #f8f8f8;
            overflow: hidden;
            height: 200px;
            width: 200px;
            border-radius: 50%;
            /* Taşan görüntüleri gizler */
        }

        #avatar {
            width: 100%;
            height: 100%;
            border-radius: 50%;
            object-fit: cover;
            /* Fotoğrafın kapsayıcıya sığmasını sağlar */
        }

        .cropper-view-box,
        .cropper-face {
            border-radius: 50%;
        }

        /* The css styles for `outline` do not follow `border-radius` on iOS/Safari (#979). */
        .cropper-view-box {
            outline: 0;
            box-shadow: 0 0 0 1px #39f;
        }
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

    <title>{{ $site_setting->site_name }}</title>

</head>

<body>

<header class="navigation fixed-top">
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-white">
            <a href="#"> <img src="{{ asset('site_settings/site_logo/') }}/{{ $site_setting->logo_url }}"
                              alt="Logo" class="logo-img">
            </a>
        </nav>
    </div>
</header>

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
        <path d="M20.0078 1.62949L19.9858 19.3804L37.7367 19.4024L37.7587 1.65149L20.0078 1.62949Z" stroke="#040306"
              stroke-miterlimit="10"/>
    </svg>


    <svg class="banner-border" height="240" viewBox="0 0 2202 240" fill="none"
         xmlns="http://www.w3.org/2000/svg">
        <path
            d="M1 123.043C67.2858 167.865 259.022 257.325 549.762 188.784C764.181 125.427 967.75 112.601 1200.42 169.707C1347.76 205.869 1901.91 374.562 2201 1"
            stroke-width="2"/>
    </svg>
</div>
@include('Authenticated_pages.layouts.spinner')
@include('Public_pages.layouts._message')


<div class="container">
    <form action="{{ route('profile.store') }}" method="post" id="profile-form" enctype="multipart/form-data"
          class="profile-form">
        @csrf

        <div class="profile-image">
            <label class=" mb-4 label" data-toggle="tooltip" title=""
                   data-original-title="CHOOSE PROFILE IMAGE" aria-describedby="tooltip480018">

                <img class="rounded "
                     style="width: 100%; height:100%; border-radius:50%; box-shadow: 0 8px 16px rgba(8, 69, 175, 0.5);"
                     id="avatar" src="{{ '/uploads/Default_pfp.jpg' }}" alt="avatar">
                <input type="file" class="sr-only" id="input" name="photo" accept="image/*">
                <input type="hidden" id="cropped-image" name="photo">
            </label>

            <!-- Cropper popup kodu -->
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
                                <img id="image" style="max-height: 500px; max-width:500px;"
                                     src="https://avatars0.githubusercontent.com/u/3456749">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                            <button type="button" class="btn btn-primary" id="crop">Crop</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="form-group">
            <label for="profile_name">Profile Name</label>
            <input type="text" class="form-control" id="profile_name" name="profile_name"
                   placeholder="Nickname" required>
        </div>

        <div class="form-group">
            <label for="profile_skills">Qualifications</label>
            <input type="text" class="form-control" id="profile_skills" name="skills"
                   placeholder="Profession, Skills, Interests...">
        </div>

        <div class="form-group">
            <label for="gender">Gender</label>
            <select name="gender" id="gender" class="form-control" required>
                <option value="">Gender</option>
                <option value="1">Female</option>
                <option value="0">Male</option>
            </select>
        </div>

        <div class="form-group">
            <label for="text-area">Bio</label>
            <textarea name="bio" id="text-area" rows="5" class="form-control" placeholder="Who are you..."></textarea>
        </div>

        <div class="button-group">
            <button type="submit" class="btn btn-primary">Lets Go</button>
        </div>
    </form>
</div>


<footer class="footer">
    <svg class="footer-border" height="214" viewBox="0 0 2204 214" fill="none"
         xmlns="http://www.w3.org/2000/svg">
        <path
            d="M2203 213C2136.58 157.994 1942.77 -33.1996 1633.1 53.0486C1414.13 114.038 1200.92 188.208 967.765 118.127C820.12 73.7483 263.977 -143.754 0.999958 158.899"
            stroke-width="2"/>
    </svg>
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-5 text-center text-md-left mb-4">
                <ul class="list-inline footer-list mb-0">
                    <li class="list-inline-item"><a href="#">Privacy Policy</a></li>
                    <li class="list-inline-item"><a href="#">Terms Conditions</a></li>
                </ul>
            </div>
            <div class="col-md-2 text-center mb-4">
                <a href="#"> <img
                        src="{{ asset('site_settings/site_logo/') }}/{{ $site_setting->logo_url }}"
                        alt="Logo" class="logo-img">
                </a>
            </div>
            {{-- <div class="col-md-5 text-md-right text-center mb-4">
                <ul class="list-inline footer-list mb-0">

                    <li class="list-inline-item"><a href="#"><i class="ti-facebook"></i></a></li>

                    <li class="list-inline-item"><a href="#"><i class="ti-twitter-alt"></i></a></li>

                    <li class="list-inline-item"><a href="#"><i class="ti-linkedin"></i></a></li>

                    <li class="list-inline-item"><a href="#"><i class="ti-github"></i></a></li>

                    <li class="list-inline-item"><a href="#"><i class="ti-youtube"></i></a></li>

                </ul>
            </div> --}}
            <div class="col-12">
                <div class="border-bottom border-default"></div>
            </div>
        </div>
    </div>
</footer>

<!-- JS Plugins READER -->
<script src="{{ asset('style/') }}/reader/plugins/jQuery/jquery.min.js"></script>
<script src="{{ asset('style/') }}/reader/plugins/bootstrap/bootstrap.min.js"></script>
<script src="{{ asset('style/') }}/reader/plugins/slick/slick.min.js"></script>
<script src="{{ asset('style/') }}/reader/plugins/instafeed/instafeed.min.js"></script>
<!-- Main Script -->
<script src="{{ asset('style/') }}/reader/jsn/script.js"></script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.12.3/dist/sweetalert2.all.min.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>


{{-- spinner --}}
<script>
    // public/js/loader.js
    document.addEventListener("DOMContentLoaded", function () {
        // Sayfa yüklendiğinde spinner'ı gizle
        document.getElementById("loader").style.display = "none";

        // Form gönderildiğinde spinner'ı göster
        document.querySelectorAll('form').forEach(form => {
            form.addEventListener('submit', function () {
                document.getElementById("loader").style.display = "flex";
            });
        });
    });

    // Sayfa yüklendiğinde spinner'ı gizle
    window.addEventListener("load", function () {
        document.getElementById("loader").style.display = "none"; // Sayfa yüklendiğinde spinner'ı gizle
    });
</script>


<script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.6.2/cropper.js"
        integrity="sha512-lR8d1BXfYQuiqoM/LeGFVtxFyspzWFTZNyYIiE5O2CcAGtTCRRUMLloxATRuLz8EmR2fYqdXYlrGh+D6TVGp3g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous">
</script>

<!-- crop işlemi scripti rounded -->
<script>
    function getRoundedCanvas(sourceCanvas) {
        var canvas = document.createElement('canvas');
        var context = canvas.getContext('2d');
        var width = sourceCanvas.width;
        var height = sourceCanvas.height;

        canvas.width = width;
        canvas.height = height;
        context.imageSmoothingEnabled = true;
        context.drawImage(sourceCanvas, 0, 0, width, height);
        context.globalCompositeOperation = 'destination-in';
        context.beginPath();
        context.arc(width / 2, height / 2, Math.min(width, height) / 2, 0, 2 * Math.PI, true);
        context.fill();
        return canvas;
    }

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

                if (file.type !== 'image/jpeg' && file.type !== 'image/png') {
                    alert('Lütfen yalnızca JPEG veya PNG formatındaki dosyalar yükleyin.');
                    return; // Hata durumunda işlemi durdur
                }

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
                aspectRatio: 1, // yükseklik 1 , genişlik 2
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

            $modal.modal('hide');

            if (cropper) {
                // Croplama işlemini yap
                canvas = cropper.getCroppedCanvas();

                // Round
                canvas = getRoundedCanvas(canvas);

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

{{-- Default pfp --}}
<script>
    const pfp = document.getElementById('avatar');
    const gender_s = document.getElementById('gender');

    gender_s.addEventListener('change', () => {
        if (gender_s.value == 1 && pfp.src == 'http://127.0.0.1:8000/uploads/Default_pfp.jpg') {
            console.log('erkek resmi varken kız seçildi');
            pfp.src = "{{ asset('uploads/Default_pfp_women.png') }}";

        } else if (gender_s.value == 0 && pfp.src == 'http://127.0.0.1:8000/uploads/Default_pfp_women.png') {
            console.log('kız resmi varken erkek seçildi');
            pfp.src = "{{ asset('uploads/Default_pfp.jpg') }}";

        }
    });
</script>

</body>

</html>
