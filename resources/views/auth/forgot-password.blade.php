<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=0"
    />
    <title>Mot de passe oublié | page</title>

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

              <h1>Mot de passe oublé</h1>
              <p class="account-subtitle">
                Veuillez entrez votre email <br>
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

                <button type="submit" class="btn btn-primary w-100 btn-size mt-1">
                  Valider
                </button>

                <div class="text-center dont-have">
                 Se souvenir de votre mot de passe
                  <a href="{{ route('login') }}">Se connecter</a>
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

    <!-- Fichiers JS -->
    <script src="{{ asset('assets/js/jquery-3.7.1.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/script.js') }}"></script>
  </body>
</html>
