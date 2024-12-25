<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Blog</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href=" {{ url('assets/img/favicon.png') }}" rel="icon">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link
            href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
            rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href=" {{ url('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href=" {{ url('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href=" {{ url('assets/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
    <link href=" {{ url('assets/vendor/quill/quill.snow.css') }}" rel="stylesheet">
    <link href=" {{ url('assets/vendor/quill/quill.bubble.css') }}" rel="stylesheet">
    <link href=" {{ url('assets/vendor/remixicon/remixicon.css') }}" rel="stylesheet">
    <link href=" {{ url('assets/vendor/simple-datatables/style.css') }}" rel="stylesheet">

    <!-- blogy css dosyaları -->
    <link href="https://fonts.googleapis.com/css2?family=Work+Sans:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('blogy/fonts/icomoon/style.css') }}">
    <link rel="stylesheet" href="{{ asset('blogy/fonts/flaticon/font/flaticon.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="{{ asset('blogy/css/tiny-slider.css') }}">
    <link rel="stylesheet" href="{{ asset('blogy/css/aos.css') }}">
    <link rel="stylesheet" href="{{ asset('blogy/css/glightbox.min.css') }}">
    <link rel="stylesheet" href="{{ asset('blogy/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('blogy/css/flatpickr.min.css') }}">

    <!-- Template Main CSS File -->
    <link href=" {{ url('assets/css/style.css') }}" rel="stylesheet">

    <!-- Sonradan eklenen linkler -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">


    @yield('style')


</head>

<body>

@include('Management_pages.layouts._header')
@include('Management_pages.layouts._sidebar')
<main id="main" class="main" style="min-height: 100vh">
    @yield('content')
</main>

@include('Management_pages.layouts._footer')

<!-- Vendor JS Files -->
<script src=" {{ url('assets/js/jquery.min.js') }}"></script>

<script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
<script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="assets/vendor/chart.js/chart.umd.js"></script>
<script src="assets/vendor/echarts/echarts.min.js"></script>
<script src="assets/vendor/quill/quill.js"></script>
<script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
<script src="assets/vendor/tinymce/tinymce.min.js"></script>
<script src="assets/vendor/php-email-form/validate.js"></script>


<!-- blgy js dosyaları -->


<!-- Template Main JS File -->
<script src=" {{ url('assets/js/main.js') }}"></script>

<!-- Sonradan eklenen linkler -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.12.3/dist/sweetalert2.all.min.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

{{-- user delete --}}
<script>
    function delete_user(id, url) {
        Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, delete it!"
        }).then((result) => {
            if (result.isConfirmed) {

                var formData = new FormData();
                formData.append('user_id', id);

                var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                formData.append('_token', csrfToken);

                fetch(url, { // action attribute'undan URL'yi alıyoruz
                    method: 'POST',
                    body: formData
                })
                    .then(response => response.json())
                    .then(data => {
                        console.log('Success:', data);

                        Swal.fire({
                            icon: "success",
                            title: "User is deleted successfully!",
                            showConfirmButton: false,
                            timer: 1500
                        });
                        location.reload();

                    })
                    .catch((error) => {
                        console.error('Error:', error);
                    });

            }
        });

    }
</script>

{{-- category delete --}}
<script>
    function delete_category(id, url) {
        Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, delete it!"
        }).then((result) => {
            if (result.isConfirmed) {

                var formData = new FormData();
                formData.append('category_id', id);

                var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                formData.append('_token', csrfToken);

                fetch(url, { // action attribute'undan URL'yi alıyoruz
                    method: 'POST',
                    body: formData
                })
                    .then(response => response.json())
                    .then(data => {
                        console.log('Success:', data);

                        Swal.fire({
                            icon: "success",
                            title: "Category is deleted successfully!",
                            showConfirmButton: false,
                            timer: 1500
                        });
                        location.reload();

                    })
                    .catch((error) => {
                        console.error('Error:', error);
                    });

            }
        });

    }
</script>

{{-- tag delete --}}
<script>
    function delete_tag(id, url) {
        Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, delete it!"
        }).then((result) => {
            if (result.isConfirmed) {

                var formData = new FormData();
                formData.append('tag_id', id);

                var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                formData.append('_token', csrfToken);

                fetch(url, { // action attribute'undan URL'yi alıyoruz
                    method: 'POST',
                    body: formData
                })
                    .then(response => response.json())
                    .then(data => {
                        console.log('Success:', data);

                        Swal.fire({
                            icon: "success",
                            title: "Tag is deleted successfully!",
                            showConfirmButton: false,
                            timer: 1500
                        });
                        location.reload();

                    })
                    .catch((error) => {
                        console.error('Error:', error);
                    });

            }
        });

    }
</script>


@yield('script')

</body>

</html>
