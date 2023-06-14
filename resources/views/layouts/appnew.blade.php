<!DOCTYPE html>
<html>
<head>
    <!-- ... -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet">
    <!-- ... -->
</head>
<body>
    <main class="py-4">
        @yield('content')
    </main>
    <!-- ... -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    @yield('scripts') <!-- Incluir essa linha caso esteja utilizando um arquivo Blade específico -->
</body>
</html>
