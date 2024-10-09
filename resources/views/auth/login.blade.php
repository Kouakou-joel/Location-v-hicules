<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=0"
    />
    <title>Connexion | page</title>

    <link rel="shortcut icon" href="assets/img/favicon.png" />

    <!-- Liens vers les fichiers CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome/css/fontawesome.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome/css/all.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/feather.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}" />
  </head>

  <body>
    <div class="main-wrapper login-body">
      <header class="log-header">
        <a href="{{ route('home') }}">
          <img class="img-fluid logo-dark" src="{{ asset('assets/img/logo.svg') }}" alt="Logo" />
        </a>
      </header>
        <div
            class="form-info-area"
            data-aos="fade-down"
            data-aos-duration="1200"
            data-aos-delay="0.5"
              >
          <div class="row">
                <div class="col-md-6 mt-5">
                    <div class="d-none d-xl-flex align-items-center justify-content-center h-n80">
                        <img src="{{ asset('assets/img/login-pana (2).svg') }}" width="500" class="img-fluid"
                        alt="connexion"
                        />
                   </div>
                </div>
            <div class="col-md-6">
             <div class="login-wrapper">
              <div class="loginbox">
                <div class="login-auth">
                 <div class="login-auth-wrap">
                    <div class="sign-group">
                        <a href="{{ route('home') }}" class="btn sign-up">
                        <span><i class="fe feather-corner-down-left"></i></span>
                        Retour à l'accueil
                        </a>
                    </div>

                    <!-- Affichage des erreurs -->
                    @if(session('error'))
                        <div class="alert alert-danger" role="alert">{{ session('error') }}</div>
                    @endif

                    <h1>Connexion</h1>
                    <p class="account-subtitle">
                        Nous vous enverrons un code de confirmation par e-mail.
                    </p>

                    <!-- Formulaire de connexion -->
                    <form action="{{ route('post-login') }}" method="POST" id="form-register">
                        @csrf

                        <div class="mb-3">
                        <label class="form-label" for="form-email">
                            E-mail <span class="text-danger">*</span>
                        </label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="form-email" name="email"  value="{{ old('email') }}"  autocomplete="email"  required autofocus aria-describedby="emailHelp" />
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        </div>

                        <div class="mb-3">
                        <label class="form-label" for="form-password">
                            Mot de passe <span class="text-danger">*</span>
                        </label>
                        <div class="pass-group">
                            <input type="password" class="form-control pass-input @error('password') is-invalid @enderror" id="form-password" name="password" autocomplete="current-password" required/>
                            <span class="fas fa-eye-slash toggle-password"></span>
                            @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        </div>

                        <div class="input-block">
                        <a class="forgot-link" href="forgot-password">Mot de passe oublié ?</a>
                        </div>

                        <div class="input-block m-0">
                        <label class="custom_check d-inline-flex">
                            <span>Se souvenir de moi</span>
                            <input type="checkbox" name="remember" />
                            <span class="checkmark"></span>
                        </label>
                        </div>

                        <button type="submit" class="btn btn-primary w-100 btn-size mt-1">
                        Se connecter
                        </button>

                        <div class="login-or">
                        <span class="or-line"></span>
                        <span class="span-or">Ou, connectez-vous avec votre e-mail</span>
                        </div>

                        {{-- <div class="social-login">
                        <a href="{{ route('home-admin') }}" class="d-flex align-items-center justify-content-center input-block btn google-login w-100">
                            <span>
                            <img src="{{ asset('assets/img/icons/google.svg') }}" class="img-fluid" alt="Google" />
                            </span>
                            Connectez-vous avec Google
                        </a>
                        </div>

                        <div class="social-login">
                        <a href="{{ route('home-admin') }}" class="d-flex align-items-center justify-content-center input-block btn facebook-login w-100">
                            <span>
                            <img src="{{ asset('assets/img/icons/facebook.svg') }}" class="img-fluid" alt="Facebook" />
                            </span>
                            Connectez-vous avec Facebook
                        </a>
                        </div> --}}

                        <div class="text-center dont-have">
                        Vous n'avez pas encore de compte ?
                        <a href="{{ route('register') }}">S'inscrire</a>
                        </div>
                    </form>
                    </div>
                    </div>
                 </div>
                </div>
              </div>
             </div>
            </div>
          </div>
        </div>
      <footer class="log-footer">
        <div class="container-fluid">
          <div class="copyright">
            <div class="copyright-text">
              <p>© 2024 Dreams Rent. Tous droits réservés.</p>
            </div>
          </div>
        </div>
      </footer>
    </div>

    <!-- Fichiers JS -->
    <script src="{{ asset('assets/js/jquery-3.7.1.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/script.js') }}"></script>
  </body>
</html>
