<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sistem Sarpras</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">

    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">

    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet"
        href="{{ asset('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">

    <!-- iCheck -->
    <link rel="stylesheet" href="{{ asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">

    <!-- JQVMap -->
    <link rel="stylesheet" href="{{ asset('plugins/jqvmap/jqvmap.min.css') }}">

    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">

    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{ asset('plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">

    <!-- Daterange picker -->
    <link rel="stylesheet" href="{{ asset('plugins/daterangepicker/daterangepicker.css') }}">

    <!-- summernote -->
    <link rel="stylesheet" href="{{ asset('plugins/summernote/summernote-bs4.min.css') }}">
</head>
<style>
    .preloader {
        background: radial-gradient(circle,
                #2b0000 0%,
                #120000 45%,
                #050000 75%,
                #000 100%);
    }

    /* CONTAINER */
    .eye-box {
        position: relative;
        width: 200px;
        height: 200px;
    }

    /* COMMON */
    .eye {
        position: absolute;
        inset: 0;
        width: 100%;
        height: 100%;
        border-radius: 50%;
    }

    /* SHARINGAN AWAL */
    /* SHARINGAN CEPAT */
    .sharingan {
    opacity: 0;
    filter: drop-shadow(0 0 10px red);
}

.mangekyo {
    opacity: 0;
    filter: drop-shadow(0 0 25px crimson);
}

/* class trigger */
.play-sharingan {
    animation: sharinganFast 0.7s linear forwards;
}

.play-mangekyo {
    animation: mangekyoFast 0.7s ease-out forwards;
}


    /* KEYFRAMES */
    @keyframes sharinganFast {
        0% {
            transform: scale(0.6) rotate(0deg);
            opacity: 0;
        }

        20% {
            opacity: 1;
        }

        80% {
            transform: scale(1.3) rotate(540deg);
        }

        100% {
            transform: scale(1.5) rotate(720deg);
            opacity: 0;
        }
    }

    @keyframes mangekyoFast {
        0% {
            transform: scale(0.3) rotate(-360deg);
            opacity: 0;
        }

        40% {
            opacity: 1;
        }

        100% {
            transform: scale(1) rotate(360deg);
            opacity: 1;
        }
    }
</style>

<body class="hold-transition sidebar-mini layout-fixed">
   <audio id="mangekyoSound" preload="auto">
    <source src="{{ asset('dist/audio/mangekyou.mp3') }}" type="audio/mpeg">
</audio>

    <div class="wrapper">
        <!-- Preloader -->
        <div class="preloader flex-column justify-content-center align-items-center">
            <div class="eye-box">
                <img src="{{ asset('dist/img/amaterasu.png') }}" class="eye sharingan">
                <img src="{{ asset('dist/img/amaterasu.png') }}" class="eye mangekyo">
            </div>
        </div>

        @include('layouts.partials.navbar')
        @include('layouts.partials.sidebar')

        <div class="content-wrapper">
            <div class="content-header">
                <div class="container-fluid">
                    @yield('content')
                </div>
            </div>
        </div>
        @include('layouts.partials.footer')
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content -->
        </aside>
    </div>
    <script>
document.addEventListener('DOMContentLoaded', () => {
    const sound = document.getElementById('mangekyoSound');
    const sharingan = document.querySelector('.sharingan');
    const mangekyo = document.querySelector('.mangekyo');
    const preloader = document.querySelector('.preloader');

    sound.volume = 0.8;

    const startAnimation = () => {
        // reset audio
        sound.currentTime = 0;
        sound.play();

        // start animasi BARANGAN
        sharingan.classList.add('play-sharingan');

        setTimeout(() => {
            mangekyo.classList.add('play-mangekyo');
        }, 700);

        // hilangkan preloader
        setTimeout(() => {
            preloader.classList.add('fade-out');
        }, 1600);
    };

    // autoplay fallback (aturan browser)
    sound.play().then(() => {
        sound.pause();
        startAnimation();
    }).catch(() => {
        document.addEventListener('click', startAnimation, { once: true });
    });
});
</script>

    <!-- jQuery -->
    <script src="{{ asset('plugins/jquery/jquery.min.js') }}">
        < />

        <
        !--jQuery UI 1.11 .4-- >
        <
        script src = "{{ asset('plugins/jquery-ui/jquery-ui.min.js') }}" >
    </script>

    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
        $.widget.bridge('uibutton', $.ui.button)
    </script>

    <!-- Bootstrap 4 -->
    <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- ChartJS -->
    <script src="{{ asset('plugins/chart.js/Chart.min.js') }}"></script>

    <!-- Sparkline -->
    <script src="{{ asset('plugins/sparklines/sparkline.js') }}"></script>

    <!-- JQVMap -->
    <script src="{{ asset('plugins/jqvmap/jquery.vmap.min.js') }}"></script>
    <script src="{{ asset('plugins/jqvmap/maps/jquery.vmap.usa.js') }}"></script>

    <!-- jQuery Knob Chart -->
    <script src="{{ asset('plugins/jquery-knob/jquery.knob.min.js') }}"></script>

    <!-- daterangepicker -->
    <script src="{{ asset('plugins/moment/moment.min.js') }}"></script>
    <script src="{{ asset('plugins/daterangepicker/daterangepicker.js') }}"></script>

    <!-- Tempusdominus Bootstrap 4 -->
    <script src="{{ asset('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>

    <!-- Summernote -->
    <script src="{{ asset('plugins/summernote/summernote-bs4.min.js') }}"></script>

    <!-- overlayScrollbars -->
    <script src="{{ asset('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>

    <!-- AdminLTE App -->
    <script src="{{ asset('dist/js/adminlte.js') }}"></script>

    <!-- AdminLTE for demo purposes -->
    <script src="{{ asset('dist/js/demo.js') }}"></script>

    <!-- AdminLTE dashboard demo -->
    <script src="{{ asset('dist/js/pages/dashboard.js') }}"></script>
</body>

</html>
