<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>DBS</title>

        <!-- jQuery -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

        <!-- favicon -->
        <link rel="shortcut icon" href="{{ asset('image/favicon.svg') }}">

        <!-- Styles -->
        @vite(['resources/css/app.css', 'resources/scss/theme.scss'])

        <!-- LINE AWESOME -->
        <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">

        <!-- Google Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Kosugi+Maru&family=Marko+One&family=Righteous&display=swap" rel="stylesheet">

        <!-- Lordicon -->
        <script src="https://cdn.lordicon.com/pzdvqjsp.js"></script>

        <!-- toastr.js -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    </head>
    <body>
        <!-- アラート表示 -->
        <x-alert/>
        <div class="flex mt-3">
            @auth
                <a href="{{ route('top.index') }}" class="ml-auto mr-10">トップ</a>
            @else
                <a href="{{ route('login') }}" class="ml-auto">ログイン</a>
                <a href="{{ route('register') }}" class="ml-10 mr-10">ユーザー登録</a>
            @endauth
        </div>
        <div class="">
            <p class="text-4xl text-center">日次収支管理システム</p>
            <p class="MarkoOne text-5xl text-center mt-5"><span class="text-theme-main">D</span>aily <span class="text-theme-main">B</span>alance <span class="text-theme-main">S</span>ystem</p>
        </div>
    </body>
</html>
