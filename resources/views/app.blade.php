<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin task</title>

    @routes
    @vite('resources/js/app.js')
    @inertiaHead
</head>

<body class="bg-gray-100">
    @inertia
</body>

</html>
