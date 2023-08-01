<footer>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <p>Copyright © 2023 TA Muhammad Nazwan Arrazwa &amp; Adelia Novianti. All Rights Reserved.

                    <br>Designed by <a title="CSS Templates" rel="sponsored" href="https://templatemo.com" target="_blank">TemplateMo</a>
                </p>
            </div>
        </div>
    </div>
</footer>

<!-- Scripts -->
<!-- Bootstrap core JavaScript -->
<script src="<?php echo base_url('assets/'); ?>jquery/jquery.min.js"></script>
<script src="<?php echo base_url('assets/'); ?>bootstrap/js/bootstrap.bundle.min.js"></script>

<script src="<?php echo base_url('assets/'); ?>js/isotope.min.js"></script>
<script src="<?php echo base_url('assets/'); ?>js/owl-carousel.js"></script>

<script src="<?php echo base_url('assets/'); ?>js/tabs.js"></script>
<script src="<?php echo base_url('assets/'); ?>js/swiper.js"></script>
<script src="<?php echo base_url('assets/'); ?>js/custom.js"></script>

<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

<!-- Script untuk menampilkan peta -->
<script>
    const latitude = <?php echo $kordinat->latitude; ?>;
    const longitude = <?php echo $kordinat->longitude; ?>;

    // Membuat peta
    const map = L.map('map', { // 
        dragging: true,
        scrollWheelZoom: false,
        touchZoom: false, // Menonaktifkan zoom dengan menyentuh pada layar sentuh
        doubleClickZoom: false // Menonaktifkan zoom dengan double click pada layar sentuh
    }).setView([latitude, longitude], 17);

    // Menampilkan peta dari OpenStreetMap
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors',
        maxZoom: 18,
    }).addTo(map);

    // Ganti Warna Marker Map
    // var greenIcon = new L.Icon({
    //     iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-red.png',
    //     shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png',
    //     iconSize: [25, 41],
    //     iconAnchor: [12, 41],
    //     popupAnchor: [1, -34],
    //     shadowSize: [41, 41]
    // });

    // Menambahkan penanda (marker) pada lokasi
    //L.marker([latitude, longitude]).addTo(map);
</script>

<!-- 
<script>
    document.cookie = "cookieName=cookieValue; SameSite=Lax";

    // Fungsi untuk menangani event scroll mouse
    function smoothScroll(event) {
        event.preventDefault();
        var wheelDelta = event.wheelDelta || -event.deltaY || -event.detail;
        var delta = Math.max(-1, Math.min(1, wheelDelta));

        var scrollDistance = -100; // Jarak scroll per kali scroll mouse (sesuaikan dengan preferensi Anda, dengan nilai negatif untuk mengubah arah scroll)
        var scrollDuration = 400; // Durasi animasi scroll (sesuaikan dengan preferensi Anda)

        var scrollTarget = window.pageYOffset + delta * scrollDistance;
        var currentTime = 0;
        var increment = 60;

        // Fungsi animasi scroll
        function animateScroll() {
            currentTime += increment;
            var easing = easeInOutQuad(currentTime, window.pageYOffset, scrollTarget - window.pageYOffset, scrollDuration);
            window.scrollTo(0, easing);
            if (currentTime < scrollDuration) {
                requestAnimationFrame(animateScroll);
            }
        }

        // Fungsi easing untuk animasi scroll
        function easeInOutQuad(t, b, c, d) {
            t /= d / 2;
            if (t < 1) return c / 2 * t * t + b;
            t--;
            return -c / 2 * (t * (t - 2) - 1) + b;
        }

        // Memulai animasi scroll
        animateScroll();
    }

    // Menambahkan event listener untuk scroll mouse
    if (window.addEventListener) {
        // Untuk browser modern
        window.addEventListener("wheel", smoothScroll, {
            passive: false
        });
        window.addEventListener("mousewheel", smoothScroll, {
            passive: false
        });
    } else {
        // Untuk browser lama
        window.attachEvent("onmousewheel", smoothScroll);
    }
</script> -->
<script>
    setTimeout(function() {
        $('.preloader').fadeOut(1000);
    }, 500);

    $(function() {
        $('.alert').delay(2000).fadeOut(1500);
    })
</script>

<script>
    var interleaveOffset = 0.5;

    var swiperOptions = {
        autoplay: {
            delay: 5000,
        },
        loop: true,
        speed: 1000,
        grabCursor: true,
        watchSlidesProgress: true,
        mousewheelControl: true,
        keyboardControl: true,
        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev"
        },
        on: {
            progress: function() {
                var swiper = this;
                for (var i = 0; i < swiper.slides.length; i++) {
                    var slideProgress = swiper.slides[i].progress;
                    var innerOffset = swiper.width * interleaveOffset;
                    var innerTranslate = slideProgress * innerOffset;
                    swiper.slides[i].querySelector(".slide-inner").style.transform =
                        "translate3d(" + innerTranslate + "px, 0, 0)";
                }
            },
            touchStart: function() {
                var swiper = this;
                for (var i = 0; i < swiper.slides.length; i++) {
                    swiper.slides[i].style.transition = "";
                }
            },
            setTransition: function(speed) {
                var swiper = this;
                for (var i = 0; i < swiper.slides.length; i++) {
                    swiper.slides[i].style.transition = speed + "ms";
                    swiper.slides[i].querySelector(".slide-inner").style.transition =
                        speed + "ms";
                }
            }
        }
    };

    var swiper = new Swiper(".swiper-container", swiperOptions);
</script>
</body>

</html>