<!doctype html>
<html lang="{{ config('app.locale') }}" class="no-focus">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">

        <title>AGEL website</title>
        <meta name="author" content="AGEL">
        <meta name="robots" content="noindex, nofollow">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <!-- Icons -->
        <link rel="shortcut icon" href="{{ asset('media/favicons/favicon.png') }}">
         

        <!-- Fonts and Styles -->
        @yield('css_before')
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito+Sans:300,400,400i,600,700">
        <link rel="stylesheet" id="css-main" href="{{ mix('/css/codebase.css') }}">
        <link rel="stylesheet" href="{{ mix('/css/screen.css') }}">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.js"></script>

        <!-- You can include a specific file from public/css/themes/ folder to alter the default color theme of the template. eg: -->
        <link rel="stylesheet" id="css-theme" href="{{ mix('/css/themes/pulse.css') }}">
        @yield('css_after')

        <!-- Scripts -->
        <script>window.Laravel = {!! json_encode(['csrfToken' => csrf_token(),]) !!};</script>
    </head>
    <body>
        <!-- Page Container -->
        <!--
            Available classes for #page-container:

        GENERIC

            'enable-cookies'                            Remembers active color theme between pages (when set through color theme helper Template._uiHandleTheme())

        SIDEBAR & SIDE OVERLAY

            'sidebar-r'                                 Right Sidebar and left Side Overlay (default is left Sidebar and right Side Overlay)
            'sidebar-mini'                              Mini hoverable Sidebar (screen width > 991px)
            'sidebar-o'                                 Visible Sidebar by default (screen width > 991px)
            'sidebar-o-xs'                              Visible Sidebar by default (screen width < 992px)
            'sidebar-inverse'                           Dark themed sidebar

            'side-overlay-hover'                        Hoverable Side Overlay (screen width > 991px)
            'side-overlay-o'                            Visible Side Overlay by default

            'enable-page-overlay'                       Enables a visible clickable Page Overlay (closes Side Overlay on click) when Side Overlay opens

            'side-scroll'                               Enables custom scrolling on Sidebar and Side Overlay instead of native scrolling (screen width > 991px)

        HEADER

            ''                                          Static Header if no class is added
            'page-header-fixed'                         Fixed Header

        HEADER STYLE

            ''                                          Classic Header style if no class is added
            'page-header-modern'                        Modern Header style
            'page-header-inverse'                       Dark themed Header (works only with classic Header style)
            'page-header-glass'                         Light themed Header with transparency by default
                                                        (absolute position, perfect for light images underneath - solid light background on scroll if the Header is also set as fixed)
            'page-header-glass page-header-inverse'     Dark themed Header with transparency by default
                                                        (absolute position, perfect for dark images underneath - solid dark background on scroll if the Header is also set as fixed)

        MAIN CONTENT LAYOUT

            ''                                          Full width Main Content if no class is added
            'main-content-boxed'                        Full width Main Content with a specific maximum width (screen width > 1200px)
            'main-content-narrow'                       Full width Main Content with a percentage width (screen width > 1200px)
        -->
        @if (Auth::user())
            <div id="page-container" class="sidebar-o enable-page-overlay side-scroll page-header-modern main-content-narrow">

                <!-- Sidebar -->
                
                @include('layouts.navbar')
                
                <!-- END Sidebar -->

                <!-- Header -->
                <header id="page-header">
                    <!-- Header Content -->
                    <div class="content-header">
                            @include('layouts.left_header')

                            <!-- Right Section -->
                            @include('layouts.right_header')
                            <!-- END Right Section -->
                    </div>
                    <!-- END Header Content -->


                </header>
                <!-- END Header -->

                <!-- Main Container -->
                <main id="main-container">
                    @include('layouts.messages')
                    @yield('content')
                </main>
                <!-- END Main Container -->

                <!-- Footer -->
                <footer id="page-footer" class="opacity-0">
                    <div class="content py-20 font-size-sm clearfix">
                        <div class="float-right">
                            Crafted with <i class="fa fa-heart text-pulse"></i> by Cheniaux, Bolland, Egon, TDB et Houart
                        </div>
                        <div class="float-left">
                            <a class="font-w600" href="#" target="_blank">AGEL</a> &copy; <span class="js-year-copy"></span>
                        </div>
                    </div>
                </footer>
                <!-- END Footer -->
            </div>
            <!-- END Page Container -->
        @else
            <div id="page-container" class=" enable-page-overlay page-header-modern main-content-narrow">
                <main id="main-container" style="height: 0px;" class="mt-4 pt-4">
                        @include('layouts.messages')
                        @yield('content')
                </main>
                <footer id="page-footer" class="opacity-0" style="margin:0px;">
                        <div class="content font-size-sm clearfix">
                            <div class="float-right">
                                Crafted with <i class="fa fa-heart text-pulse"></i> by Bolland, Egon, TDB et Houart
                            </div>
                            <div class="float-left">
                                <a class="font-w600" href="#" target="_blank">AGEL</a> &copy; <span class="js-year-copy"></span>
                            </div>
                        </div>
                    </footer>
            </div>
        @endif

        <!-- Codebase Core JS -->
        <script src="{{ mix('js/codebase.app.js') }}"></script>

        <!-- Laravel Scaffolding JS -->
        <!-- <script src="{{ mix('js/laravel.app.js') }}"></script> -->

        @yield('js_after')
    </body>
</html>
