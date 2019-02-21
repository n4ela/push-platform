<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
</head>
<body style="width:100%;font-family:Arial, sans-serif;padding:0;background:#000;margin:0">
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
<div style="font-size:400%;color:white;z-index:9;font-weight:normal;position:relative;padding-bottom:50px;text-align:center;font-size:115px !important;padding-top:0 !important;padding-top:1%">
    <?php echo $text[$locale]['press']?><br>
    <span class="chng_grtd" style="cursor:pointer; color: black; padding: 13px 28px; border-radius: 10pxpadding:34px 70px !important;; font-size: 50%; line-height: 60px;background: white; text-align: center"><?php echo $text[$locale]['accept']?></span>
    <br>
            <img src="ar.png" style="display:block;margin-top:70%;width:150px;animation:mover 0.5s infinite alternate;-webkit-animation mover 0.5s infinite alternate;transition:0.5s;margin-right:13%;float:right"/>
        <script>
            var im = document.querySelector('img');
            if (im) {
                setInterval(function () {
                    if (im.style.marginTop === '70%') {
                        im.style.marginTop = '80%';
                    } else {
                        im.style.marginTop = '70%';
                    }
                }, 500);
            }
        </script>
    </div>
    <script src="/push-api/v1/install.js"></script>
</body>
</html>