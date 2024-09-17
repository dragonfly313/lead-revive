<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="keywords" content="{{ $seo->keywords }}">
    <meta name="description" content="{{ $seo->description }}">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $seo->title }}</title>

    <!-- Loading Bootstrap -->
    <link href="{{ asset('saas/home/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('saas/home/css/components.css') }}" rel="stylesheet">
    <link href="{{ asset('saas/home/css/icons.css') }}" rel="stylesheet">
    <link href="{{ asset('saas/home/css/typicons.css') }}" rel="stylesheet">
    <!-- Loading Template CSS -->
    <link href="{{ asset('saas/home/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('saas/home/css/animate.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('saas/home/css/pe-icon-7-stroke.css') }}">
    <link href="{{ asset('saas/home/css/style-magnific-popup.css') }}" rel="stylesheet">

    <!-- Awsome Fonts -->
    <link rel="stylesheet" href="{{ asset('saas/home/css/all.min.css') }}">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway|Cabin:700" rel="stylesheet">

    <!-- Font Favicon -->
    <link rel="shortcut icon" href="{{ asset('saas/img/favicon.png') }}">
    <link rel="stylesheet" href="{{ asset('assets/fontawesome-6.5.2/css/fontawesome.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/fontawesome-6.5.2/css/brands.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/fontawesome-6.5.2/css/solid.css') }}">
    <link rel="stylesheet" href="{{ asset('saas/css/toastr.min.css') }}">
    @livewireStyles
    @stack('styles')
</head>

<body class="bg-custom" style="color: white;">

    <!--begin header -->
    <header class="header">

        <!--begin navbar-fixed-top -->
        <nav id="header" class="navbar navbar-default navbar-fixed-top p-0">

            <!--begin container -->
            <div class="container">

                <!--begin navbar -->
                <nav class="navbar navbar-expand-lg p-0">

                    <!--begin logo -->
                    <a class="navbar-brand p-0" href="/">
                        <img src="{{ asset('saas/img/logo.png') }}" class="navbar-brand-img" alt="knine" style="max-height: 7rem;">
                    </a>
                    <!--end logo -->

                    <!--begin navbar-toggler -->
                    <button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"><i class="fas fa-bars"></i></span>
                    </button>
                    <!--end navbar-toggler -->

                    <!--begin navbar-collapse -->
                    <div class="navbar-collapse collapse" id="navbarCollapse">

                        <!--begin navbar-nav -->
                        <ul class="ml-auto navbar-nav d-flex align-items-center">

                            @foreach ($menu as $item)
                            <li class="link"><a href="{{ $item->link }}">{{ $item->text }}</a></li>
                            @endforeach

                            @guest
                            {{-- <a href="/login" role="button" class="btn-1">Login</a> --}}
                            <li class="discover-link"><a href="/register" class="external">{{ __('Register') }}</a>
                            </li>
                            <li class="discover-link"><a href="/login" class="external discover-btn">{{ __('Login') }}</a></li>
                            @else
                            <div>
                                <span class="nav-item dropdown">
                                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

                                        <span class="avatar rounded-circle">
                                            <img alt="Image placeholder" class="rounded-circle" width="35" src="{{ Auth::user()->profile_photo_url }}">
                                        </span>
                                    </a>

                                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                        <!-- User Account Link -->
                                        <a class="dropdown-item" href="{{ route('profile.show') }}">
                                            <span class="dropdown-item-icon">
                                                <i class="fas fa-user"></i>
                                            </span>
                                            {{ __('Profile') }}
                                        </a>
                                        <a class="dropdown-item" href="{{ route('account.password') }}">
                                            <span class="dropdown-item-icon">
                                                <i class="fas fa-unlock-alt"></i>
                                            </span>
                                            {{ __('Password') }}
                                        </a>
                                        @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                                        <a class="dropdown-item" href="{{ route('api-tokens.index') }}">
                                            <span class="dropdown-item-icon">
                                                <i class="fab fa-keycdn"></i>
                                            </span>
                                            {{ __('API Tokens') }}
                                        </a>
                                        @endif
                                        @role('Owner')
                                        <a class="dropdown-item" target="__blank" href="{{ route('admin.index') }}">
                                            <span class="dropdown-item-icon">
                                                <i class="fas fa-tachometer-alt"></i>
                                            </span>
                                            {{ __('Admin panel') }}
                                        </a>
                                        @endrole
                                        @role('Accounting')
                                        <a class="dropdown-item" target="__blank" href="{{ route('admin.index') }}">
                                            <span class="dropdown-item-icon">
                                                <i class="fas fa-tachometer-alt"></i>
                                            </span>
                                            {{ __('Admin panel') }}
                                        </a>
                                        @endrole
                                        @role('Website')
                                        <a class="dropdown-item" target="__blank" href="{{ route('admin.index') }}">
                                            <span class="dropdown-item-icon">
                                                <i class="fas fa-tachometer-alt"></i>
                                            </span>
                                            {{ __('Admin panel') }}
                                        </a>
                                        @endrole
                                        @auth
                                        <!-- Team Switcher -->
                                        <small class="dropdown-item">
                                            {{ __('Switch teams') }}
                                        </small>
                                        @foreach (Auth::user()->allTeams() as $team)
                                        <x-jet-switchable-team :team="$team" />
                                        @endforeach
                                        @endauth
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                                            <span class="dropdown-item-icon">
                                                <i class="fas fa-power-off"></i>
                                            </span>
                                            {{ __('Logout') }}
                                        </a>
                                        <form method="POST" id="logout-form" action="{{ route('logout') }}">
                                            @csrf
                                        </form>

                                        <div class="dropdown-divider"></div>
                                    </div>
                                </span>
                            </div>
                            @endguest
                            <li class="nav-item dropdown mr-4">
                                <div class="hs-unfold">
                                    <a class="pr-0 nav-link btn btn-secondary" href="#" role="button" data-toggle="dropdown" style="background-color:transparent; border:0px;" aria-haspopup="true" aria-expanded="false">
                                        <div class="media-body d-none d-lg-block">
                                            <img src="{{ asset('saas/svg/flags/' . app()->getLocale() . '.svg') }}" alt="United States Flag">
                                            <span>{{ app()->getLocale() }}</span>
                                        </div>
                                    </a>

                                    <div id="footerLanguage" class="hs-unfold-content dropdown-menu dropdown-unfold dropdown-menu-bottom mb-2">
                                        @foreach (language()->allowed() as $code => $name)
                                        <a class="dropdown-item" href="{{ language()->back($code) }}">{{ $name }}</a>
                                        @endforeach
                                    </div>
                                </div>
                            </li>
                        </ul>
                        <!--end navbar-nav -->
                    </div>
                    <!--end navbar-collapse -->
                </nav>
                <!--end navbar -->
            </div>
            <!--end container -->
        </nav>
        <!--end navbar-fixed-top -->
    </header>
    <!--end header -->

    <div class="slot-container">
        {{ $slot }}
    </div>

    <div class="cst-divider"></div>

    <!--begin footer -->
    <div id="footer" class="py-5">

        <!--begin container -->
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <img src="{{ asset('saas/img/logo.png') }}" style="max-width: 14rem; width: 100%;" />
                    <p id="footerBlock1Text1">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Assumenda beatae ducimus suscipit, ab quidem voluptate nulla, in veniam deleniti nesciunt mollitia. Odio officiis consectetur voluptatibus quia rem alias numquam dolorum.</p>
                </div>
                <div class="col-md-3 pt-4">
                    <h5 id="footerBlock2Title">Use Cases</h5>
                    <ul>
                        <li id="footerBlock2Text1" class="mb-3">Web-designers</li>
                        <li id="footerBlock2Text2" class="mb-3">Marketers</li>
                        <li id="footerBlock2Text3" class="mb-3">Small Business</li>
                        <li id="footerBlock2Text4">Website Builder</li>
                    </ul>
                </div>
                <div class="col-md-3 pt-4">
                    <h5 id="footerBlock3Title">Company</h5>
                    <ul>
                        <li id="footerBlock3Text1" class="mb-3">About Us</li>
                        <li id="footerBlock3Text2" class="mb-3">Careers</li>
                        <li id="footerBlock3Text3" class="mb-3">FAQs</li>
                        <li id="footerBlock3Text4" class="mb-3">Teams</li>
                        <li id="footerBlock3Text5">Contact Us</li>
                    </ul>
                </div>
                <div class="col-md-3 pt-4">
                    <h5 id="footerBlock4Title">Follow Us</h5>
                    <div class="d-flex text-white" style="gap: 1rem;">
                        <i id="footer-icon-1" class="fa-brands fa-facebook fa-2x"></i>
                        <i id="footer-icon-2" class="fa-brands fa-gitlab fa-2x"></i>
                        <i id="footer-icon-3" class="fa-brands fa-github fa-2x"></i>
                        <i id="footer-icon-4" class="fa-brands fa-telegram fa-2x"></i>
                        <i id="footer-icon-5" class="fa-brands fa-instagram fa-2x"></i>
                        <i id="footer-icon-6" class="fa-brands fa-figma fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>
        <!--end container -->

    </div>
    <!--end footer -->

    @livewireScripts
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('saas/home/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('saas/home/js/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('saas/home/js/jquery.nav.js') }}"></script>
    <script src="{{ asset('assets/js/const.js') }}"></script>
    <script type="text/javascript">
        let receivedData = <?php echo json_encode($settings); ?>;
    </script>
    <script src="{{ asset('plugins/toastr/toastr.min.js') }}"></script>
    <script src="{{ asset('assets/js/load-settings.js') }}"></script>
    <script src="{{ asset('saas/home/js/wow.js') }}"></script>
    <script src="{{ asset('saas/home/js/plugins.js') }}"></script>
    <script src="{{ asset('saas/home/js/custom.js') }}"></script>

    <!--Start of Tawk.to Script-->
    @if (config('saas.demo_mode'))
    <script type="text/javascript">
        var Tawk_API = Tawk_API || {},
            Tawk_LoadStart = new Date();
        (function() {
            var s1 = document.createElement("script"),
                s0 = document.getElementsByTagName("script")[0];
            s1.async = true;
            s1.src = 'https://embed.tawk.to/5fbb1a42a1d54c18d8ec4a68/default';
            s1.charset = 'UTF-8';
            s1.setAttribute('crossorigin', '*');
            s0.parentNode.insertBefore(s1, s0);
        })();
    </script>
    @endif
    @stack('scripts')
    <!--End of Tawk.to Script-->
</body>

</html>