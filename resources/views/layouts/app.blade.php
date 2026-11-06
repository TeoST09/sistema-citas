
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title', 'Pet')</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>

    <div class="page">

        <header class="navbar navbar-expand-md navbar-light">
            <div class="container-xl">
                <a href="/" class="navbar-brand">
                   
                </a>
            </div>
        </header>

        <div class="page-wrapper">
            <div class="page-body">
                <div class="container-xl py-4">
                    @yield('content')
                </div>
            </div>
        </div>

    </div>

</body>
</html>
