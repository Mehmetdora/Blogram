@extends('Admin.layouts.app')
@section('style')
    <link type="text/css" rel="stylesheet" href="/Jodit/jodit.min.css" />
    <script type="text/javascript" src="/Jodit/jodit.min.js"></script>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
        integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.6.2/cropper.css"
        integrity="sha512-087vysR/jM0N5cp13Vlp+ZF9wx6tKbvJLwPO8Iit6J7R+n7uIMMjg37dEgexOshDmDITHYY5useeSmfD1MYiQA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

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

        .img-container img {
            max-width: 100%;
        }
        .label {
            cursor: pointer;
        }
    </style>
@endsection
@section('content')
    <div class="pagetitle">
        <h1>Blogs and Comments</h1>

    </div><!-- End Page Title -->

    <div class="section col-lg-12">
        <div class="container">
            <div class="row">

                @include('Kayıtsız_Görüntülemeler.layouts._message')


                <div data-aos="block" data-aos-delay="200">
                    <form action="{{ route('added-blog') }}" method="post" id="blogForm" enctype="multipart/form-data">
                        @csrf
                        <div class="row inputs">

                            <label class="col-6 mb-4 label" style="height:250px; position: relative; " data-toggle="tooltip"
                                title="" data-original-title="CHOOSE COVER IMAGE" aria-describedby="tooltip480018">

                                <img class="rounded "
                                    style="width: 100%; height:100%; box-shadow: 0 8px 16px rgba(0, 0, 0, 0.5);"
                                    id="avatar" src="{{ asset('img/cover.png') }}" alt="avatar">
                                <input type="file" class="sr-only" id="input" name="photo" accept="image/*">
                                <input type="hidden" id="cropped-image" name="photo">
                            </label>

                            <div class="modal fade" id="modal" tabindex="-1" role="dialog"
                                aria-labelledby="modalLabel" aria-hidden="true">
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
                                            <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">Cancel</button>
                                            <button type="button" class="btn btn-primary" id="crop">Crop</button>
                                        </div>
                                    </div>
                                </div>
                            </div>



                            <div class="col-12 mb-3">
                                <input type="text" class="form-control" id="title" name="title"
                                    placeholder="Blog Title" required>
                            </div>

                            <label>Summery for your blog</label>

                            <div class="col-12 mb-3">
                                <textarea class="col-12" name="summery" rows="3" required id="summery"></textarea>
                            </div>

                            <label>Kategori Seçiniz</label>
                            <select name="category_id" id="category_id" class=" col-12 form-control select2" required>
                                <option selected value="">Kategori Seciniz</option>
                                @if (isset($categories))
                                    @foreach ($categories as $kategori)
                                        <option value="{{ $kategori->id }}">{{ $kategori->name }}</option>
                                    @endforeach
                                @endif

                            </select>

                            <div class="col-12 mb-3">
                                <textarea name="description" required id="editor"></textarea>
                            </div>
                            <div class="col-12">
                                <button id="submit-btn" type="submit" class="btn-primary">Save Blog</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.6.2/cropper.js"
        integrity="sha512-lR8d1BXfYQuiqoM/LeGFVtxFyspzWFTZNyYIiE5O2CcAGtTCRRUMLloxATRuLz8EmR2fYqdXYlrGh+D6TVGp3g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous">
    </script>

    <script>
        const editor = Jodit.make('#editor', {
            "uploader": {
                "insertImageAsBase64URI": true
            },
            "language": "tr"
        });
    </script>

    <script>
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

            // Modal açıldığında Cropper.js başlat
            $modal.on('shown.bs.modal', function() {
                cropper = new Cropper(image, {
                    aspectRatio: 2, // yükseklik 1 , genişlik 2
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
                var new_blog_form = document.getElementById('new-blog');

                $modal.modal('hide');

                if (cropper) {
                    // Croplama işlemini yap
                    canvas = cropper.getCroppedCanvas();
                    initialAvatarURL = avatar.src;
                    avatar.src = canvas.toDataURL(); // Croplanmış resmi avatar'a koyma

                    $progress.show();

                    // Cropladığın resmi bir Blob formatına çevir
                    canvas.toBlob(function(blob) {
                        // Blob'u bir dosya olarak input'a ekle
                        var file = new File([blob], "cropped_avatar.png", {
                            type: 'image/png'
                        });

                        // Input dosyasına Blob'u ekle
                        var dataTransfer = new DataTransfer();
                        dataTransfer.items.add(file);
                        input.files = dataTransfer
                            .files; // Burada 'input' elementine dosya ekleniyor
                    }, 'image/png');
                }
            });
        });
    </script>

    {{-- <script>
        function previewImage(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('imagePreview').src = e.target.result;
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script> --}}
@endsection
