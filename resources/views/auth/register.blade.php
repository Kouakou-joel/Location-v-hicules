<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0" />
    <title>Inscription - Dreams Rent</title>

    <link rel="shortcut icon" href="{{ asset('assets/img/favicon.png') }}" />
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

      <div class="login-wrapper">
        <div class="loginbox">
          <div class="login-auth">
            <div class="login-auth-wrap">
              <div class="sign-group">
                <a href="{{ route('home') }}" class="btn sign-up">
                  <span><i class="fe feather-corner-down-left" aria-hidden="true"></i></span>
                  Retour à l'accueil
                </a>
              </div>
              <h1>Inscription</h1>
              <p class="account-subtitle">
                Nous vous enverrons un code de confirmation par e-mail.
              </p>
              <form action="{{ route('home-admin') }}" method="POST" id="form-register">
                @csrf
                <div class="mb-3">
                  <label class="form-label" for="name">Nom d'utilisateur <span class="text-danger">*</span></label>
                  <input type="text" name="name" class="form-control mb-3 @error('name') is-invalid @enderror" id="name" value="{{ old('name') }}" placeholder="" required />
                  @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>

                <div class="mb-3">
                  <label class="form-label" for="email">E-mail <span class="text-danger">*</span></label>
                  <input type="email" name="email" class="form-control mb-3 @error('email') is-invalid @enderror" value="{{ old('email') }}" id="email" placeholder="" autocomplete="email" required />
                  @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>

                <div class="mb-3">
                  <label class="form-label" for="password">Mot de passe <span class="text-danger">*</span></label>
                  <div class="pass-group">
                    <input type="password" name="password" class="form-control pass-input mb-3 @error('password') is-invalid @enderror" id="basic-form-password" placeholder="" autofocus required />
                    <span class="fas fa-eye-slash toggle-password"></span>
                    @error('password')
                      <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                  </div>
                </div>

                <div class="mb-3">
                  <label class="form-label" for="confirm-password">Confirmation du mot de passe <span class="text-danger">*</span></label>
                  <input type="password" class="form-control mb-3 @error('confirm_password') is-invalid @enderror" name="confirm_password" id="confirm-password" placeholder="" required />
                  @error('confirm_password')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>

                <div class="mb-3">
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="agreeterms" required />
                    <label class="form-check-label" for="agreeterms">
                      J'accepte les <a href="#">conditions générales</a>
                    </label>
                  </div>
                </div>

                <div class="mb-3">
                  <div class="form-check">
                    <input class="form-check-input" id="flexRadioDefault1" type="radio" name="account_type" value="personal" required />
                    <label class="form-check-label" for="flexRadioDefault1">Compte Personnel</label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" id="flexRadioDefault2" type="radio" name="account_type" value="professional" required />
                    <label class="form-check-label" for="flexRadioDefault2">Compte Professionnel</label>
                  </div>
                </div>

                <button type="submit" class="btn btn-outline-light w-100 btn-size mt-1">S'inscrire</button>

                <div class="login-or">
                  <span class="or-line"></span>
                  <span class="span-or">Ou, créez un compte avec votre e-mail</span>
                </div>

                <div class="social-login">
                  <a href="#" class="d-flex align-items-center justify-content-center input-block btn google-login w-100">
                    <span><img src="{{ asset('assets/img/icons/google.svg') }}" class="img-fluid" alt="Google" /></span>
                    Connectez-vous avec Google
                  </a>
                </div>

                <div class="social-login">
                  <a href="#" class="d-flex align-items-center justify-content-center input-block btn google-login w-100">
                    <span><img src="{{ asset('assets/img/icons/facebook.svg') }}" class="img-fluid" alt="Facebook" /></span>
                    Connectez-vous avec Facebook
                  </a>
                </div>

                <div class="text-center dont-have">
                  Vous avez déjà un compte? <a href="{{ route('login') }}">Connectez-vous</a>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>

      <footer class="log-footer">
        <div class="container-fluid">
          <div class="copyright">
            <p>© 2024 Dreams Rent. Tous droits réservés.</p>
          </div>
        </div>
      </footer>
    </div>

    <script src="{{ asset('assets/js/jquery-3.7.1.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/script.js') }}"></script>
    <script src="{{ asset('admin/assets/main/user/user.js') }}"></script>
  </body>
</html>
