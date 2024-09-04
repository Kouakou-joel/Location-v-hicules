<header class="header">
    <div class="container-fluid">
        <nav class="navbar navbar-expand-lg header-nav">
            <div class="navbar-header">
                <a id="mobile_btn" href="javascript:void(0);">
                    <span class="bar-icon">
                        <span></span>
                        <span></span>
                        <span></span>
                    </span>
                </a>
                <a href="{{ route('home') }}" class="navbar-brand logo">
                    <img src="assets/img/logo.svg" class="img-fluid" alt="Logo">
                </a>
                <a href="{{ route('home') }}" class="navbar-brand logo-small">
                    <img src="assets/img/logo-small.png" class="img-fluid" alt="Logo">
                </a>
            </div>
            <div class="main-menu-wrapper">
                <div class="menu-header">
                    <a href="{{ route('home') }}" class="menu-logo">
                        <img src="assets/img/logo.svg" class="img-fluid" alt="Logo">
                    </a>
                    <a id="menu_close" class="menu-close" href="javascript:void(0);">
                        <i class="fas fa-times"></i>
                    </a>
                </div>
                <ul class="main-nav">
                    <li class="active">
                        <a href="{{ route('home') }}">Accueil</a>
                    </li>
                    <li>
                        <a href="{{ route('categories') }}">Catégories</a>
                    </li>
                    <li>
                        <a href="{{ route('listing') }}">Nos véhicules</a>
                    </li>
                    <li>
                        <a href="{{ route('offers') }}">Offres Spéciales</a>
                    </li>
                    {{-- <li>
                        <a href="{{ route('home') }}">Nos Agences</a>
                    </li> --}}
                    <li>
                        <a href="{{ route('about') }}">À Propos</a>
                    </li>
                    <li>
                        <a href="{{ route('faq') }}">FAQ</a>
                    </li>
                    <li>
                        <a href="{{ route('contact') }}">Contact</a>
                    </li>
                    <li class="login-link">
                        <a href="{{ route('login') }}">Connexion</a>
                    </li>
                    <li class="login-link">
                        <a href="{{ route('register') }}">S'inscrire</a>
                    </li>
                    <!-- User Profile Section -->
                    @if(Auth::check())
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="fas fa-user"></i> Mon Compte
                        </a>
                        <ul class="dropdown-menu">
                            <li><a href="{{ route('profile') }}">Profil</a></li>
                            <li><a href="{{ route('my_reservations') }}">Mes Réservations</a></li>
                            <li><a href="{{ route('account_settings') }}">Paramètres du Compte</a></li>
                            <li><a href="{{ route('logout') }}">Déconnexion</a></li>
                        </ul>
                    </li>
                    @endif
                </ul>
            </div>

            <ul class="nav header-navbar-rht">
                <li class="nav-item">
                    <a class="nav-link header-login" href="{{ route('login') }}">
                        <span><i class="fa-regular fa-user"></i></span> Connexion
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link header-reg" href="{{ route('register') }}">
                        <span><i class="fa-solid fa-lock"></i></span> S'inscrire
                    </a>
                </li>
            </ul>

        </nav>
    </div>
</header>
