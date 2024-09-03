<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=0"
    />
    <title>Inscription | page</title>

    <link rel="shortcut icon" href="assets/img/favicon.png" />

    <link rel="stylesheet" href="{{asset("assets/css/bootstrap.min.css")}}" />

    <link
      rel="stylesheet"
      href="{{asset("assets/plugins/fontawesome/css/fontawesome.min.css")}}"
    />
    <link rel="stylesheet" href="{{asset("assets/plugins/fontawesome/css/all.min.css")}}" />

    <link rel="stylesheet" href="{{asset("assets/css/feather.css")}}" />

    <link rel="stylesheet" href="{{asset('assets/css/style.css')}}" />
  </head>
  <body>
    <div class="main-wrapper login-body">
      <header class="log-header">
        <a href="index.html"
          ><img
            class="img-fluid logo-dark"
            src="assets/img/logo.svg"
            alt="Logo"
        /></a>
      </header>

      <div class="login-wrapper">
        <div class="loginbox">
          <div class="login-auth">
            <div class="login-auth-wrap">
              <div class="sign-group">
                <a href="index.html" class="btn sign-up"
                  ><span
                    ><i
                      class="fe feather-corner-down-left"
                      aria-hidden="true"
                    ></i
                  ></span>
                  Retour à l'accueil</a
                >
              </div>
              <h1>Inscription</h1>
              <p class="account-subtitle">
                Nous vous enverrons un code de confirmation par e-mail.
              </p>
              <form action="index.html">
                <div class="input-block">
                  <label class="form-label"
                    >Nom d'utilisateur <span class="text-danger">*</span></label
                  >
                  <input type="text" class="form-control" placeholder="" />
                </div>
                <div class="input-block">
                  <label class="form-label"
                    >E-mail <span class="text-danger">*</span></label
                  >
                  <input type="email" class="form-control" placeholder="" />
                </div>
                <div class="input-block">
                  <label class="form-label"
                    >Mot de passe <span class="text-danger">*</span></label
                  >
                  <div class="pass-group">
                    <input
                      type="password"
                      class="form-control pass-input"
                      placeholder=""
                    />
                    <span class="fas fa-eye-slash toggle-password"></span>
                  </div>
                </div>
                <a
                  href="login.html"
                  class="btn btn-outline-light w-100 btn-size mt-1"
                  >S'inscrire</a
                >
                <div class="login-or">
                  <span class="or-line"></span>
                  <span class="span-or"
                    >Ou, créez un compte avec votre e-mail</span
                  >
                </div>

                <div class="social-login">
                  <a
                    href="#"
                    class="d-flex align-items-center justify-content-center input-block btn google-login w-100"
                    ><span
                      ><img
                        src="assets/img/icons/google.svg"
                        class="img-fluid"
                        alt="Google" /></span
                    >Connectez-vous avec Google</a
                  >
                </div>
                <div class="social-login">
                  <a
                    href="#"
                    class="d-flex align-items-center justify-content-center input-block btn google-login w-100"
                    ><span
                      ><img
                        src="assets/img/icons/facebook.svg"
                        class="img-fluid"
                        alt="Facebook" /></span
                    >Connectez-vous avec Facebook</a
                  >
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

    <script src="{{ asset('assets/js/jquery-3.7.1.min.js') }}" type="text/javascript"></script>

    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/js/script.js') }}" type="text/javascript"></script>

    <script
      src="../../cdn-cgi/scripts/7d0fa10a/cloudflare-static/rocket-loader.min.js"
      data-cf-settings="ea7d3f1e436a3d1c024d0ed4-|49"
      defer=""
    ></script>
  </body>
</html>