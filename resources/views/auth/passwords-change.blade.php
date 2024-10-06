<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=0"
    />
    <title>Changer le mot de passe| page</title>

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
              @if(session('success'))
                <div class="alert alert-primary" role="alert">{{ session('success') }}</div>
              @endif

              <h1>Changer votre mot de passe</h1>


              <!-- Formulaire de connexion -->
              <form action="{{ route('passwords.update') }}" method="POST" >
                @csrf
                  @method('PUT')

                <div class="mb-3">
                  <label class="form-label" for="form-current_password">
                     Mot de passe actuel <span class="text-danger">*</span>
                  </label>
                  <input type="password" class="form-control @error('current_password') is-invalid @enderror" id="form-current_password" name="current_password"  value="{{ old('current_password') }}"  autocomplete="current_password"  required autofocus aria-describedby="current_password" />
                  @error('current_password')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label" for="form-password">
                     Nouveau mot de psse <span class="text-danger">*</span>
                    </label>
                    <input type="password" class="form-control @error('password') is-invalid @enderror" id="form-password" name="password"  autocomplete="password" />
                    @error('password')
                      <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                  </div>

                  <div class="mb-3">
                    <label class="form-label" for="form-password_confirm">
                    Confirmer le nouveau mot de passe</label>
                    <input type="password_confirm" class="form-control id="form-password_confirm" name="password_confirm"  value="{{ old('password_confirm') }}"  autocomplete="password_confirm"  required autofocus aria-describedby="password_confirm" />
                  </div>
                <button type="submit" class="btn btn-primary w-100 btn-size mt-1">
                 Mettre à jour votre mot de passe
                </button>
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
