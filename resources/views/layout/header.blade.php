<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title')</title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{  asset('css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    @yield('css')
</head>
<body>

<header>
    <div class="container" id="main_header">
        <div class="row">
            <div class="col-sm-6">
                <div class="logo"><a href="/">LOGO NEWS</a></div>
            </div>
            <div class="col-sm-6">
                <form method="get" action="{{ route('search') }}">
                    <div class="md-form active-cyan mb-3">
                        <input class="form-control" name="keyword" required type="text" placeholder="Tìm kiếm" aria-label="Search">
                    </div>
                </form>
            </div>
        </div>
    </div>
</header>