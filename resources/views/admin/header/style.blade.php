 <!-- ===============================================-->
    <!--    Favicons-->
    <!-- ===============================================-->
    <link
      rel="apple-touch-icon"
      sizes="180x180"
      href="../assets/img/favicons/apple-touch-icon.png"
    />
    <link
      rel="icon"
      type="image/png"
      sizes="32x32"
      href="../assets/img/favicons/favicon-32x32.png"
    />
    <link
      rel="icon"
      type="image/png"
      sizes="16x16"
      href="{{asset("../assets/img/favicons/favicon-16x16.png")}}"
    />
    <link
      rel="shortcut icon"
      type="image/x-icon"
      href="{{asset("../assets/img/favicons/favicon.ico")}}"
    />
    <link rel="manifest" href="{{asset("../assets/img/favicons/manifest.json")}}" />
    <meta
      name="msapplication-TileImage"
      content="{{asset("admin/assets/img/favicons/mstile-150x150.png")}}"
    />
    <meta name="theme-color" content="#ffffff" />
    <script src="{{asset("admin/vendors/simplebar/simplebar.min.js")}}"></script>
    <script src="{{asset("admin/assets/js/config.js")}}"></script>s

    <!-- ===============================================-->
    <!--    Stylesheets-->
    <!-- ===============================================-->
    <link href="{{asset("admin/vendors/mapbox-gl/mapbox-gl.css")}}" rel="stylesheet" />
    <link href="../vendors/swiper/swiper-bundle.min.css" rel="stylesheet" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin="" />
    <link href="../vendors/simplebar/simplebar.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{asset("admin/release/v4.0.8/css/line.css")}}" />
    <link
      href="{{asset("admin/assets/css/theme-rtl.min.css")}}.."
      type="text/css"
      rel="stylesheet"
      id="style-rtl"
    />
    <link
      href="{{asset("admin/assets/css/theme.min.css")}}"
      type="text/css"
      rel="stylesheet"
      id="style-default"
    />
    <link
      href="{{asset("admin/assets/css/user-rtl.min.css")}}"
      type="text/css"
      rel="stylesheet"
      id="user-style-rtl"
    />
    <link
      href="{{asset("admin/assets/css/user.min.css")}}"
      type="text/css"
      rel="stylesheet"
      id="user-style-default"
    />
    <script>
      var phoenixIsRTL = window.config.config.phoenixIsRTL;
      if (phoenixIsRTL) {
        var linkDefault = document.getElementById("style-default");
        var userLinkDefault = document.getElementById("user-style-default");
        linkDefault.setAttribute("disabled", true);
        userLinkDefault.setAttribute("disabled", true);
        document.querySelector("html").setAttribute("dir", "rtl");
      } else {
        var linkRTL = document.getElementById("style-rtl");
        var userLinkRTL = document.getElementById("user-style-rtl");
        linkRTL.setAttribute("disabled", true);
        userLinkRTL.setAttribute("disabled", true);
      }

      <script>
        var navbarTopShape = window.config.config.phoenixNavbarTopShape;
        var navbarPosition = window.config.config.phoenixNavbarPosition;
        var body = document.querySelector("body");
        var navbarDefault = document.querySelector("#navbarDefault");
        var navbarTop = document.querySelector("#navbarTop");
        var topNavSlim = document.querySelector("#topNavSlim");
        var navbarTopSlim = document.querySelector("#navbarTopSlim");
        var navbarCombo = document.querySelector("#navbarCombo");
        var navbarComboSlim = document.querySelector("#navbarComboSlim");
        var dualNav = document.querySelector("#dualNav");

        var documentElement = document.documentElement;
        var navbarVertical = document.querySelector(".navbar-vertical");

        if (navbarPosition === "dual-nav") {
          topNavSlim?.remove();
          navbarTop?.remove();
          navbarTopSlim?.remove();
          navbarCombo?.remove();
          navbarComboSlim?.remove();
          navbarDefault?.remove();
          navbarVertical?.remove();
          dualNav.removeAttribute("style");
          document.documentElement.setAttribute("data-navigation-type", "dual");
        } else if (navbarTopShape === "slim" && navbarPosition === "vertical") {
          navbarDefault?.remove();
          navbarTop?.remove();
          navbarTopSlim?.remove();
          navbarCombo?.remove();
          navbarComboSlim?.remove();
          topNavSlim.style.display = "block";
          navbarVertical.style.display = "inline-block";
          document.documentElement.setAttribute(
            "data-navbar-horizontal-shape",
            "slim"
          );
        } else if (
          navbarTopShape === "slim" &&
          navbarPosition === "horizontal"
        ) {
          navbarDefault?.remove();
          navbarVertical?.remove();
          navbarTop?.remove();
          topNavSlim?.remove();
          navbarCombo?.remove();
          navbarComboSlim?.remove();
          dualNav?.remove();
          navbarTopSlim.removeAttribute("style");
          document.documentElement.setAttribute(
            "data-navbar-horizontal-shape",
            "slim"
          );
        } else if (navbarTopShape === "slim" && navbarPosition === "combo") {
          navbarDefault?.remove();
          navbarTop?.remove();
          topNavSlim?.remove();
          navbarCombo?.remove();
          navbarTopSlim?.remove();
          dualNav?.remove();
          navbarComboSlim.removeAttribute("style");
          navbarVertical.removeAttribute("style");
          document.documentElement.setAttribute(
            "data-navbar-horizontal-shape",
            "slim"
          );
        } else if (
          navbarTopShape === "default" &&
          navbarPosition === "horizontal"
        ) {
          navbarDefault?.remove();
          topNavSlim?.remove();
          navbarVertical?.remove();
          navbarTopSlim?.remove();
          navbarCombo?.remove();
          navbarComboSlim?.remove();
          dualNav?.remove();
          navbarTop.removeAttribute("style");
          document.documentElement.setAttribute(
            "data-navigation-type",
            "horizontal"
          );
        } else if (navbarTopShape === "default" && navbarPosition === "combo") {
          topNavSlim?.remove();
          navbarTop?.remove();
          navbarTopSlim?.remove();
          navbarDefault?.remove();
          navbarComboSlim?.remove();
          dualNav?.remove();
          navbarCombo.removeAttribute("style");
          navbarVertical.removeAttribute("style");
          document.documentElement.setAttribute(
            "data-navigation-type",
            "combo"
          );
        } else {
          topNavSlim?.remove();
          navbarTop?.remove();
          navbarTopSlim?.remove();
          navbarCombo?.remove();
          navbarComboSlim?.remove();
          dualNav?.remove();
          navbarDefault.removeAttribute("style");
          navbarVertical.removeAttribute("style");
        }

        var navbarTopStyle = window.config.config.phoenixNavbarTopStyle;
        var navbarTop = document.querySelector(".navbar-top");
        if (navbarTopStyle === "darker") {
          navbarTop.setAttribute("data-navbar-appearance", "darker");
        }

        var navbarVerticalStyle =
          window.config.config.phoenixNavbarVerticalStyle;
        var navbarVertical = document.querySelector(".navbar-vertical");
        if (navbarVerticalStyle === "darker") {
          navbarVertical.setAttribute("data-navbar-appearance", "darker");
        }
      </script>
    </script>
