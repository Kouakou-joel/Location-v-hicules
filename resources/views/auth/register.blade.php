<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=0"
    />
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
               <form action="index.html" method="POST">
                  @csrf

                        <div class="mb-3">
                        <label class="form-label" for="firstname" >Nom d'utilisateur <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="firstname" id="firstname" placeholder="" />
                        </div>
                        <div class="mb-3">
                        <label class="form-label" for="email">E-mail <span class="text-danger">*</span></label>
                        <input type="email" class="form-control" id="email" name=" email" placeholder="" />
                        </div>
                        <div class="mb-3">
                        <label class="form-label" for="password">Mot de passe <span class="text-danger">*</span></label>
                        <div class="pass-group">
                            <input type="password" name="password" class="form-control pass-input" id="password" placeholder="" />
                            <span class="fas fa-eye-slash toggle-password"></span>
                        </div>
                        </div>

                        <div class="mb-3">
                        <label class="form-label" for="password-confirm">Confirmation Mot de passe</label>
                        <input class="form-control" name="password-confirm" id="password-confirm" type="password" />
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="basic-form-gender">Genre</label>
                            <select class="form-select" id="basic-form-gender">
                                <option selected="selected">Sélectionnez votre genre</option>
                                <option value="male">Homme</option>
                                <option value="female">Femme</option>
                                <option value="other">Autre</option>
                            </select>
                            </div>

                        <div class="mb-3">
                        <div class="form-check">
                            <input class="form-check-input" id="flexRadioDefault1" type="radio" name="flexRadioDefault" />
                            <label class="form-check-label mb-0" for="flexRadioDefault1">Compte Personnel</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" id="flexRadioDefault2" type="radio" name="flexRadioDefault" checked="checked" />
                            <label class="form-check-label mb-0" for="flexRadioDefault2">Compte Professionnel</label>
                        </div>
                        </div>
                        <button type="submit"  name="register-user" class="btn btn-outline-light w-100 btn-size mt-1">S'inscrire</button>
                        <div class="login-or">
                        <span class="or-line"></span>
                        <span class="span-or">Ou, créez un compte avec votre e-mail</span>
                        </div>
                        <div class="social-login">
                        <a href="#" class="d-flex align-items-center justify-content-center input-block btn google-login w-100" aria-label="Connectez-vous avec Google">
                            <span><img src="{{ asset('assets/img/icons/google.svg') }}" class="img-fluid" alt="Google" /></span>
                            Connectez-vous avec Google
                        </a>
                        </div>
                        <div class="social-login">
                        <a href="#" class="d-flex align-items-center justify-content-center input-block btn google-login w-100" aria-label="Connectez-vous avec Facebook">
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
