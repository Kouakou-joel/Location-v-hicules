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

    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}" />
    <link
      rel="stylesheet"
      href="{{ asset('assets/plugins/fontawesome/css/fontawesome.min.css') }}"
    />
    <link
      rel="stylesheet"
      href="{{ asset('assets/plugins/fontawesome/css/all.min.css') }}"
    />
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

              <div>
                @if(session('error'))
                <div class="alert alert-danger" role="alert">
                    {{ session('error') }}
                </div>
                @endif
              </div>
              <h1>Connexion</h1>
              <p class="account-subtitle">
                Nous vous enverrons un code de confirmation par e-mail.
              </p>
              <form action="{{ route('post-login') }}" method="POST" id="form-register">
                @csrf
                <div class="mb-3">
                  <label class="form-label" for="basic-form-email">
                    E-mail <span class="text-danger">*</span>
                  </label>
                  <input type="email" class="form-control" id="basic-form-email" name="email" value="{{ old('email') }}" placeholder="Votre adresse e-mail" required/>
                  @error('email')
                    <div class="text-danger">{{ $message }}</div>
                  @enderror
                </div>

                <div class="mb-3">
                  <label class="form-label" for="basic-form-password">
                    Mot de passe <span class="text-danger">*</span>
                  </label>
                  <div class="pass-group">
                    <input type="password" class="form-control pass-input" id="basic-form-password" name="password"  placeholder="Votre mot de passe" required />
                    <span class="fas fa-eye-slash toggle-password"></span>
                  </div>
                  @error('password')
                  @enderror
                </div>

                <div class="input-block">
                  <a class="forgot-link" href="forgot-password.html">Mot de passe oublié ?</a>
                </div>

                <div class="input-block m-0">
                  <label class="custom_check d-inline-flex">
                    <span>Se souvenir de moi</span>
                    <input type="checkbox" name="remember" />
                    <span class="checkmark"></span>
                  </label>
                </div>

                <button type="submit" class="btn btn-outline-light w-100 btn-size mt-1">
                  Se connecter
                </button>

                {{-- <div class="login-or">
                  <span class="or-line"></span>
                  <span class="span-or">Ou, connectez-vous avec votre e-mail</span>
                </div>

                <div class="social-login">
                  <a
                    href="{{ route('home-admin') }}"
                    class="d-flex align-items-center justify-content-center input-block btn google-login w-100"
                  >
                    <span>
                      <img
                        src="{{ asset('assets/img/icons/google.svg') }}"
                        class="img-fluid" alt="Google" />
                    </span>
                    Connectez-vous avec Google
                  </a>
                </div>

                <div class="social-login">
                  <a
                    href="{{ route('home-admin') }}"
                    class="d-flex align-items-center justify-content-center input-block btn facebook-login w-100"
                  >
                    <span>
                      <img
                        src="{{ asset('assets/img/icons/facebook.svg') }}"
                        class="img-fluid"
                        alt="Facebook"
                      />
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

    <script src="{{ asset('assets/js/jquery-3.7.1.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/script.js') }}"></script>
  </body>
</html>
