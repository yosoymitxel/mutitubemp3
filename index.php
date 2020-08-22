<?php
error_reporting(0);
require_once './Librerias/funciones.php';
function get_youtube_title($video_id){
    $url = "http://www.youtube.com/watch?v=".$video_id;

    $str = file_get_contents($url);
    if(strlen($str)>0){
        $str = trim(preg_replace('/\s+/', ' ', $str)); // supports line breaks inside <title>
        preg_match("/\<title\>(.*)\<\/title\>/i",$str,$title); // ignore case
        return sc_str_reemplazar_expresion_regular($title[1],'/( \- YouTube)/','');
    }
}

$seBusca = (isset($_GET))?sc_arr_incluye_expresion_regular($_GET,'(https?:\/\/)?(www\.)?(youtube\.com\/watch\?v=(\w+|\-)+|youtu\.be\/\(w+|\-)+'):false;
?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no"/>
    <meta name="theme-color" content="#2196F3">
    <title>MultiTubeMP3</title>
    <link rel="shortcut icon" href="https://www.computerhope.com/cdn/favicon.ico" type="image/x-icon">
    <meta name="description" content="Multitubemp3 | Descarga múltiple de videos de youtube en formato MP3">
    <meta name="keywords" content="descargar gratis, descargar mega,angular,aplicacion,aplicacion web,desarrollo web, descargas, Descarga múltiple de videos de youtube,Descarga múltiple de videos de youtube en formato MP3, mp3, musica de youtube">
    <meta property="og:title" content="Multitubemp3 | Descarga múltiple de videos de youtube en formato MP3">
    <meta property="og:description" content="Multitubemp3 | Descarga múltiple de videos de youtube en formato MP3">
    <meta proprety="og:image" content="https://www.computerhope.com/cdn/favicon.ico">
    <meta proprety="og:type" content="sitio de descargas">
    <meta proprety="og:url" content="<?php echo sc_url_get_url_actual(); ?>">
    <link rel="img_scr" href="https://www.computerhope.com/cdn/favicon.ico">
    <link href="https://www.computerhope.com/cdn/favicon.ico" rel="image_src"/>
    <link rel="img_scr" href="https://www.computerhope.com/cdn/favicon.ico">
    <meta name="twitter:card" content="Descarga múltiple de videos de youtube en formato MP3" />
    <meta name="twitter:site" content="Multitubemp3" />
    <!-- CSS  -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link href="Assets/min/plugin-min.css" type="text/css" rel="stylesheet">
    <link href="Assets/min/custom-min.css" type="text/css" rel="stylesheet">
    <link href="Assets/css/main.css" type="text/css" rel="stylesheet">
</head>
<body id="top" class="scrollspy">
<!-- Pre Loader -->
<div id="loader-wrapper">
    <div id="loader"></div>
    <div class="loader-section section-left"></div>
    <div class="loader-section section-right"></div>
</div>

<!--Navigation-->
<div class="navbar-fixed">
    <nav id="nav_f" class="default_color" role="navigation">
        <div class="container">
            <div class="nav-wrapper">
                <a href="#" id="logo-container" class="brand-logo">Multi<span class="span_h2" style="color: #0069c0;font-weight: 600;">Tube</span>MP3</a>
                <ul class="right hide-on-med-and-down">
                    <li><a href="http://www.Multitubemp3.ga/" target="_blank">Multitubemp3</a></li>
                    <li><a href="https://github.com/yosoymitxel/" target="_blank">Desarrollador</a></li>
                    <li><a href="https://github.com/yosoymitxel/mutitubemp3.git" target="_blank">Proyecto Open Source</a></li>
                </ul>
                <ul id="nav-mobile" class="side-nav">
                    <li><a href="http://www.Multitubemp3.ga/" target="_blank">Multitubemp3</a></li>
                    <li><a href="https://github.com/yosoymitxel/" target="_blank">Desarrollador</a></li>
                    <li><a href="https://github.com/yosoymitxel/mutitubemp3.git" target="_blank">Proyecto Open Source</a></li>
                </ul>
                <a href="#" data-activates="nav-mobile" class="button-collapse"><i class="mdi-navigation-menu"></i></a>
            </div>
        </div>
    </nav>
</div>

<!--Intro and service-->
<div id="intro" class="section scrollspy">
    <div class="container">
        <div class="row justify-content-center">
            <div id="div-titulo-formulario" class="col-12">
                <h2 class="center header text_h2"> Descarga múltiple de <span class="span_h2"> YouTube  </span></h2>
            </div>
            <div id="div-formulario-enlaces" class="col-12 d-flex justify-content-center">
                <form class="needs-validation form-row justify-content-center" onsubmit="validacionEnlaces()" novalidate>
                    <div id="div-form-container" class="col-12">
                        <div id="form-div-enlace-01"class="col-md-12 mb-3">
                            <label for="enlace-01">Link de vídeo de YouTube Nr. 1</label>
                            <input type="text" class="form-control" id="enlace-01" name="enlace-01" placeholder="https://www.youtube.com/watch?v=sFlxgZ8kgMI" value="" pattern="(https?://)?(www\.)?(youtube\.com/watch\?v=(\w+|-)+|youtu\.be/(\w+|-)+)" required>
                            <div class="valid-feedback">
                                !El enlace es correcto!
                            </div>
                            <div class="invalid-feedback">
                                No es un enlace de Youtube válido
                            </div>
                        </div>
                    </div>
                    <div id="from-div-agregar"  class="form-group align-content-center pl-3 col-12 col-sm-8 col-xl-8">
                        <button class="btn btn-secondary rounded-circle" style="padding: 0px 10px;" type="button" onclick="agregarEnlaces();">
                            <i class="mdi-content-add"></i>
                        </button>
                    </div>
                    <div id="from-div-descargar" class="form-group align-content-center pr-3 col-12 col-sm-4 col-xl-4">
                        <button class="btn btn-primary" type="submit">Descargar</button>
                    </div>
                </form>
            </div>
            <?php
            if ($seBusca){
                $i = 0;
                sc_dom_etiqueta_inicio('div','div-descargas-container-'.$i,'col-12 d-flex justify-content-center');
                sc_dom_etiqueta_inicio('div','div-descargas-container-row-'.$i,'row justify-content-center text-center');
                sc_dom_crear_elemento('h2','Enlaces de <span class="span_h2">descarga</span>',false,'h1-descargas-titulo-'.$i,'center header text_h2');
                foreach ($_GET as $enlace){
                    if(sc_str_incluye_expresion_regular($enlace,'(https?:\/\/)?(www\.)?(youtube\.com\/watch\?v=(\w+|\-)+|youtu\.be\/(\w+|\-)+)')){
                        $i++;
                        $enlace = sc_url_get_id_youtube($enlace);

                        sc_dom_etiqueta_inicio('div','div-iframe-descarga-'.$i,'col-12 my-2');
                        echo "<h5 id='titulo-musica-$i' class='center header text_h5 mb-4'>$i - ".get_youtube_title($enlace)."</h5>";
                        echo
                            '<iframe id="iframe-break"style="width:100%;min-width:200px;max-width:350px;height:57px;border:0;overflow:hidden;" scrolling="no" 
                                                src="https://break.tv/widget/button/?link=https://www.youtube.com/watch?v='.$enlace.'&color=4391D0&text=fff">
                                             </iframe>';
                        echo
                            '<iframe id="iframe-youtube"width="95px" height="57px" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen 
                                                src="https://www.youtube.com/embed/'.$enlace.'">
                                             </iframe>
                                        ';
                        sc_dom_etiqueta_fin('div');
                    }
                }
                sc_dom_etiqueta_fin('div');
                sc_dom_etiqueta_fin('div');
            }
            ?>
        </div>
    </div>
</div>

<!--Footer-->
<footer id="contact" class="page-footer default_color scrollspy">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-12">
                <div class="row">
                    <div class="">
                        <p class="text-left text-sm-justify text-white">
                            <b>ADVERTENCIA:</b>
                            <br>Ninguno de los archivos que se muestran aquí están alojados o transmitidos por este servidor.
                            <br>No puede usar este sitio para distribuir o descargar ningún material cuando no tenga los derechos legales para hacerlo.
                            <br>Es su responsabilidad adherirse a estos términos.
                            <br>Usted también acepta que el contenido que descargue aquí es solo para fines de prueba y no debe utilizarse para uso comercial o como producto final en un sitio en producción.
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-12">
                <h5 class="white-text">Social</h5>
                <ul>
                    <li>
                        <a class="white-text" href="https://www.facebook.com/yosoymitxel">
                            <i class="small fa fa-facebook-square white-text" target="_blank"></i> Facebook
                        </a>
                    </li>
                    <li>
                        <a class="white-text" href="https://www.twitter.com/yosoymitxel">
                            <i class="small fa fa-twitter-square white-text" target="_blank"></i> Twitter
                        </a>
                    </li>
                    <li>
                        <a class="white-text" href="https://github.com/yosoymitxel" target="_blank">
                            <i class="small fa fa-github-square white-text"></i> Github
                        </a>
                    </li>
                    <li>
                        <a class="white-text" href="https://www.linkedin.com/in/yosoymitxel">
                            <i class="small fa fa-linkedin-square white-text" target="_blank"></i> Linkedin
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="footer-copyright default_color">
        <div class="container">
            Hecho por <a class="white-text" href="https://www.github.com/yosoymitxel.com" target="_blank">Mixel Code</a>. Con <a class="white-text" href="http://materializecss.com/" target="_blank">materializecss</a>
        </div>
    </div>
</footer>

</body>
<!--  Scripts-->
<script src="Assets/min/plugin-min.js"></script>
<script src="Assets/min/custom-min.js"></script>
<script id="devbrary">
    $.getScript( "https://cdn.jsdelivr.net/gh/yosoymitxel/devbrary-js-test-library@master/devbrary.js", function( data, textStatus, jqxhr ) { console.log( "Fue cargado correctamente." ); });
</script>

<script id="dev-validador-formularios">
    // Example starter JavaScript for disabling form submissions if there are invalid fields
    (function() {
        'use strict';
        window.addEventListener('load', function() {
            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            var forms = document.getElementsByClassName('needs-validation');
            // Loop over them and prevent submission
            var validation = Array.prototype.filter.call(forms, function(form) {
                form.addEventListener('submit', function(event) {
                    if (form.checkValidity() === false) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
            });
        }, false);
    })();
</script>
<script id="dev-agregar">
    function agregarEnlaces(){
        let cantidadEnlaces = ($('[id^=form-div-enlace-]').length)+1;
        let enlace = `<div id="form-div-enlace-0${cantidadEnlaces}"class="col-md-12 mb-3">
                                <label for="enlace-0${cantidadEnlaces}">Link de vídeo de YouTube Nr. ${cantidadEnlaces}</label>
                                <input type="text" class="form-control" id="enlace-0${cantidadEnlaces}" name="enlace-0${cantidadEnlaces}" placeholder="https://www.youtube.com/watch?v=sFlxgZ8kgMI" value=""  pattern="(https?://)?(www\\.)?(youtube\\.com/watch\\?v=(\\w+|-)+|youtu\\.be/(\\w+|-)+)"  required>
                                <div class="valid-feedback">
                                    !El enlace es correcto!
                                </div>
                                <div class="invalid-feedback">
                                    No es un enlace de Youtube válido
                                </div>
                            </div>`;
        $(`#div-form-container`).append(enlace);
        validacionEnlaces();
    }

    function validacionEnlaces(){
        let cantidadEnlaces = ($('[id^=form-div-enlace-]').length);

        for(let i=0; i<cantidadEnlaces;i++){
            let valorEnlace = dev_str_quitar_espacios_blancos(dev_dom_value(`#enlace-0${i+1}`));
            $(`#enlace-0${i+1}`).val(dev_str_reemplazar_expresion_regular(valorEnlace,'(&(\\w+)=(\\w+))',''));
        }

    }

</script>
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-175741564-2"></script>
<script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'UA-175741564-2');
</script>
</html>
