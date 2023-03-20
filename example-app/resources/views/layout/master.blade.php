<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', "unKown Page")</title>
    <link rel="stylesheet" href="css/app.css">
</head>
<body>
    {{-- start navbar --}}
    @include('layout.navbar')
    {{-- End navbar --}}

    @section('sidebar')
        This Is Sidebar From Master
    @show

    @yield('content')


</body>
</html>
