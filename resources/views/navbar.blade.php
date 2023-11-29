<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Neizvirni komiki</title>
    <!-- Include Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('/css/home.css') }}" rel="stylesheet"> 
    <link href="{{ asset('/css/search.css') }}" rel="stylesheet"> 

</head>
<body>
    <!-- Bootstrap Menu -->
    <x-navbar />
    <!-- Content Section -->
      @yield('content') 

    <!-- Include Bootstrap JS (optional) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
