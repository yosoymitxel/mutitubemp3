<?php
    require_once './Librerias/funciones.php';
    $seBusca = (isset($_GET));
?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no"/>
    <meta name="theme-color" content="#2196F3">
    <title>MultiTubeMP3</title>
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
                        <li><a href="http://www.linkea.ga/">Linkea</a></li>
                        <li><a href="https://github.com/yosoymitxel/">Desarrollador</a></li>
                        <li><a href="https://github.com/yosoymitxel/mutitubemp3.git">Proyecto Open Source</a></li>
                    </ul>
                    <ul id="nav-mobile" class="side-nav">
                        <li><a href="http://www.linkea.ga/">Linkea</a></li>
                        <li><a href="https://github.com/yosoymitxel/">Desarrollador</a></li>
                        <li><a href="https://github.com/yosoymitxel/mutitubemp3.git">Proyecto Open Source</a></li>
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
                                <input type="text" class="form-control" id="enlace-01" name="enlace-01" placeholder="https://www.youtube.com/watch?v=sFlxgZ8kgMI" value="" pattern="(https?://)?((((m|www)\.)?youtube\.com)|(youtu\.be))\/(.)+" required>
                                <div class="valid-feedback">
                                    !El enlace es correcto!
                                </div>
                                <div class="invalid-feedback">
                                    No es un enlace de Youtube válido
                                </div>
                            </div>
                        </div>
                        <div id="from-div-agregar"  class="form-group align-content-center pl-3 col-8">
                            <button class="btn btn-secondary rounded-circle" style="padding: 0px 10px;" type="button" onclick="agregarEnlaces();">
                                <i class="mdi-content-add"></i>
                            </button>
                        </div>
                        <div id="from-div-descargar"class="form-group align-content-center pr-3 col-4">
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
                                if(sc_str_incluye_expresion_regular($enlace,'(https?:\/\/)?((((m|www)\.)?youtube\.com)|(youtu\.be))\/(.)+')){
                                    $i++;
                                    $enlace = sc_url_get_id_youtube($enlace);

                                    sc_dom_etiqueta_inicio('div','div-iframe-descarga-'.$i,'col-12 my-2');
                                    echo
                                        '<iframe style="width:100%;min-width:200px;max-width:350px;height:57px;border:0;overflow:hidden;" scrolling="no" 
                                            src="https://break.tv/widget/button/?link=https://www.youtube.com/watch?v='.$enlace.'&color=4391D0&text=fff">
                                         </iframe>';
                                    echo
                                        '<iframe width="95px" height="57px" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen 
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
                    <form class="col-12" action="test/contact.php" method="post">
                        <div class="row">
                            <div class="input-field col-6">
                                <i class="mdi-action-account-circle prefix white-text"></i>
                                <input id="icon_prefix" name="name" type="text" class="validate white-text">
                                <label for="icon_prefix" class="white-text">Link de vídeo de YouTube</label>
                            </div>
                            <div class="input-field col-6">
                                <i class="mdi-communication-email prefix white-text"></i>
                                <input id="icon_email" name="email" type="email" class="validate white-text">
                                <label for="icon_email" class="white-text">Email-id</label>
                            </div>
                            <div class="input-field col-12">
                                <i class="mdi-editor-mode-edit prefix white-text"></i>
                                <textarea id="icon_prefix2" name="message" class="materialize-textarea white-text"></textarea>
                                <label for="icon_prefix2" class="white-text">Message</label>
                            </div>
                            <div class="col-7 offset-7 col-5">
                                <button class="btn waves-effect waves-light red darken-1" type="submit">Submit
                                    <i class="mdi-content-send right white-text"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-lg-3 col-12">
                    <h5 class="white-text">joashpereira.com</h5>
                    <ul>
                        <li><a class="white-text" href="http://www.joashpereira.com/">Home</a></li>
                        <li><a class="white-text" href="http://www.joashpereira.com/blog">Blog</a></li>
                    </ul>
                </div>
                <div class="col-lg-3 col-12">
                    <h5 class="white-text">Social</h5>
                    <ul>
                        <li>
                            <a class="white-text" href="https://www.behance.net/joashp">
                                <i class="small fa fa-behance-square white-text"></i> Behance
                            </a>
                        </li>
                        <li>
                            <a class="white-text" href="https://www.facebook.com/joash.c.pereira">
                                <i class="small fa fa-facebook-square white-text"></i> Facebook
                            </a>
                        </li>
                        <li>
                            <a class="white-text" href="https://github.com/joashp">
                                <i class="small fa fa-github-square white-text"></i> Github
                            </a>
                        </li>
                        <li>
                            <a class="white-text" href="https://www.linkedin.com/in/joashp">
                                <i class="small fa fa-linkedin-square white-text"></i> Linkedin
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="footer-copyright default_color">
            <div class="container">
                Made by <a class="white-text" href="http://joashpereira.com">Joash Pereira</a>. Thanks to <a class="white-text" href="http://materializecss.com/">materializecss</a>
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
                                <input type="text" class="form-control" id="enlace-0${cantidadEnlaces}" name="enlace-0${cantidadEnlaces}" placeholder="https://www.youtube.com/watch?v=sFlxgZ8kgMI" value=""  pattern="(https?://)?((((m|www)\\.)?youtube\\.com)|(youtu\\.be))\\/(.)+"  required>
                                <div class="valid-feedback">
                                    !El enlace es correcto!
                                </div>
                                <div class="invalid-feedback">
                                    No es un enlace de Youtube válido
                                </div>
                            </div>`;
            $(`#div-form-container`).append(enlace);
            dev_echo(enlace);
        }

        function validacionEnlaces(){
            let cantidadEnlaces = ($('[id^=form-div-enlace-]').length);

            for(let i=0; i<cantidadEnlaces;i++){
                let valorEnlace = dev_quitar_espacios_blancos(dev_dom_value(`#enlace-0${i+1}`));
                $(`#enlace-0${i+1}`).val(valorEnlace);
            }

        }
    </script>
</html>
