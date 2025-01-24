@extends('Management_pages.layouts.app')
@section('style')
    <link type="text/css" rel="stylesheet" href="{{asset('Jodit/jodit.min.css')}}"/>
    <link rel="stylesheet" href="{{ asset('highlight/') }}/styles/monokai.css">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
          integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.6.2/cropper.css"
          integrity="sha512-087vysR/jM0N5cp13Vlp+ZF9wx6tKbvJLwPO8Iit6J7R+n7uIMMjg37dEgexOshDmDITHYY5useeSmfD1MYiQA=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>

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
        <h1>Edit Blog</h1>
    </div><!-- End Page Title -->

    <div class="section">
        <div class="container">
            <div class="row">

                @include('Public_pages.layouts._message')

                <div class="col-lg-12 " data-aos="block" data-aos-delay="200">
                    <form action="{{ route('edited-pending_blog') }}" method="post" id="blogForm"
                          enctype="multipart/form-data">
                        @csrf
                        <div class="row inputs" style="position: relative;">

                            <label class="col-6 mb-4 label" style="height:250px; position: relative; "
                                   data-toggle="tooltip"
                                   title="" data-original-title="CHOOSE COVER IMAGE" aria-describedby="tooltip480018">

                                   <img class="rounded " style="width: 100%; height:100%; box-shadow: 0 8px 16px rgba(0, 0, 0, 0.5);"
                                   id="avatar" src="@if (isset($blog->cover_photo))
                                      {{ asset('blog_images/cover_photos/' . $blog->cover_photo) }}
                                   @else
                                      {{ asset('img/cover.png') }}
                                   @endif"
                                   alt="avatar">
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
                                                    data-dismiss="modal">Cancel
                                            </button>
                                            <button type="button" class="btn btn-primary" id="crop">Crop</button>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <input type="hidden" name="mevcut_cover_photo" value="{{ $blog->cover_photo }}">
                            <label>Title(*)</label>
                            <div class="col-12 mb-3">
                                <input type="text" class="form-control" value="{{ $blog->title }}" id="title"
                                       name="title" placeholder="Blog Title" required>
                                <input name="blog_id" type="hidden" value="{{ $blog->id }}">
                            </div>

                            <label>Summery(*)</label>
                            <div class="col-12 mb-3">
                                <textarea class="col-12" name="summery" rows="3" required
                                          id="summery">{{ $blog->summery }}</textarea>
                            </div>

                            <label>Category(*)</label>
                            <select name="category_id" id="category_id" class=" col-12 form-control select2" required>
                                <option value="">Choose a topic</option>
                                @if (isset($categories))
                                    @foreach ($categories as $kategori)
                                        @if ($kategori->id == $blog->category_id)
                                            <option selected value="{{ $kategori->id }}">{{ $kategori->name }}
                                            </option>
                                        @else
                                            <option value="{{ $kategori->id }}">{{ $kategori->name }}</option>
                                        @endif
                                    @endforeach
                                @endif

                            </select>


                            <label>Content(*)</label>
                            <div class="col-12 mb-3">
                                <textarea id="editor" name="description" required>{{ $blog->description }}</textarea>
                            </div>
                            <div class="col-12">
                                <button id="submit-btn" type="submit" class="btn-primary">Repost Blog</button>
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
                    avatar.src = canvas.toDataURL(); // Croplanmış resmi avatar'a koyma

                    $progress.show();

                    // Cropladığın resmi bir Blob formatına çevir
                    canvas.toBlob(function (blob) {
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
@endsection
