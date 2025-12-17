<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>@yield('title')</title>
</head>
<body>

    @include('navigation')

    <div class="container">
        @yield('content')
    </div>

</body>
</html>
