<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="keywords" content="">
    <meta name="description" content="">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }}</title>

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
    <link rel="stylesheet" href="{{ asset('saas/css/toastr.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/fontawesome-6.5.2/css/fontawesome.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/fontawesome-6.5.2/css/brands.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/fontawesome-6.5.2/css/solid.css') }}">
    @livewireStyles
</head>

<body>
    <!-- ======== End Navbar ======== -->
    <!--begin header -->
    <div class="cst-border-b-grey py-3">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center">
                <h2 class="text-dark">Page Manage</h2>
                <div>
                    <a href="/user/profile" class="btn btn-outline-secondary btn-small mr-2">Profile</a>
                    <a href="/" class="btn btn-outline-secondary btn-small">Home</a>
                </div>
            </div>
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <span>Header Background</span>
                    <input id="headerBackColor" type="color" class="form-control d-inline mr-4" style="width: 60px;" value='#ffffff' onchange="onBackColorChange(event)" />
                    <span>Body Background</span>
                    <input id="bodyBackColor" type="color" class="form-control d-inline mr-4" style="width: 60px;" value='#ffffff' onchange="onBackColorChange(event)" />
                    <span>Footer Background</span>
                    <input id="footerBackColor" type="color" class="form-control d-inline" style="width: 60px;" value='#ffffff' onchange="onBackColorChange(event)" />
                </div>
                <button class="btn btn-primary btn-small" onclick="save()">Save</button>
            </div>
        </div>
    </div>
    <div id="compose-main" class="bg-custom" style="color: white;">
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
            <!--begin section-home -->
            <section id="home" class="py-5">

                <!--begin container -->
                <div class="container">
                    <!--begin row -->
                    <div class="row">

                        <!--begin col-md-6-->
                        <div class="col-md-6">
                            <h1>
                                <span contenteditable="true" id="homeTitleWhite">{{ __('Discover And Revive') }}</span>
                                <span contenteditable="true" id="homeTitleGreen" class="text-success">{{ __('Lost Leads') }}</span>
                            </h1>

                            <p contenteditable="true" id="homeText1">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Repellendus, facere vero modi suscipit animi ea, amet laudantium cumque cupiditate voluptatum exercitationem sit aliquam. Autem, itaque quisquam. Earum ipsam totam reprehenderit? Lorem ipsum dolor sit amet consectetur adipisicing elit. Vitae adipisci vero repellat esse dolores ratione unde aliquid. Ipsam quasi, autem incidunt quam nobis enim quibusdam labore in tenetur perferendis atque. Lorem ipsum, dolor sit amet consectetur adipisicing elit. Voluptatibus, quo accusamus? Error, magnam eius quo recusandae quaerat optio consequuntur voluptates ea architecto aut, iste, vitae hic adipisci quidem dicta harum?</p>

                            <div class="d-flex">
                                <span class="mr-4">
                                    <button id="findOutBtn" class="btn btn-success rounded-pill" data-toggle="modal" data-target="#findOutBtnModal">FIND OUT MORE</button>
                                </span>
                                <div class="modal text-dark" id="findOutBtnModal">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">

                                            <!-- Modal Header -->
                                            <div class="modal-header">
                                                <h4 class="modal-title text-dark">Button Edit</h4>
                                            </div>

                                            <!-- Modal body -->
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label for="findOutBtn-content">Content</label>
                                                    <input id="findOutBtn-content" class="form-control" value="FIND OUT MORE" />
                                                </div>
                                                <div class="form-group">
                                                    <label for="findOutBtn-type">Type</label>
                                                    <select id="findOutBtn-type" class="form-control">
                                                        <option value="primary">primary</option>
                                                        <option value="secondary">secondary</option>
                                                        <option value="success">success</option>
                                                        <option value="info">info</option>
                                                        <option value="warning">warning</option>
                                                        <option value="danger">danger</option>
                                                        <option value="dark">dark</option>
                                                        <option value="light">light</option>
                                                        <option value="link">link</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="findOutBtn-outline">Outline</label>
                                                    <select id="findOutBtn-outline" class="form-control">
                                                        <option value="false">false</option>
                                                        <option value="true">true</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="findOutBtn-size">Size</label>
                                                    <select id="findOutBtn-size" class="form-control">
                                                        <option value="md">medium</option>
                                                        <option value="sm">small</option>
                                                        <option value="lg">large</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="findOutBtn-border_radius">Border Radius</label>
                                                    <select id="findOutBtn-border_radius" class="form-control">
                                                        <option value="default">default</option>
                                                        <option value="none">none</option>
                                                        <option value="pill">pill</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <!-- Modal footer -->
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-primary" onclick="btnSet('findOutBtn')" data-dismiss="modal">Set</button>
                                                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <button id="findOutOutlineBtn" class="btn btn-outline-success rounded-pill" data-toggle="modal" data-target="#findOutOutlineBtnModal">FIND OUT MORE</button>
                                <div class="modal text-dark" id="findOutOutlineBtnModal">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">

                                            <!-- Modal Header -->
                                            <div class="modal-header">
                                                <h4 class="modal-title text-dark">Button Edit</h4>
                                            </div>

                                            <!-- Modal body -->
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label for="findOutOutlineBtn-content">Content</label>
                                                    <input id="findOutOutlineBtn-content" class="form-control" value="FIND OUT MORE" />
                                                </div>
                                                <div class="form-group">
                                                    <label for="findOutOutlineBtn-type">Type</label>
                                                    <select id="findOutOutlineBtn-type" class="form-control">
                                                        <option value="primary">primary</option>
                                                        <option value="secondary">secondary</option>
                                                        <option value="success">success</option>
                                                        <option value="info">info</option>
                                                        <option value="warning">warning</option>
                                                        <option value="danger">danger</option>
                                                        <option value="dark">dark</option>
                                                        <option value="light">light</option>
                                                        <option value="link">link</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="findOutOutlineBtn-outline">Outline</label>
                                                    <select id="findOutOutlineBtn-outline" class="form-control">
                                                        <option value="false">false</option>
                                                        <option value="true">true</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="findOutOutlineBtn-size">Size</label>
                                                    <select id="findOutOutlineBtn-size" class="form-control">
                                                        <option value="md">medium</option>
                                                        <option value="sm">small</option>
                                                        <option value="lg">large</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="findOutOutlineBtn-border_radius">Border Radius</label>
                                                    <select id="findOutOutlineBtn-border_radius" class="form-control">
                                                        <option value="default">default</option>
                                                        <option value="none">none</option>
                                                        <option value="pill">pill</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <!-- Modal footer -->
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-primary" onclick="btnSet('findOutOutlineBtn')" data-dismiss="modal">Set</button>
                                                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <!--end col-md-6-->

                        <!--begin col-md-6-->
                        <div class="col-md-6">
                            <img src="{{ asset('storage/back_imgs/leads.png') }}" id="leads_img" class="w-100 cursor-pointer" alt="pic" onclick="document.getElementById('leads_input').click()" />
                            <input id='leads_input' type="file" class="d-none" onchange="onImgChange(event)" />
                        </div>
                        <!--end col-md-6-->

                    </div>
                    <!--end row -->
                </div>
                <!--end container -->

            </section>
            <!--end section-home -->

            <div class="cst-divider"></div>

            <!--begin section-discover -->
            <section id="aboutUs" class="py-5">

                <!--begin container -->
                <div class="container">

                    <!--begin row -->
                    <div class="row">

                        <!--begin col-md-6 -->
                        <div class="col-md-6">
                            <video width="100%" height="auto" controls>
                                <source src="movie.mp4" type="video/mp4">
                                <source src="movie.ogg" type="video/ogg">
                                Your browser does not support the video tag.
                            </video>
                        </div>
                        <!--end col-md-6 -->

                        <!--begin col-md-6 -->
                        <div class="col-md-6">

                            <h1>
                                <span contenteditable="true" id="discoverTitleWhite">{{ __('Discover And Revive') }}</span>
                                <span contenteditable="true" id="discoverTitleGreen" class="text-success">{{ __('Lost Leads') }}</span>
                            </h1>

                            <p contenteditable="true" id="discoverText1">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Repellendus, facere vero modi suscipit animi ea, amet laudantium cumque cupiditate voluptatum exercitationem sit aliquam. Autem, itaque quisquam. Earum ipsam totam reprehenderit? Lorem ipsum dolor sit amet consectetur adipisicing elit. Vitae adipisci vero repellat esse dolores ratione unde aliquid. Ipsam quasi, autem incidunt quam nobis enim quibusdam labore in tenetur perferendis atque. Lorem ipsum, dolor sit amet consectetur adipisicing elit. Voluptatibus, quo accusamus? Error, magnam eius quo recusandae quaerat optio consequuntur voluptates ea architecto aut, iste, vitae hic adipisci quidem dicta harum?</p>

                        </div>
                        <!--end col-md-6 -->
                    </div>
                </div>
                <!--end container -->
            </section>
            <!--end section-discover -->

            <!--begin section-what -->
            <section class="py-5">

                <!--begin container -->
                <div class="container">
                    <!--begin row -->
                    <div class="row">

                        <!--begin col-md-6-->
                        <div class="col-md-6">
                            <h1>
                                <span contenteditable="true" id="whatTitleWhite">{{ __('What Is') }}</span>
                                <span contenteditable="true" id="whatTitleGreen" class="text-success">{{ __('Lead Revive') }}</span>
                            </h1>

                            <p contenteditable="true" id="whatText1">Lorem Ipsum is placeholder text commonly used in the graphic, print, and publishing industries for previewing layouts and visual presentations. It has no inherent meaning, making it useful for demonstrating the visual appearance of a document or design without the distraction of meaningful content. Lorem Ipsum is placeholder text commonly. Lorem Ipsum is placeholder text commonly used in the graphic, print, and publishing industries for previewing layouts and visual presentations. It has no inherent meaning, making it useful for demonstrating the visual appearance of a document or design without the distraction of meaningful content. Lorem Ipsum is placeholder text commonly. Lorem Ipsum is placeholder text commonly used in the graphic, print, and publishing industries for previewing layouts and visual presentations. It has no inherent meaning, making it useful for demonstrating the visual appearance of a document or design without the distraction of meaningful content. Lorem Ipsum is placeholder text commonly. Lorem Ipsum is placeholder text commonly used in the graphic, print, and publishing industries for previewing layouts and visual presentations. It has no inherent meaning, making it useful for demonstrating the visual appearance of a document or design without the distraction of meaningful content. Lorem Ipsum is placeholder text commonly. Lorem Ipsum is placeholder text commonly used in the graphic, print, and publishing industries for previewing layouts and visual presentations. It has no inherent meaning, making it useful for demonstrating the visual appearance of a document or design without the distraction of meaningful content. Lorem Ipsum is placeholder text commonly.</p>

                        </div>
                        <!--end col-md-6-->

                        <!--begin col-md-6-->
                        <div class="col-md-6">
                            <img src="{{ asset('storage/back_imgs/what_is.png') }}" id="what_is_img" class="w-100 cursor-pointer" alt="pic" onclick="document.getElementById('what_is_input').click()" />
                            <input id='what_is_input' type="file" class="d-none" onchange="onImgChange(event)" />
                        </div>
                        <!--end col-md-6-->

                    </div>
                    <!--end row -->
                </div>
                <!--end container -->

            </section>
            <!--end section-what -->

            <!--begin section-why -->
            <section class="py-5">

                <!--begin container -->
                <div class="container">
                    <!--begin row -->
                    <div class="row">

                        <!--begin col-md-6-->
                        <div class="col-md-6">
                            <img src="{{ asset('storage/back_imgs/why.png') }}" id="why_img" class="w-100 cursor-pointer" alt="pic" onclick="document.getElementById('why_input').click()" />
                            <input id='why_input' type="file" class="d-none" onchange="onImgChange(event)" />
                        </div>
                        <!--end col-md-6-->

                        <!--begin col-md-6-->
                        <div class="col-md-6">
                            <h1>
                                <span contenteditable="true" id="whyTitleWhite">{{ __('Why') }}</span>
                                <span contenteditable="true" id="whyTitleGreen" class="text-success">{{ __('Lead Revive') }}</span>
                            </h1>

                            <p contenteditable="true" id="whyText1">Lorem Ipsum is placeholder text commonly used in the graphic, print, and publishing industries for previewing layouts and visual presentations. It has no inherent meaning, making it useful for demonstrating the visual appearance of a document or design without the distraction of meaningful content. Lorem Ipsum is placeholder text commonly. Lorem Ipsum is placeholder text commonly used in the graphic, print, and publishing industries for previewing layouts and visual presentations. It has no inherent meaning, making it useful for demonstrating the visual appearance of a document or design without the distraction of meaningful content. Lorem Ipsum is placeholder text commonly. Lorem Ipsum is placeholder text commonly used in the graphic, print, and publishing industries for previewing layouts and visual presentations. It has no inherent meaning, making it useful for demonstrating the visual appearance of a document or design without the distraction of meaningful content. Lorem Ipsum is placeholder text commonly. Lorem Ipsum is placeholder text commonly used in the graphic, print, and publishing industries for previewing layouts and visual presentations. It has no inherent meaning, making it useful for demonstrating the visual appearance of a document or design without the distraction of meaningful content. Lorem Ipsum is placeholder text commonly. Lorem Ipsum is placeholder text commonly used in the graphic, print, and publishing industries for previewing layouts and visual presentations. It has no inherent meaning, making it useful for demonstrating the visual appearance of a document or design without the distraction of meaningful content. Lorem Ipsum is placeholder text commonly.</p>

                        </div>
                        <!--end col-md-6-->

                    </div>
                    <!--end row -->
                </div>
                <!--end container -->

            </section>
            <!--end section-why -->

            <!--begin section-contact -->
            <section id="contactUs" class="py-5">

                <!--begin container -->
                <div class="container">
                    <!--begin row -->
                    <div class="row">

                        <!--begin col-md-6-->
                        <div class="col-md-6">
                            <h1>
                                <span contenteditable="true" id="conatactTitleWhite">{{ __('Contact') }}</span>
                                <span contenteditable="true" id="conatactTitleGreen" class="text-success">{{ __('Us') }}</span>
                            </h1>

                            <p contenteditable="true" id="conatactText1">Please contact us via the form or call us on 0403 111 111.</p>

                        </div>
                        <!--end col-md-6-->

                        <!--begin col-md-6-->
                        <div class="col-md-6">
                            <form>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Name*" required />
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Email Address*" required />
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Business Name*" required />
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Phone*" required />
                                </div>
                                <button id="sendMessageBtn" type="submit" class="btn btn-success rounded-pill" data-toggle="modal" data-target="#sendMessageBtnModal">SEND MESSAGE</button>
                                <div class="modal text-dark" id="sendMessageBtnModal">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">

                                            <!-- Modal Header -->
                                            <div class="modal-header">
                                                <h4 class="modal-title text-dark">Button Edit</h4>
                                            </div>

                                            <!-- Modal body -->
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label for="sendMessageBtn-content">Content</label>
                                                    <input id="sendMessageBtn-content" class="form-control" value="SEND MESSAGE" />
                                                </div>
                                                <div class="form-group">
                                                    <label for="sendMessageBtn-type">Type</label>
                                                    <select id="sendMessageBtn-type" class="form-control">
                                                        <option value="primary">primary</option>
                                                        <option value="secondary">secondary</option>
                                                        <option value="success">success</option>
                                                        <option value="info">info</option>
                                                        <option value="warning">warning</option>
                                                        <option value="danger">danger</option>
                                                        <option value="dark">dark</option>
                                                        <option value="light">light</option>
                                                        <option value="link">link</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="sendMessageBtn-outline">Outline</label>
                                                    <select id="sendMessageBtn-outline" class="form-control">
                                                        <option value="false">false</option>
                                                        <option value="true">true</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="sendMessageBtn-size">Size</label>
                                                    <select id="sendMessageBtn-size" class="form-control">
                                                        <option value="md">medium</option>
                                                        <option value="sm">small</option>
                                                        <option value="lg">large</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="sendMessageBtn-border_radius">Border Radius</label>
                                                    <select id="sendMessageBtn-border_radius" class="form-control">
                                                        <option value="default">default</option>
                                                        <option value="none">none</option>
                                                        <option value="pill">pill</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <!-- Modal footer -->
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-primary" onclick="btnSet('sendMessageBtn')" data-dismiss="modal">Set</button>
                                                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <!--end col-md-6-->

                    </div>
                    <!--end row -->
                </div>
                <!--end container -->

            </section>
            <!--end section-contact -->

            <!--begin section-who -->
            <section class="py-5">

                <!--begin container -->
                <div class="container">

                    <!--begin row -->
                    <div class="row">

                        <!--begin col-md-6 -->
                        <div class="col-md-6">

                            <p contenteditable="true" id="whoText1">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Repellendus, facere vero modi suscipit animi ea, amet laudantium cumque cupiditate voluptatum exercitationem sit aliquam. Autem, itaque quisquam. Earum ipsam totam reprehenderit? Lorem ipsum dolor sit amet consectetur adipisicing elit. Vitae adipisci vero repellat esse dolores ratione unde aliquid. Ipsam quasi, autem incidunt quam nobis enim quibusdam labore in tenetur perferendis atque. Lorem ipsum, dolor sit amet consectetur adipisicing elit. Voluptatibus, quo accusamus? Error, magnam eius quo recusandae quaerat optio consequuntur voluptates ea architecto aut, iste, vitae hic adipisci quidem dicta harum?</p>

                        </div>
                        <!--end col-md-6 -->

                        <!--begin col-md-6 -->
                        <div class="col-md-6">

                            <h1>
                                <span contenteditable="true" id="whoTitleWhite">{{ __('Who Is') }}</span>
                                <span contenteditable="true" id="whoTitleGreen" class="text-success">{{ __('Lead Revive?') }}</span>
                            </h1>

                        </div>
                        <!--end col-md-6 -->
                    </div>
                </div>
                <!--end container -->
            </section>
            <!--end section-who -->

            <!--begin section-reviews -->
            <section id="reviews" class="py-5">

                <!--begin container -->
                <div class="container">

                    <h1 contenteditable="true" id="reivewsTitleGreen" class="text-success mb-4">Reviews</h1>

                    <p class="mb-4">“Lorem Ipsum is placeholder text commonly used in the graphic, print, and publishing industries for previewing layouts and visual presentations. It has no inherent meaning, making it useful for demonstrating the visual appearance of a document or design without the distraction of meaningful content. Lorem Ipsum is placeholder text commonly.”</p>

                    <p class="text-success">Brad Johnson</p>
                    <p>Western Bulldogs</p>

                </div>
                <!--end container -->

            </section>
            <!--end section-reviews -->

            <!--begin section-helped -->
            <section class="py-5">

                <!--begin container -->
                <div class="container">

                    <h1 class="text-right mb-4">
                        <span contenteditable="true" id="helpedTitleWhite">Who We</span>
                        <span contenteditable="true" id="helpedTitleGreen" class="text-success">Have Helped</span>
                    </h1>

                    <div class="help-box d-flex justify-content-around p-3">

                        <img src="{{ asset('saas/img/bulls.png') }}" style="height: 130px;" alt="img" />

                        <img src="{{ asset('saas/img/dogs.png') }}" style="height: 130px;" alt="img" />

                        <img src="{{ asset('saas/img/phillies.png') }}" style="height: 130px;" alt="img" />

                        <img src="{{ asset('saas/img/carlton.png') }}" style="height: 130px;" alt="img" />

                    </div>

                </div>
                <!--end container -->

            </section>
            <!--end section-helped -->

            <!--begin section-pricing -->
            <section id="pricing" class="py-5">

                <!--begin container -->
                <div class="container">

                    <h1 contenteditable="true" id="pricingTitleGreen" class="text-success mb-4">Pricing</h1>

                    <div class="d-flex justify-content-around mb-5">
                        <div class="pricing-card">
                            <h2 class="mb-4">Basic</h2>
                            <p class="mb-2">item 1</p>
                            <p class="mb-2">item 2</p>
                            <p class="mb-2">item 3</p>
                            <p>$1000</p>
                        </div>
                        <div class="pricing-card">
                            <h2 class="mb-4">Pro</h2>
                            <p class="mb-2">item 1</p>
                            <p class="mb-2">item 2</p>
                            <p class="mb-2">item 3</p>
                            <p>$5000</p>
                        </div>
                    </div>

                </div>
                <!--end container -->

            </section>
            <!--end section-pricing -->

            <!--begin section-book -->
            <section class="py-5">

                <!--begin container -->
                <div class="container">

                    <div class="row">

                        <div class="col-md-8">
                            <h1 contenteditable="true" id="bookTitleWhite" class="mb-3">Not Converted Yet?</h1>
                            <h1 contenteditable="true" id="bookTitleGreen" class="text-success">Book A Demo</h1>
                        </div>

                        <div class="col-md-4 align-items-center">
                            <button id="bookBtn" class="btn btn-success rounded-pill" data-toggle="modal" data-target="#bookBtnModal">BOOK NOW</button>
                            <div class="modal text-dark" id="bookBtnModal">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">

                                        <!-- Modal Header -->
                                        <div class="modal-header">
                                            <h4 class="modal-title text-dark">Button Edit</h4>
                                        </div>

                                        <!-- Modal body -->
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label for="bookBtn-content">Content</label>
                                                <input id="bookBtn-content" class="form-control" value="BOOK NOW" />
                                            </div>
                                            <div class="form-group">
                                                <label for="bookBtn-type">Type</label>
                                                <select id="bookBtn-type" class="form-control">
                                                    <option value="primary">primary</option>
                                                    <option value="secondary">secondary</option>
                                                    <option value="success">success</option>
                                                    <option value="info">info</option>
                                                    <option value="warning">warning</option>
                                                    <option value="danger">danger</option>
                                                    <option value="dark">dark</option>
                                                    <option value="light">light</option>
                                                    <option value="link">link</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="bookBtn-outline">Outline</label>
                                                <select id="bookBtn-outline" class="form-control">
                                                    <option value="false">false</option>
                                                    <option value="true">true</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="bookBtn-size">Size</label>
                                                <select id="bookBtn-size" class="form-control">
                                                    <option value="md">medium</option>
                                                    <option value="sm">small</option>
                                                    <option value="lg">large</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="bookBtn-border_radius">Border Radius</label>
                                                <select id="bookBtn-border_radius" class="form-control">
                                                    <option value="default">default</option>
                                                    <option value="none">none</option>
                                                    <option value="pill">pill</option>
                                                </select>
                                            </div>
                                        </div>

                                        <!-- Modal footer -->
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-primary" onclick="btnSet('bookBtn')" data-dismiss="modal">Set</button>
                                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <!--end container -->

            </section>
            <!--end section-book -->
        </div>

        <!--begin footer -->
        <div id="footer" class="py-5">

            <!--begin container -->
            <div class="container">
                <div class="row">
                    <div class="col-md-3">
                        <img src="{{ asset('saas/img/logo.png') }}" style="max-width: 14rem; width: 100%;" />
                        <p contenteditable="true" id="footerBlock1Text1">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Assumenda beatae ducimus suscipit, ab quidem voluptate nulla, in veniam deleniti nesciunt mollitia. Odio officiis consectetur voluptatibus quia rem alias numquam dolorum.</p>
                    </div>
                    <div class="col-md-3 pt-4">
                        <h5 contenteditable="true" id="footerBlock2Title">Use Cases</h5>
                        <ul>
                            <li contenteditable="true" id="footerBlock2Text1" class="mb-3">Web-designers</li>
                            <li contenteditable="true" id="footerBlock2Text2" class="mb-3">Marketers</li>
                            <li contenteditable="true" id="footerBlock2Text3" class="mb-3">Small Business</li>
                            <li contenteditable="true" id="footerBlock2Text4">Website Builder</li>
                        </ul>
                    </div>
                    <div class="col-md-3 pt-4">
                        <h5 id="footerBlock3Title" contenteditable="true">Company</h5>
                        <ul>
                            <li contenteditable="true" id="footerBlock3Text1" class="mb-3">About Us</li>
                            <li contenteditable="true" id="footerBlock3Text2" class="mb-3">Careers</li>
                            <li contenteditable="true" id="footerBlock3Text3" class="mb-3">FAQs</li>
                            <li contenteditable="true" id="footerBlock3Text4" class="mb-3">Teams</li>
                            <li contenteditable="true" id="footerBlock3Text5">Contact Us</li>
                        </ul>
                    </div>
                    <div class="col-md-3 pt-4">
                        <h5 contenteditable="true" id="footerBlock4Title">Follow Us</h5>
                        <div class="d-flex text-white" style="gap: 1rem;">
                            <i id="footer-icon-1" class="fa-brands fa-facebook fa-2x" onclick="onIconClick('footer-icon-1')"></i>
                            <i id="footer-icon-2" class="fa-brands fa-gitlab fa-2x" onclick="onIconClick('footer-icon-2')"></i>
                            <i id="footer-icon-3" class="fa-brands fa-github fa-2x" onclick="onIconClick('footer-icon-3')"></i>
                            <i id="footer-icon-4" class="fa-brands fa-telegram fa-2x" onclick="onIconClick('footer-icon-4')"></i>
                            <i id="footer-icon-5" class="fa-brands fa-instagram fa-2x" onclick="onIconClick('footer-icon-5')"></i>
                            <i id="footer-icon-6" class="fa-brands fa-figma fa-2x" onclick="onIconClick('footer-icon-6')"></i>
                        </div>
                    </div>
                </div>
            </div>
            <!--end container -->

        </div>
        <!--end footer -->

        <button type="button" id="modalTrigger" class="btn btn-primary d-none" data-toggle="modal" data-target="#myModal">
            Open modal
        </button>
        <div class="modal text-dark" id="myModal">
            <div class="modal-dialog modal-lg modal-dialog-scrollable">
                <div class="modal-content">

                    <!-- Modal Header -->
                    <div class="modal-header d-block">
                        <div class="w-100 d-flex justify-content-between align-items-center">
                            <div class="icon-preview-wrapper">
                                <i id="icon-preview"></i>
                            </div>
                            <div>
                                <div class="d-flex mb-1">
                                    <label for="icon-size" style="width: 80px;">Icon Size:</label>
                                    <input type="number" id="icon-size" class="form-control" style="width: 120px;" min="0" max="999" onchange="onSizeChange(event)" />
                                </div>
                                <div class="d-flex">
                                    <label for="icon-color" style="width: 80px;">Icon Color:</label>
                                    <input type="color" id="icon-color" class="form-control" style="width: 120px;" onchange="onColorChange(event)" />
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body">
                        @livewire('icon-set')
                    </div>

                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-info" onclick="iconSet()" data-dismiss="modal">Set</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div>

                </div>
            </div>
        </div>
    </div>
    @livewireScripts
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('saas/home/js/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('saas/home/js/jquery.nav.js') }}"></script>
    <script src="{{ asset('saas/home/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/const.js') }}"></script>
    <script type="text/javascript">
        let receivedData = <?php echo json_encode($settings); ?>;
    </script>
    <script src="{{ asset('assets/js/load-settings.js') }}"></script>
    <script src="{{ asset('assets/js/set-settings.js') }}"></script>
    <script src="{{ asset('saas/home/js/custom.js') }}"></script>
    <script src="{{ asset('plugins/toastr/toastr.min.js') }}"></script>
</body>

</html>