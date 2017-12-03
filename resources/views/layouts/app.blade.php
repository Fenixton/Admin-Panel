<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
    <link href="/resources/assets/css/bootstrap.min.css" rel="stylesheet">
    <link rel="shortcut icon" href="/images/logo/favicon.png" type="image/x-icon">
    <link rel="stylesheet" href="/resources/assets/css/bootstrap.css" type="text/css" />
    <link rel="stylesheet" href="/resources/assets/css/messenger.css" type="text/css" />
    <link rel="stylesheet" href="/resources/assets/css/messenger-theme-flat.css" type="text/css" />
    <link rel="stylesheet" href="/resources/assets/css/backend_site.minify.css" type="text/css" />
</head>
<body>
@yield('app_content')
<script src="/resources/assets/js/jquery.min.js"></script>
<script src="/resources/assets/js/bootstrap.min.js"></script>
<script src="/resources/assets/js/app.js"></script>
</body>
</html>