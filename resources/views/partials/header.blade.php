<!doctype html>
<html class="no-js" lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    @yield('page-specific-meta')
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ appName() }}</title>
    <link rel="stylesheet" href="/css/vendor/foundation.css">
    <link rel="stylesheet" href="/css/vendor/sweetalert.css">
    <link rel="stylesheet" href="/css/vendor/select2.min.css">
    <link rel="stylesheet" href="/css/main.css">

    <!-- google font -->
    <link href="https://fonts.googleapis.com/css?family=Ubuntu:300,300i,400,400i,500,500i,700,700i" rel="stylesheet">

    <!-- icons -->
    <link rel="stylesheet" href="/css/vendor/foundation-icons.css">

    @yield('page-styles')

    <script>
        window.isLoggedIn = {{ $isLoggedIn ? 1 : 0 }}
        window.authUserId = {!!   $authUser ? $authUser->id : 0 !!}
    </script>
</head>
<body>

    <div class="off-canvas-wrapper">
        <div class="off-canvas-wrapper-inner" data-off-canvas-wrapper>

            <!-- off-canvas title bar for 'small' screen -->
            <div class="title-bar" data-responsive-toggle="main-menu" data-hide-for="medium">
                <div class="title-bar-left">
                    <button class="menu-icon" type="button" data-open="offCanvasLeft"></button>
                    <span class="title-bar-title">{{ appName() }}</span>
                </div>
                <div class="title-bar-right">
                    <span class="title-bar-title">Login</span>
                    <button class="menu-icon" type="button" data-open="offCanvasRight"></button>
                </div>
            </div>

            <!-- off-canvas left menu -->
            @include('partials.nav-contents.mobile-left')

            <!-- off-canvas right menu -->
            @include('partials.nav-contents.mobile-right')

            <!-- "wider" top-bar menu for 'medium' and up -->
            <div id="main-menu" class="top-bar">
               <div class="row">

                   @include('partials.nav-contents.desktop-left')

                   @include('partials.nav-contents.desktop-right')

               </div>

            </div>

            <!-- original content goes in this container -->
            <div class="off-canvas-content" data-off-canvas-content>