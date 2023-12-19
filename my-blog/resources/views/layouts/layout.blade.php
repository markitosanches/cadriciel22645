<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>{{ config('app.name')}}</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    </head>
    <body>
    <nav class="navbar navbar-expand-lg bg-light">
        <div class="container-fluid">

            <a class="navbar-brand" href="#">Hello {{Auth::user() ? Auth::user()->name : "Guest"}}</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav">
                    @guest
                    <a class="nav-link" href="{{route('registration')}}">Registration</a>
                    <a class="nav-link" href="{{route('blog.index')}}">Blog</a>
                    <a class="nav-link" href="{{route('login')}}">Login</a>
                    @else
                    <a class="nav-link" href="{{route('user.list')}}">User List</a>
                    <a class="nav-link" href="{{route('blog.create')}}">Blog Create</a>
                    <a class="nav-link" href="{{route('logout')}}">Logout</a>
                    @endguest
            </div>
            </div>
        </div>
    </nav>
        <div class="container">
            <div class="row">
                <div class="col-12 text-center pt-2">
                    <h1 class="display-4">
                        {{ config('app.name')}}
                    </h1>
                </div>
            </div>
            <hr>
            @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>{{ session('success')}}</strong> 
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif
            @yield('content')

        </div>
    </body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</html>