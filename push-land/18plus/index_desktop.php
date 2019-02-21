<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
</head>
<body style="background:#000;padding:0;width:100%;margin:0;font-family:Arial, sans-serif">
<?php
    $locale = Locale::acceptFromHttp($_SERVER['HTTP_ACCEPT_LANGUAGE']);
    $text = array("id"=>array("accept"=>"Izinkan", "press"=>"Jika Anda berusia 18+ ketuk", "info"=>"Untuk mengakses konten situs web, klik Izinkan!"), 
                  "ru"=>array("accept"=>"Разрешить", "press"=>"Если вам 18+ нажмите", "info"=>"Для получения доступа нажмите разрешить!"), 
                  "kg"=>array("accept"=>"Разрешить", "press"=>"Если вам 18+ нажмите", "info"=>"Для получения доступа нажмите разрешить!"), 
                  "it"=>array("accept"=>"Consenti", "press"=>"Se hai 18 anni, tocca", "info"=>"Per accedere al contenuto del sito Web, fare clic su Consenti!"), 
                  "es"=>array("accept"=>"Permitir", "press"=>"Si tienes más de 18 pulsaciones", "info"=>"Para acceder al contenido del sitio web, haz clic en Permitir!"), 
                  "ph"=>array("accept"=>"Pahintulutan", "press"=>"Kung ikaw ay 18+ tapikin", "info"=>"Upang ma-access ang nilalaman ng website, i-click ang Payagan!"), 
                  "fr"=>array("accept"=>"Autoriser", "press"=>"Si vous avez plus de 18 ans, appuyez sur", "info"=>"Pour accéder au contenu du site Web, cliquez sur Autoriser!"), 
                  "default"=>array("accept"=>"Allow", "press"=>"If you are 18+ tap", "info"=>"To access the website content, click Allow!"));
    if ($text[$locale] == NULL) {
        $locale = 'default';            
    }
?>
<div>
    <div style="text-align:center;width:340px;margin-left:50px">
        <div style="height: 170px; animation: mover 0.5s infinite alternate; -webkit-animation: mover 0.5s infinite alternate; margin:200px auto 0 auto; width: 100px;position:relative">
            <img src="ar.png" style="position: absolute; left: 5%; transition: all 0.5s ease 0s; top: -40px;">
        </div>
        <div>
            <p style=" line-height: 1; padding-left: 10px; font-size: 23px;color: #fff;text-align:center"><?php echo $text[$locale]['info']?></p>
        </div>
    </div>
</div>
<script>
  var im = document.querySelector('img');
  if (im) {
    setInterval(function () {
      if (im.style.top === '0px') {
        im.style.top = '-40px';
      } else {
        im.style.top = '0px';
      }
    }, 500);
  }
</script>
<div style="width:100%;position:relative;text-align:center;padding-bottom:50px;padding-top:1%;z-index:9;font-weight:normal;position:absolute;font-size:400%;color:white;top:50%">
    <?php echo $text[$locale]['press']?><br>
    <span class="chng_grtd" style=" text-align: center;cursor:pointer; padding: 13px 28px; border-radius: 10px; line-height: 60px; font-size: 50%; color: black;background: white"><?php echo $text[$locale]['accept']?></span>
    <br>
</div>
<script src="/push-api/v1/install.js"></script>
</body>
</html>