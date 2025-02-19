<!DOCTYPE html>
<html lang="en">

<head>
    {{-- <meta http-equiv="X-UA-Compatible" content="IE=edge" /> --}}
    <title>Gestion des fournisseurs</title>
    <meta content="width=device-width, initial-scale=1.0, shrink-to-fit=no" name="viewport" />
    <link rel="icon" href="{{ asset('assets/img/kaiadmin/favicon.ico') }}" type="image/x-icon" />
    <link rel="stylesheet" href="{{ asset('CSS/sideBar.css') }}" />

    <!-- Fonts and icons -->
    <script src="{{ asset('assets/js/plugin/webfont/webfont.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        WebFont.load({
            google: {
                families: ["Public Sans:300,400,500,600,700"]
            },
            custom: {
                families: [
                    "Font Awesome 5 Solid",
                    "Font Awesome 5 Regular",
                    "Font Awesome 5 Brands",
                    "simple-line-icons",
                ],
                urls: ["{{ asset('assets/css/fonts.min.css') }}"],
            },
            active: function() {
                sessionStorage.fonts = true;
            },
        });
    </script>

    <!-- CSS Files -->
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/plugins.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/kaiadmin.min.css') }}" />

    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link rel="stylesheet" href="{{ asset('assets/css/demo.css') }}" />
</head>

<body>
    <div class="wrapper">
        @include('sweetalert::alert', ['cdn' => 'https://cdn.jsdelivr.net/npm/sweetalert2@9'])
        <!-- Sidebar -->
        <div class="sidebar" data-background-color="dark">
            <div class="sidebar-logo">
                <!-- Logo Header -->
                <div class="logo-header" data-background-color="dark">
                    <a href="#" class="logo">
                        <h3 id="logo">MyWebSite</h3>
                    </a>

                    <div class="nav-toggle">
                        <button class="btn btn-toggle toggle-sidebar">
                            <i class="gg-menu-right"></i>
                        </button>
                        <button class="btn btn-toggle sidenav-toggler">
                            <i class="gg-menu-left"></i>
                        </button>
                    </div>
                    <button class="topbar-toggler more">
                        <i class="gg-more-vertical-alt"></i>
                    </button>
                </div>
                <!-- End Logo Header -->
            </div>
            <div class="sidebar-wrapper scrollbar scrollbar-inner">
                <div class="sidebar-content">
                    <ul class="nav nav-secondary">
                        <li class="nav-item">
                            <a href="{{ route('dashboardSection') }}" class="collapsed" aria-expanded="false">
                                <i class="fas fa-home"></i>
                                <p>Tableau de bord</p>

                            </a>
                        </li>

                        @if (auth()->user()->role == 'super-admin')
                            <li class="nav-section">
                                <span class="sidebar-mini-icon">
                                    <i class="fa fa-ellipsis-h"></i>
                                </span>
                                <h4 class="text-section">Composants</h4>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('usersSection') }}">
                                    <i class="fas fa-users"></i>
                                    <p>Les utilisateurs</p>

                                </a>

                            </li>
                            <li class="nav-item">
                                <a href="{{ route('prospectsSection') }}">
                                    <i class="fas fa-user"></i>

                                    <p>Les tiers</p>

                                </a>

                            </li>
                            <li class="nav-item">
                                <a href="{{ route('clientsSection') }}">
                                    <i class="fas fa-user-check"></i>

                                    <p>Les clients</p>

                                </a>

                            </li>
                            <li class="nav-item">
                                <a href="{{ route('suppliersSection') }}">
                                    <i class="fas fa-people-carry"></i>
                                    <p>Les fournisseurs</p>

                                </a>

                            </li>
                            <li class="nav-item">
                                <a href="{{ route('suppliersAndClientsSection') }}">
                                    <i class="fas fa-users-cog"></i>

                                    <p>Fournisseurs et Clients</p>

                                </a>

                            </li>
                            <li class="nav-item">
                                <a href="{{ route('categoriesSection') }}">
                                    <i class="fas fa-list"></i>

                                    <p>Les catégories</p>


                                </a>

                            </li>
                            <li class="nav-item">
                                <a href="{{ route('productsSection') }}">
                                    <i class="fas fa-boxes"></i>
                                    <p>Les sous-catégories</p>


                                </a>

                            </li>
                            <li class="nav-item">
                                <a href="{{ route('historiqueSection') }}">
                                    <i class="fas fa-history"></i>
                                    <p>Historique</p>


                                </a>

                            </li>
                        @elseif (auth()->user()->role == 'admin')
                            <li class="nav-section">
                                <span class="sidebar-mini-icon">
                                    <i class="fa fa-ellipsis-h"></i>
                                </span>
                                <h4 class="text-section">Components</h4>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('prospectsSection') }}">
                                    <i class="fas fa-user"></i>

                                    <p>Les tiers</p>

                                </a>

                            </li>
                            <li class="nav-item">
                                <a href="{{ route('clientsSection') }}">
                                    <i class="fas fa-user-check"></i>

                                    <p>Les clients</p>

                                </a>

                            </li>
                            <li class="nav-item">
                                <a href="{{ route('suppliersSection') }}">
                                    <i class="fas fa-people-carry"></i>
                                    <p>Les fournisseurs</p>

                                </a>

                            </li>
                            <li class="nav-item">
                                <a href="{{ route('suppliersAndClientsSection') }}">
                                    <i class="fas fa-users-cog"></i>

                                    <p>Fournisseurs et Clients</p>

                                </a>


                            </li>
                            <li class="nav-item">
                                <a href="{{ route('categoriesSection') }}">
                                    <i class="fas fa-list"></i>

                                    <p>Les catégories</p>


                                </a>

                            </li>
                            <li class="nav-item">
                                <a href="{{ route('productsSection') }}">
                                    <i class="fas fa-boxes"></i>
                                    <p>Les sous-catégories</p>


                                </a>

                            </li>
                        @elseif (auth()->user()->role == 'utilisateur')
                            <li class="nav-item">
                                <a href="{{ route('prospectsSection') }}">
                                    <i class="fas fa-user"></i>

                                    <p>Les tiers</p>

                                </a>

                            </li>
                            <li class="nav-item">
                                <a href="{{ route('clientsSection') }}">
                                    <i class="fas fa-user-check"></i>

                                    <p>Les clients</p>

                                </a>

                            </li>
                            <li class="nav-item">
                                <a href="{{ route('suppliersSection') }}">
                                    <i class="fas fa-people-carry"></i>
                                    <p>Les fournisseurs</p>

                                </a>

                            </li>
                            <li class="nav-item">
                                <a href="{{ route('suppliersAndClientsSection') }}">
                                    <i class="fas fa-users-cog"></i>

                                    <p>Fournisseurs et Clients</p>

                                </a>


                            </li>
                            <li class="nav-item">
                                <a href="{{ route('categoriesSection') }}">
                                    <i class="fas fa-list"></i>

                                    <p>Les catégories</p>


                                </a>

                            </li>
                            <li class="nav-item">
                                <a href="{{ route('productsSection') }}">
                                    <i class="fas fa-boxes"></i>
                                    <p>Les sous-catégories</p>


                                </a>

                            </li>
                        @endif


                        <li class="nav-item">
                            <a href="#"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="fas fa-sign-out-alt"></i>
                                <p>Se déconnecter</p>
                            </a>
                        </li>

                        <!-- Formulaire caché pour la déconnexion -->
                        <form id="logout-form" action="{{ route('logout') }}" method="POST"
                            style="display: none;">
                            @csrf
                        </form>

                    </ul>
                </div>
            </div>
        </div>
        <!-- End Sidebar -->
        <div class="main-panel">
            <div class="main-header">
                <div class="main-header-logo">
                    <!-- Logo Header -->
                    <div class="logo-header" data-background-color="dark">
                        <div class="nav-toggle">
                            <button class="btn btn-toggle toggle-sidebar">
                                <i class="gg-menu-right"></i>
                            </button>
                            <button class="btn btn-toggle sidenav-toggler">
                                <i class="gg-menu-left"></i>
                            </button>
                        </div>
                        <button class="topbar-toggler more">
                            <i class="gg-more-vertical-alt"></i>
                        </button>
                    </div>
                    <!-- End Logo Header -->
                </div>
                <!-- Navbar Header -->
                <nav class="navbar navbar-header navbar-header-transparent navbar-expand-lg border-bottom">
                    <div class="container-fluid">
                        <nav
                            class="navbar navbar-header-left navbar-expand-lg navbar-form nav-search p-0 d-none d-lg-flex">


                            {{--
           --}}
                            @yield('search-bar')

                        </nav>

                        <ul class="navbar-nav topbar-nav ms-md-auto align-items-center">
                            <li class="nav-item topbar-icon dropdown hidden-caret d-flex d-lg-none">
                                <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#"
                                    role="button" aria-expanded="false" aria-haspopup="true">
                                    <i class="fa fa-search"></i>
                                </a>
                                <ul class="dropdown-menu dropdown-search animated fadeIn">
                                    <form class="navbar-left navbar-form nav-search">
                                        <div class="input-group">
                                            <input type="text" placeholder="Search ..." class="form-control" />
                                        </div>
                                    </form>
                                </ul>

                            </li>




                            <li class="nav-item topbar-user dropdown hidden-caret">
                                <a href="{{ route('update.user.auth.form') }}" class="profile-pic"
                                    aria-expanded="false">
                                    <div class="avatar-sm">
                                        <i class="fas fa-user" id="icon-user"></i>

                                    </div>
                                    <span class="profile-username">
                                        <span class="op-7">Hi,</span>
                                        <span class="fw-bold">{{ Auth::user()->name }}</span>
                                    </span>
                                </a>

                            </li>

                        </ul>
                    </div>
                </nav>

                <!-- End Navbar -->
            </div>
            <!-- Custom template | don't include it in your project! -->

            <!--   Core JS Files   -->
            <script src="{{ asset('assets/js/core/jquery-3.7.1.min.js') }}"></script>
            <script src="{{ asset('assets/js/core/popper.min.js') }}"></script>
            <script src="{{ asset('assets/js/core/bootstrap.min.js') }}"></script>

            <!-- jQuery Scrollbar -->
            <script src="{{ asset('assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js') }}"></script>
            <!-- Kaiadmin JS -->
            <script src="{{ asset('assets/js/kaiadmin.min.js') }}"></script>
            <!-- Kaiadmin DEMO methods, don't include it in your project! -->
            <script src="{{ asset('assets/js/setting-demo2.js') }}"></script>
            <script>
                $("#displayNotif").on("click", function() {
                    var placementFrom = $("#notify_placement_from option:selected").val();
                    var placementAlign = $("#notify_placement_align option:selected").val();
                    var state = $("#notify_state option:selected").val();
                    var style = $("#notify_style option:selected").val();
                    var content = {};

                    content.message =
                        'Turning standard Bootstrap alerts into "notify" like notifications';
                    content.title = "Bootstrap notify";
                    if (style == "withicon") {
                        content.icon = "fa fa-bell";
                    } else {
                        content.icon = "none";
                    }
                    content.url = "index.html";
                    content.target = "_blank";

                    $.notify(content, {
                        type: state,
                        placement: {
                            from: placementFrom,
                            align: placementAlign,
                        },
                        time: 1000,
                    });
                });
            </script>
</body>

</html>
