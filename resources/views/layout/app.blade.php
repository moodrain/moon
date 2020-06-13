<!doctype html>
<html lang="zh">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="{{ env('APP_URL') . '/element-ui/index.css' }}" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            scrollbar-width: none
        }
        html, body, #app {
            width: 100%;
            height: 100%;
        }
        a {
            text-decoration: none;
            color: black;
        }
        ::-webkit-scrollbar {
            width: 0;
            height: 0
        }
        .el-tag {
            margin: 2px;
        }
    </style>
    @yield('css')
    <title>@yield('title')</title>
</head>
<body>
    @yield('html')
    <script src="{{ env('APP_URL') . '/util/index.js' }}"></script>
    <script src="{{ env('APP_URL') . '/vue/index.js' }}"></script>
    <script src="{{ env('APP_URL') . '/element-ui/index.js' }}"></script>
    @yield('js')
</body>
</html>