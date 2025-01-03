<footer class="footer" >
    <svg class="footer-border" height="214" viewBox="0 0 2204 214" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path
            d="M2203 213C2136.58 157.994 1942.77 -33.1996 1633.1 53.0486C1414.13 114.038 1200.92 188.208 967.765 118.127C820.12 73.7483 263.977 -143.754 0.999958 158.899"
            stroke-width="2" />
    </svg>



    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-5 text-center text-md-left mb-4">
                <ul class="list-inline footer-list mb-0">
                    <li class="list-inline-item"><a href="{{route('privacy-policy')}}">Privacy Policy</a></li>
                    <li class="list-inline-item"><a href="{{route('terms-conditions')}}">Terms Conditions</a></li>
                </ul>
            </div>
            <div class="col-md-2 text-center mb-4">
                <a href="{{route('home')}}"> <img src="{{ asset('site_settings/site_logo/') }}/{{ $site_setting->logo_url }}"
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

{{-- logout alert --}}
<script>
    $(document).ready(function() {
        $('.sign-out').on('click', function() {
            Swal.fire({
                title: "Logout?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes"
            }).then((result) => {
                if (result.isConfirmed) {
                    // GET isteği ile logout işlemi
                    window.location.href = "{{ route('logout') }}";
                }
            });
        });
    });
</script>

{{-- spinner --}}
<script>
    // public/js/loader.js
    document.addEventListener("DOMContentLoaded", function() {
        // Sayfa yüklendiğinde spinner'ı gizle
        document.getElementById("loader").style.display = "none";

        // Form gönderildiğinde spinner'ı göster
        document.querySelectorAll('form').forEach(form => {
            form.addEventListener('submit', function() {
                document.getElementById("loader").style.display = "flex";
            });
        });
    });

    // Sayfa yüklendiğinde spinner'ı gizle
    window.addEventListener("load", function() {
        document.getElementById("loader").style.display = "none"; // Sayfa yüklendiğinde spinner'ı gizle
    });
</script>

{{-- notification bell mobile href ekleme --}}
<script>
    function checkWidthAndSetHref() {
        const button = document.getElementById('notification-bell');
        const notifications = document.getElementById('notificationDropdown');

        if (window.innerWidth < 1000) {
            // Butona href eklemek için `a` öğesi oluştur veya yönlendirme için kod ekle
            button.onclick = function() {
                notifications.style.display = 'none';
                window.location.href = '{{ route('show_notifications') }}'; // Yeni URL
            };
        } else {
            // Butonun href özelliğini kaldır
            button.onclick = null;
        }
    }

    // İlk yüklemede kontrol et
    checkWidthAndSetHref();

    // Pencere yeniden boyutlandırıldığında kontrol et
    window.addEventListener('resize', checkWidthAndSetHref);
</script>

{{-- dropdown --}}
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const menuToggle = document.querySelector('.menu-toggle');
        const nav = document.querySelector('.nav');
        const dropdowns = document.querySelectorAll('.dropdown');

        menuToggle.addEventListener('click', () => {
            nav.classList.toggle('active');
            // Removed: document.body.classList.toggle('menu-open');
        });

        dropdowns.forEach(dropdown => {
            const dropbtn = dropdown.querySelector('.dropbtn');
            dropbtn.addEventListener('click', (e) => {
                e.preventDefault();

                // Close other dropdowns
                dropdowns.forEach(otherDropdown => {
                    if (otherDropdown !== dropdown && otherDropdown.classList.contains(
                            'active')) {
                        otherDropdown.classList.remove('active');
                    }
                });

                // Toggle current dropdown
                dropdown.classList.toggle('active');
            });
        });

        function closeMobileMenu() {
            nav.classList.remove('active');
            // Removed: document.body.classList.remove('menu-open');
        }

        // Close dropdowns when clicking outside
        document.addEventListener('click', (e) => {
            if (!e.target.closest('.dropdown') && !e.target.closest('.menu-toggle')) {
                dropdowns.forEach(dropdown => {
                    dropdown.classList.remove('active');
                });
                closeMobileMenu();
            }
        });
    });
</script>
