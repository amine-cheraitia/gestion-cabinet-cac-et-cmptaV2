<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="amine cheraitia" />
    <title>@yield('title','Gestion du Cabinet Meddahi')</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
    <link href="{{asset('/css/styles.css')}}" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
    <script src="{{asset('/js/datatables-simple-demo.js')}}"></script>
    {{-- //laravel mix --}}
    <script src="{{asset('/js/app.js')}}"></script>
    <link href="{{asset('/css/app.css')}}" rel="stylesheet" />
    {{--
    <link rel="stylesheet" href="css/app.css" /> --}}
    {{--
    <link href="https://fonts.googleapis.com/css2?family=Nunito" rel="stylesheet"> --}}
    <style>
        /*         * {
            font-family: 'Nunito', sans-serif;
        } */
    </style>
    @yield('style')
</head>


<body class="sb-nav-fixed">
    @include('sweetalert::alert')
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <!-- Navbar Brand-->
        <a class="navbar-brand ps-3" href="/"><img src="{{asset('assets/img/LogoMain.png')}}" alt=""></a>
        <!-- Sidebar Toggle-->
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!">
            <i class="fas fa-bars"></i>
        </button>
        <!-- Navbar Search-->
        <form class="
					d-none d-md-inline-block
					form-inline
					ms-auto
					me-0 me-md-3
					my-2 my-md-0
				">
            {{-- <div class="input-group">
                <input class="form-control" type="text" placeholder="Search for..." aria-label="Search for..."
                    aria-describedby="btnNavbarSearch" />
                <button class="btn btn-primary" id="btnNavbarSearch" type="button">
                    <i class="fas fa-search"></i>
                </button>
            </div> --}}
        </form>
        <!-- Navbar-->
        <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown"
                    aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    {{-- <li><a class="dropdown-item" href="#!">Settings</a></li>
                    <li><a class="dropdown-item" href="#!">Activity Log</a></li> --}}
                    <li>
                        <hr class="dropdown-divider" />
                    </li>
                    <li><a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">Se Déconnecter
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>


                        </a></li>
                </ul>
            </li>
        </ul>
    </nav>
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">
                        <div class="sb-sidenav-menu-heading">Core</div>
                        <a class="nav-link" href="{{route('/')}}">
                            <div class="sb-nav-link-icon">
                                <i class="fas fa-tachometer-alt"></i>
                            </div>
                            Tableau de bord
                        </a>
                        <div class="sb-sidenav-menu-heading">Interface</div>
                        @can('admin')


                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#gEntreprises"
                            aria-expanded="false" aria-controls="gEntreprises">
                            <div class="sb-nav-link-icon">
                                <i class="far fa-address-card"></i>
                            </div>
                            Gestion des Entreprises
                            <div class="sb-sidenav-collapse-arrow">
                                <i class="fas fa-angle-down"></i>
                            </div>
                        </a>
                        <div class="collapse" id="gEntreprises" aria-labelledby="headingOne"
                            data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="{{route('client.list')}}">Consulter</a>
                            </nav>
                        </div>
                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#gUser"
                            aria-expanded="false" aria-controls="gUser">
                            <div class="sb-nav-link-icon">
                                <i class="fas fa-users"></i>
                            </div>
                            Gestion des Utilisateurs
                            <div class="sb-sidenav-collapse-arrow">
                                <i class="fas fa-angle-down"></i>
                            </div>
                        </a>
                        <div class="collapse" id="gUser" aria-labelledby="headingOne"
                            data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="{{route('users.list')}}">Consulter</a>

                            </nav>
                        </div>
                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#gDevis"
                            aria-expanded="false" aria-controls="gDevis">
                            <div class="sb-nav-link-icon">
                                <i class="fas fa-file-alt"></i>
                            </div>
                            Gestion des Devis
                            <div class="sb-sidenav-collapse-arrow">
                                <i class="fas fa-angle-down"></i>
                            </div>
                        </a>
                        <div class="collapse" id="gDevis" aria-labelledby="headingOne"
                            data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="{{route('devis.list')}}">Consulter</a>

                            </nav>
                        </div>
                        {{-- mission --}}
                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#gMission"
                            aria-expanded="false" aria-controls="gMission">
                            <div class="sb-nav-link-icon">
                                <i class="fas fa-project-diagram"></i>
                            </div>
                            Gestion des Missions
                            <div class="sb-sidenav-collapse-arrow">
                                <i class="fas fa-angle-down"></i>
                            </div>
                        </a>
                        <div class="collapse" id="gMission" aria-labelledby="headingOne"
                            data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="{{route('mission.list')}}">Consulter</a>
                                <a class="nav-link" href="{{route('mission.planningLayout')}}">Consulter Planning</a>

                            </nav>
                        </div>
                        @endcan
                        {{-- tache --}}
                        @can('cmp-adt-cac')


                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#gTache"
                            aria-expanded="false" aria-controls="gTache">
                            <div class="sb-nav-link-icon">
                                <i class="fas fa-tasks"></i>
                            </div>
                            Gestion des Tâches
                            <div class="sb-sidenav-collapse-arrow">
                                <i class="fas fa-angle-down"></i>
                            </div>
                        </a>
                        <div class="collapse" id="gTache" aria-labelledby="headingOne"
                            data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="{{route('tache.list')}}">Consulter</a>
                                <a class="nav-link" href="{{route('tache.planningLayout')}}">Consulter Planning</a>
                            </nav>
                        </div>
                        @endcan
                        @can('admin')

                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#gfacture"
                            aria-expanded="false" aria-controls="gfacture">
                            <div class="sb-nav-link-icon">
                                <i class="fas fa-file-invoice"></i>
                            </div>
                            Gestion des Factures
                            <div class="sb-sidenav-collapse-arrow">
                                <i class="fas fa-angle-down"></i>
                            </div>
                        </a>
                        <div class="collapse" id="gfacture" aria-labelledby="headingOne"
                            data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="{{route('facture.list')}}">Consulter</a>

                            </nav>
                        </div>
                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#gPaiement"
                            aria-expanded="false" aria-controls="gPaiement">
                            <div class="sb-nav-link-icon">
                                <i class="fas fa-file-invoice-dollar"></i>
                            </div>
                            Gestion des Paiements
                            <div class="sb-sidenav-collapse-arrow">
                                <i class="fas fa-angle-down"></i>
                            </div>
                        </a>
                        <div class="collapse" id="gPaiement" aria-labelledby="headingOne"
                            data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="{{route('paiement.list')}}">Consulter</a>
                                <a class="nav-link" href="{{route('paiement.creances')}}">Consulter les créances</a>
                                {{-- <a class="nav-link" href="{{route('paiement.PlanningPaiement')}}">Consulter le Planning
                                    de paiement</a> --}}
                            </nav>
                        </div>
                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#gKpi"
                            aria-expanded="false" aria-controls="gKpi">
                            <div class="sb-nav-link-icon">
                                <i class="fas fa-chart-pie"></i>
                            </div>
                            Performance globale du cabinet
                            <div class="sb-sidenav-collapse-arrow">
                                <i class="fas fa-angle-down"></i>
                            </div>
                        </a>
                        <div class="collapse" id="gKpi" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="{{route('kpi.basic')}}">Consulter</a>

                            </nav>
                        </div>
                        {{-- --}}
                        @endcan
                        @can('secretaire')
                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#gPaiement"
                            aria-expanded="false" aria-controls="gPaiement">
                            <div class="sb-nav-link-icon">
                                <i class="fas fa-file-invoice-dollar"></i>
                            </div>
                            Gestion des Créances
                            <div class="sb-sidenav-collapse-arrow">
                                <i class="fas fa-angle-down"></i>
                            </div>
                        </a>
                        <div class="collapse" id="gPaiement" aria-labelledby="headingOne"
                            data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="{{route('paiement.creances')}}">Consulter</a>

                            </nav>
                        </div>
                        @endcan
                        {{-- <a class="nav-link collapsed" href="#" data-bs-toggle="collapse"
                            data-bs-target="#collapsePages" aria-expanded="false" aria-controls="collapsePages">
                            <div class="sb-nav-link-icon">
                                <i class="fas fa-book-open"></i>
                            </div>
                            Pages
                            <div class="sb-sidenav-collapse-arrow">
                                <i class="fas fa-angle-down"></i>
                            </div>
                        </a>
                        <div class="collapse" id="collapsePages" aria-labelledby="headingTwo"
                            data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse"
                                    data-bs-target="#pagesCollapseAuth" aria-expanded="false"
                                    aria-controls="pagesCollapseAuth">
                                    Authentication
                                    <div class="sb-sidenav-collapse-arrow">
                                        <i class="fas fa-angle-down"></i>
                                    </div>
                                </a>
                                <div class="collapse" id="pagesCollapseAuth" aria-labelledby="headingOne"
                                    data-bs-parent="#sidenavAccordionPages">
                                    <nav class="sb-sidenav-menu-nested nav">
                                        <a class="nav-link" href="login.html">Login</a>
                                        <a class="nav-link" href="register.html">Register</a>
                                        <a class="nav-link" href="password.html">Forgot Password</a>
                                    </nav>
                                </div>
                                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse"
                                    data-bs-target="#pagesCollapseError" aria-expanded="false"
                                    aria-controls="pagesCollapseError">
                                    Error
                                    <div class="sb-sidenav-collapse-arrow">
                                        <i class="fas fa-angle-down"></i>
                                    </div>
                                </a>
                                <div class="collapse" id="pagesCollapseError" aria-labelledby="headingOne"
                                    data-bs-parent="#sidenavAccordionPages">
                                    <nav class="sb-sidenav-menu-nested nav">
                                        <a class="nav-link" href="401.html">401 Page</a>
                                        <a class="nav-link" href="404.html">404 Page</a>
                                        <a class="nav-link" href="500.html">500 Page</a>
                                    </nav>
                                </div>
                            </nav>
                        </div> --}}
                        {{-- <div class="sb-sidenav-menu-heading">Addons</div>
                        <a class="nav-link" href="charts.html">
                            <div class="sb-nav-link-icon">
                                <i class="fas fa-chart-area"></i>
                            </div>
                            Charts
                        </a>
                        <a class="nav-link" href="tables.html">
                            <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                            Tables
                        </a> --}}
                    </div>
                </div>
                <div class="sb-sidenav-footer">
                    <div class="small">Connecté en tant que:</div>
                    {{Auth::user()->fullname}}
                </div>
            </nav>
        </div>
        <div id="layoutSidenav_content">
            <div class="container-fluid px-4">
                <div class="row">
                    <div {{-- class="col-lg-8 col-md-10 mx-auto" --}}>
                        {{-- {{ Auth()->user()->isAdmin() ? "admin" : "non admin"}} --}}
                        @yield('content')
                        {{-- <p class="mt-4">random text</p> --}}



                    </div>
                </div>
            </div>




            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid px-4">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted">Copyright &copy; Cabinet Meddahi 2022</div>
                        <div>
                            <a href="#">Privacy Policy</a>
                            &middot;
                            <a href="#">Terms &amp; Conditions </a>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
    </script>

    <script src="{{asset('/js/scripts.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    {{-- <script src="{{asset('/assets/demo/chart-area-demo.js')}}"></script>
    <script src="{{asset('/assets/demo/chart-bar-demo.js')}}"></script> --}}
    {{-- --}}
    {{-- <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
    <script src="{{asset('/js/datatables-simple-demo.js')}}"></script> --}}
</body>

</html>
