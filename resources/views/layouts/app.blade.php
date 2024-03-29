<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>DBS</title>

        <!-- jQuery -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

        <!-- favicon -->
        <link rel="shortcut icon" href="{{ asset('image/favicon.svg') }}">

        <!-- Styles -->
        @vite(['resources/css/app.css', 'resources/scss/theme.scss', 'resources/scss/scroll.scss', 'resources/scss/dropdown.scss', 'resources/scss/file_select.scss'])

        <!-- Script -->
        @vite(['resources/js/common.js', 'resources/js/search_date.js', 'resources/js/dropdown.js', 'resources/js/file_select.js', 'resources/js/upload_error.js'])

        <!-- LINE AWESOME -->
        <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">

        <!-- Google Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Kosugi+Maru&family=Marko+One&family=Righteous&display=swap" rel="stylesheet">

        <!-- Lordicon -->
        <script src="https://cdn.lordicon.com/pzdvqjsp.js"></script>

        <!-- toastr.js -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

        <!-- Tippy.js -->
        <script src="https://unpkg.com/@popperjs/core@2"></script>
        <script src="https://unpkg.com/tippy.js@6"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tippy.js/6.3.7/themes/light-border.min.css" integrity="sha512-DiG+GczLaoJczcpFjhVy4sWA1rheh0I6zmlEc+ax7vrq2y/qTg80RtxDOueLcwBrC80IsiQapIgTi++lcGHPLg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tippy.js/6.3.7/themes/translucent.min.css" integrity="sha512-MkXwkRGjkxAMeA0Kma3nhRs2CxojMPMv5kgP+y9OcIQkXOTPGyxmjPPddHPov59evYXjcC5B5hM4yUQ5n49Yog==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    </head>
    <body>
        <div>
            <!-- ナビゲーションメニュー -->
            @include('layouts.navigation')
            <!-- ローディング -->
            <x-loading />
            <!-- ページコンテンツ -->
            <main class="m-3">
                {{ $slot }}
            </main>
        </div>
    </body>
</html>
