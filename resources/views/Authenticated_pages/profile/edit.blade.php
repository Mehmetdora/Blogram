<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Untree.co">
    <link rel="shortcut icon" href="favicon.png">
    <meta name="description" content="" />
    <meta name="keywords" content="bootstrap, bootstrap5" />
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
        crossorigin="anonymous" referrerpolicy="no-referrer" />


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


    <title>{{ $site_setting->site_name }}</title>
    @include('Authenticated_pages.layouts.header_style')


    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #f0f2f5;
            width: 100%;
        }

        .container {
            width: 100%;
            max-width: 600px;
            margin: 0 auto;
        }

        .profile-form {
            background-color: #fff;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .profile-image {
            text-align: center;
            margin-bottom: 20px;
        }

        .profile-image img {
            width: 100%;
            height: auto;
            object-fit: cover;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        .form-control {
            width: 100%;
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        .btn {
            display: block;
            width: 100%;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            margin-bottom: 10px;
        }

        .btn-primary {
            background-color: #1877f2;
            color: white;
        }

        .btn-warning {
            background-color: #f0ad4e;
            color: white;
        }

        .button-group {
            margin-top: 20px;
        }

        @media (min-width: 481px) {
            .button-group {
                display: flex;
                justify-content: space-between;
            }

            .btn {
                width: 48%;
            }
        }
    </style>


</head>

<body>

    @include('Authenticated_pages.layouts.header')


    <div class="banner text-center">


        <svg class="banner-shape-1" width="39" height="40" viewBox="0 0 39 40" fill="none"
            xmlns="http://www.w3.org/2000/svg">
            <path d="M0.965848 20.6397L0.943848 38.3906L18.6947 38.4126L18.7167 20.6617L0.965848 20.6397Z"
                stroke="#040306" stroke-miterlimit="10" />
            <path class="path"
                d="M10.4966 11.1283L10.4746 28.8792L28.2255 28.9012L28.2475 11.1503L10.4966 11.1283Z" />
            <path d="M20.0078 1.62949L19.9858 19.3804L37.7367 19.4024L37.7587 1.65149L20.0078 1.62949Z" stroke="#040306"
                stroke-miterlimit="10" />
        </svg>

        <svg class="banner-shape-2" width="39" height="39" viewBox="0 0 39 39" fill="none"
            xmlns="http://www.w3.org/2000/svg">
            <g filter="url(#filter0_d)">
                <path class="path"
                    d="M24.1587 21.5623C30.02 21.3764 34.6209 16.4742 34.435 10.6128C34.2491 4.75147 29.3468 0.1506 23.4855 0.336498C17.6241 0.522396 13.0233 5.42466 13.2092 11.286C13.3951 17.1474 18.2973 21.7482 24.1587 21.5623Z" />
                <path
                    d="M5.64626 20.0297C11.1568 19.9267 15.7407 24.2062 16.0362 29.6855L24.631 29.4616L24.1476 10.8081L5.41797 11.296L5.64626 20.0297Z"
                    stroke="#040306" stroke-miterlimit="10" />
            </g>
            <defs>
                <filter id="filter0_d" x="0.905273" y="0" width="37.8663" height="38.1979" filterUnits="userSpaceOnUse"
                    color-interpolation-filters="sRGB">
                    <feFlood flood-opacity="0" result="BackgroundImageFix" />
                    <feColorMatrix in="SourceAlpha" type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0" />
                    <feOffset dy="4" />
                    <feGaussianBlur stdDeviation="2" />
                    <feColorMatrix type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.25 0" />
                    <feBlend mode="normal" in2="BackgroundImageFix" result="effect1_dropShadow" />
                    <feBlend mode="normal" in="SourceGraphic" in2="effect1_dropShadow" result="shape" />
                </filter>
            </defs>
        </svg>


        <svg class="banner-shape-3" width="39" height="40" viewBox="0 0 39 40" fill="none"
            xmlns="http://www.w3.org/2000/svg">
            <path d="M0.965848 20.6397L0.943848 38.3906L18.6947 38.4126L18.7167 20.6617L0.965848 20.6397Z"
                stroke="#040306" stroke-miterlimit="10" />
            <path class="path"
                d="M10.4966 11.1283L10.4746 28.8792L28.2255 28.9012L28.2475 11.1503L10.4966 11.1283Z" />
            <path d="M20.0078 1.62949L19.9858 19.3804L37.7367 19.4024L37.7587 1.65149L20.0078 1.62949Z" stroke="#040306"
                stroke-miterlimit="10" />
        </svg>


        <svg class="banner-border" height="240" viewBox="0 0 2202 240" fill="none"
            xmlns="http://www.w3.org/2000/svg">
            <path
                d="M1 123.043C67.2858 167.865 259.022 257.325 549.762 188.784C764.181 125.427 967.75 112.601 1200.42 169.707C1347.76 205.869 1901.91 374.562 2201 1"
                stroke-width="2" />
        </svg>
    </div>

    @include('Authenticated_pages.layouts.spinner')


    <div class="container">
        <form action="{{ route('profile.edited') }}" method="post" id="profile-form" enctype="multipart/form-data"
            class="profile-form">
            @csrf

            <div class="profile-image ">
                <label class=" mb-4  label" data-toggle="tooltip" title=""
                    data-original-title="CHOOSE PROFILE IMAGE" aria-describedby="tooltip480018">
                    <img class="rounded "
                        style="width: 100%; height:100%; border-radius:50%; box-shadow: 0 8px 16px rgba(8, 69, 175, 0.5);"
                        id="avatar" src="{{ asset('uploads/' . $user->photo) }}" alt="avatar">

                    <input type="file" class="sr-only" id="input" name="photo" accept="image/*">
                    <input type="hidden" id="cropped-image" name="photo">
                </label>
                <!-- Cropper popup -->
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
                    value="{{ $user->name }}" placeholder="Nickname" required>
            </div>

            <div class="form-group">
                <label for="profile_skills">Qualifications</label>
                <input type="text" class="form-control" id="profile_skills" name="skills"
                    value="{{ $user->skill }}" placeholder="Profession, Skills, Interests...">
            </div>

            <div class="form-group">
                <label for="gender">Gender</label>
                <div class="col-sm-10">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="gender" id="gridRadios1"
                            value="0" {{ $user->gender == 0 ? 'checked=""' : '' }}>
                        <label class="form-check-label" for="gridRadios1">
                            Male
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="gender" id="gridRadios2"
                            value="1" {{ $user->gender == 1 ? 'checked=""' : '' }}>
                        <label class="form-check-label" for="gridRadios2">
                            Female
                        </label>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="text-area">Bio</label>
                <textarea name="bio" id="text-area" rows="5" class="form-control" placeholder="Who are you...">{{ $user->bio }}</textarea>
            </div>

            <div class="button-group">
                <button type="submit" class="btn btn-primary">Save Profile</button>
                <button type="button" class="btn btn-warning" onclick="sweet_alert()">Delete Profile</button>
            </div>
        </form>
    </div>


    @include('Authenticated_pages.layouts.footer')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.6.2/cropper.js"
        integrity="sha512-lR8d1BXfYQuiqoM/LeGFVtxFyspzWFTZNyYIiE5O2CcAGtTCRRUMLloxATRuLz8EmR2fYqdXYlrGh+D6TVGp3g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
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

        window.addEventListener('DOMContentLoaded', function() {
            var avatar = document.getElementById('avatar');
            var image = document.getElementById('image');
            var input = document.getElementById('input');
            var $progress = $('.progress');
            var $modal = $('#modal');
            var cropper;

            $('[data-toggle="tooltip"]').tooltip();

            // Resim yüklendiğinde croplamak için modal göster
            input.addEventListener('change', function(e) {
                var files = e.target.files;
                var done = function(url) {
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
                        reader.onload = function(e) {
                            done(reader.result);
                            alert(reader.result);
                        };
                        reader.readAsDataURL(file);
                    }
                }
            });

            function loadImage(url) {
                var img = new Image();
                img.onload = function() {
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
            $modal.on('shown.bs.modal', function() {
                cropper = new Cropper(image, {
                    aspectRatio: 1, // yükseklik 1 , genişlik 2
                    viewMode: 1,
                });
            }).on('hidden.bs.modal', function() {
                cropper.destroy();
                cropper = null;
            });

            // Croplama işlemi yapıldığında
            document.getElementById('crop').addEventListener('click', function() {
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
                    canvas.toBlob(function(blob) {
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


    {{-- user delete alert --}}
    <script>
        function sweet_alert() {
            Swal.fire({
                title: "Are You Sure?",
                text: "Bu işlem ile birlikte bu siteye ilk girişinizden itibaren tüm kullanıcı bilgileriniz, yazılarınız, yorumlarınız... silinmiş olacaktır ve bu işlem geri alınamayacaktır.",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes"
            }).then((result) => {
                if (result.isConfirmed) {
                    // GET isteği ile logout işlemi
                    window.location.href = "{{ route('delete_user_all') }}";
                }
            });
        }
    </script>

</body>

</html>
