<?php

ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(E_ALL);


/*DEV*/

function sc_var_dump($obj,$etiqueta='',$id='',$class='',$style=''){
    echo (!sc_dom_etiqueta_inicio($etiqueta)) ?
        "<pre id='$id' class='$class' style='$style'>" :
        "<pre>";
    var_dump($obj);
    echo '</pre>';
    sc_dom_etiqueta_fin($etiqueta);
}

function sc_echo($t){
    echo("<p>$t</p>");
}

function sc_dev_echo_indice($titulo,$texto,$etiqueta='p',$id='',$class='',$style='',$name=''){
    $texto = "$titulo : $texto";
    sc_dom_crear_elemento($etiqueta,$texto,$id,$class,$style,$name);
}

function sc_dev_contador_texto_para_pruebas($texto='Prueba',$valor = false) {
    static $index = 0;
    if($valor===0){
        $index = 0;
    }
    $index++;
    echo "<p id='".validarCaracteres($texto)."-$index' class='m-0 p-0 w-100'>$texto: $index</p>";
}

function sc_dev_echo_oculto($texto,$depurar=false,$id='id-oculto',$clase=''){
    echo "<div style='display: none;' class='$clase' id='$id'>";
    if ($depurar){
        sc_var_dump($texto);
    }else{
        echo "<p>$texto</p>";
    }
    echo '</div>';
}

function sc_dev_depurar($condicion,$obj,$id='id-depuracion'){
    if($condicion){
        sc_dom_etiqueta_inicio('div',"id-$id");
        sc_dom_crear_elemento('h3',$id,"id-$id");
        sc_var_dump($obj,"id-$id");
        sc_dom_etiqueta_fin('div');
    }
}

function sc_dev_obj_a_bool($obj,$depurar){
    sc_dev_depurar($depurar,$obj,'sc_dev_obj_a_bool');
    return !(!$obj);
}



/*DOM*/

function sc_dom_get_atributos($arrayAtributos,$depurar=false){
    if(is_array($arrayAtributos)){
        $atributos = '';

        foreach ($arrayAtributos as $atributo => $valor){
            if($depurar===true){
                sc_var_dump($atributo.' : '.$valor,'p');
            }
            $atributos .= ($valor)? $atributo.'="'.$valor.'", ' : '';
        }

        $atributos = implode(' ',(explode(',',$atributos)));
        return $atributos;
    }
    return false;
}

function sc_dom_crear_elemento($etiqueta,$contenido,$depurar=false,$id='',$class='',$style='',$name=''){
    if(isset($etiqueta{0})){
        $atributos = array('id'=>$id,'class'=>$class,'style'=>$style,'name'=>$name);
        $elemento  = "<$etiqueta ".sc_dom_get_atributos($atributos,$depurar);
        echo $elemento.">$contenido</$etiqueta>";
        return true;
    }

    return false;
}

function sc_dom_crear_elemento_sin_cerrar($etiqueta,$depurar=false,$value='',$id='',$class='',$style='',$name='',$type='',$src='',$alt=''){
    if(isset($etiqueta{0})){
        $atributos = array('id'=>$id,'class'=>$class,'style'=>$style,'name'=>$name,'value'=>$value,'type'=>$type,'src'=>$src,'alt'=>$alt);
        $elemento  = "<$etiqueta ".sc_dom_get_atributos($atributos,$depurar);
        echo $elemento.">";
        return true;
    }

    return false;
}

function sc_dom_crear_elemento_personalizado($etiqueta,$contenido,$arrayTipoAtributos,$arrayValorAtributos,$etiquetaCerrada=true,$depurar=false){
    sc_dev_depurar($depurar,
        array('etiqueta'=>$etiqueta,
            'Contenido'          =>$contenido,
            'arrayTipoAtributos' =>$arrayTipoAtributos,
            'arrayValorAtributos'=>$arrayValorAtributos,
            'cerradoAbierto'     =>$etiquetaCerrada
        ),'sc_dom_crear_elemento_personalizado');

    $arrayTemp = array_combine($arrayTipoAtributos,$arrayValorAtributos);
    $atributos = sc_dom_get_atributos($arrayTemp);
    echo "<$etiqueta $atributos>$contenido";
    if($etiquetaCerrada){
        echo "</$etiqueta>";
    }
}

function sc_dom_crear_elemento_input($type='text',$value='',$id='',$name='',$class='',$style=''){
    $name = (isset($name{1}))?$name:$id;
    sc_dom_crear_elemento_sin_cerrar('input',false,$value,$id,$class,$style,$name,$type);
}

function sc_dom_etiqueta_inicio($etiqueta='',$id='',$class='',$style='',$name=''){
    if(isset($etiqueta{1})){
        $atributos = array('id'=>$id,'class'=>$class,'style'=>$style,'name'=>$name);
        $elemento  = "<$etiqueta ";
        foreach ($atributos as $atributo => $valor){
            $elemento .= ($atributo)? $atributo.'="'.$valor.'" ' : '';
        }
        echo $elemento.">";
        return true;
    }
    return false;
}

function sc_dom_etiqueta_fin($etiqueta){
    if(isset($etiqueta{1})){
        echo "</$etiqueta>";
        return true;
    }
    return false;
}

function sc_dom_cdn($id,$link,$tipo='css',$depurar=false){
    sc_dev_depurar($depurar,array($id,$link,$tipo),'sc_dom_cdn');
    switch ($tipo){
        case 'js':
        case 'javascript':
        case 'script':
            sc_dom_crear_elemento_personalizado('script',null,array('id','src'),array($id,$link));
            break;
        case 'css':
        default:
            sc_dom_crear_elemento_personalizado('link',null,array('id','rel','href'),array($id,'stylesheet',$link),false);
            break;
    }
}

/*URL*/

function sc_url_informacion_sitio_actual(){
    $indicesServer = array('PHP_SELF',
        'argv',
        'argc',
        'GATEWAY_INTERFACE',
        'SERVER_ADDR',
        'SERVER_NAME',
        'SERVER_SOFTWARE',
        'SERVER_PROTOCOL',
        'REQUEST_METHOD',
        'REQUEST_TIME',
        'REQUEST_TIME_FLOAT',
        'QUERY_STRING',
        'DOCUMENT_ROOT',
        'HTTP_ACCEPT',
        'HTTP_ACCEPT_CHARSET',
        'HTTP_ACCEPT_ENCODING',
        'HTTP_ACCEPT_LANGUAGE',
        'HTTP_CONNECTION',
        'HTTP_HOST',
        'HTTP_REFERER',
        'HTTP_USER_AGENT',
        'HTTPS',
        'REMOTE_ADDR',
        'REMOTE_HOST',
        'REMOTE_PORT',
        'REMOTE_USER',
        'REDIRECT_REMOTE_USER',
        'SCRIPT_FILENAME',
        'SERVER_ADMIN',
        'SERVER_PORT',
        'SERVER_SIGNATURE',
        'PATH_TRANSLATED',
        'SCRIPT_NAME',
        'REQUEST_URI',
        'PHP_AUTH_DIGEST',
        'PHP_AUTH_USER',
        'PHP_AUTH_PW',
        'AUTH_TYPE',
        'PATH_INFO',
        'ORIG_PATH_INFO') ;

    echo '<table cellpadding="10">' ;
    foreach ($indicesServer as $arg) {
        if (isset($_SERVER[$arg])) {
            echo '<tr><td>'.$arg.'</td><td>' . $_SERVER[$arg] . '</td></tr>' ;
        }
        else {
            echo '<tr><td>'.$arg.'</td><td>-</td></tr>' ;
        }
    }
    echo '</table>' ;
}

function sc_url_get_url_actual(){
    return $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
}

function sc_url_get_ip_remoto(){
    return $_SERVER['REMOTE_ADDR'];
}

function sc_url_direcciones(){
    return $_SERVER['PHP_SELF'];
}

function sc_url_metodo_get(){
    return $_SERVER['HTTP_GET_VARS'];
}

function sc_url_metodo_post(){
    return $_SERVER['HTTP_POST_VARS'];
}

function sc_url_metodo_cookies(){
    return $_SERVER['HTTP_COOKIE_VARS'];
}

function sc_url_get_servidor($url){
    $url = explode('.',$url);

    if(dev_existe_en_string($url[0],'www')){
        $urlProcesada = $url[1];
    }else{
        $urlProcesada = str_replace('https://','',$url[0]);
        $urlProcesada = str_replace('http://','',$urlProcesada);
    }
    return $urlProcesada;
}

function sc_url_borrar_cookies($depurar=false){
    if (isset($_SERVER['HTTP_COOKIE'])) {
        $cookies = explode(';', $_SERVER['HTTP_COOKIE']);
        foreach($cookies as $cookie) {
            $parts = explode('=', $cookie);
            $name  = trim($parts[0]);
            setcookie($name, '', time()-1000);
            setcookie($name, '', time()-1000, '/');
        }
    }
}

function sc_url_get_id_youtube($urlYoutube){
    $expresionUrl     = sc_str_corregir_expresion_regular('(https?:\/\/)?(www\.)?(youtube\.com\/watch\?v=\w+|youtu\.be\/\w+)');
    $expresionIdVideo = sc_str_corregir_expresion_regular('(((\?v=)\w+)|be\/\w+)');
    return (sc_str_incluye_expresion_regular($urlYoutube,$expresionUrl)) ?
        substr(sc_str_extraer_expresion_regular($urlYoutube, $expresionIdVideo),3) :
        false;
}

function sc_url_generar_iframe_youtube($link,$altura='423',$acho='240',$depurar=false){
    sc_dev_depurar($depurar,array($link,$altura='423',$acho='240'),'sc_url_generar_iframe_youtube');
    $enlace = sc_url_get_id_youtube(sc_str_quitar_espacios_blancos($link));
    if($enlace){
        $altura = sc_str_incluye_expresion_regular($altura,'\d+(\%|px)')?($altura):($altura.'px');
        $acho   = sc_str_incluye_expresion_regular($acho  ,'\d+(\%|px)')?($acho)  :  ($acho.'px');
        echo '
            <iframe width="'.$acho.'" height="'.$altura.'" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen 
                src="https://www.youtube.com/embed/'.$enlace.'">
            </iframe>
        ';
        return true;
    }else{
        return false;
    }
}

/*SQL*/

function sc_sql_lookup($sql){
    //echo $sql;
    global $pdoLibreria;
    $query = $pdoLibreria->prepare($sql);

    try {
        $sqlResult = $query->execute(array());

        if ($sqlResult) {
            $sqlResult = $query->fetchAll();
            return $sqlResult;
        }else{
            return $datos[0][0] = '<p class="alert-danger">No se han hallado datos</p>';
        }
    } catch (Exception $e) {
        return '<p class="alert-danger">No funcionó</p>';
    }
}

function sc_sql_secure_lookup($sql,$array=null,$depurar=false){
    global $pdoLibreria;
    $query = $pdoLibreria->prepare($sql);

    try {
        $sqlResult = $query->execute($array);

        if ($sqlResult) {
            $sqlResult = $query->fetchAll();
            if ($depurar){
                sc_var_dump($sqlResult);
            }
            return count($sqlResult)!=0?$sqlResult:false;
        }else{
            return $datos[0][0] = false;
        }
    } catch (Exception $e) {
        return false;
    }
}

function sc_sql_exec_sql($sql,$array=null){
    global $pdoLibreria;
    $query = $pdoLibreria->prepare($sql);

    try {
        $query->execute($array);
        return true;
    } catch (Exception $exception) {
        echo $exception;
        return false;
    }
}

/*JAVASCRIPT*/

function sc_js_alert($texto){
    echo "<script>alert('" . $texto . "' );</script>";
}

function sc_js_console_log($texto){
    echo "<script>console.log('" . $texto . "' );</script>";
}


/*STRING*/
function sc_str_existe_en_string($texto,$busqueda){
    return (strpos($texto,$busqueda) !== false);
}

function sc_str_quitar_espacios_y_lower($texto){
    return strtolower(preg_replace('/(\n|\r|\t|\s)/','',$texto));
}

function sc_str_resaltar_texto($t,$busqueda,$class=null){
    return (isset($t{1}) && isset($busqueda{1}))?str_replace($busqueda,"<b class='$class'>$busqueda</b>",$t):false;
}

function sc_str_generar_enlaces_html_de_string($texto){
    return sc_str_reemplazar_expresion_regular(
        $texto,
        '#((https?|ftp)://(\S*?\.\S*?))([\s)\[\]{},;"\':<]|\.\s|$)#i',
        "'<a href=\"$1\" target=\"_blank\">$3</a>$4'"
    );
}

function sc_str_reemplazar_expresion_regular($t,$expresion,$reemplazo,$depurar){
    $expresion = sc_str_corregir_expresion_regular($expresion);
    sc_dev_depurar($depurar,"t : $t expresion : $expresion reemplazo : $reemplazo ",'sc_str_reemplazar_expresion_regular');
    return preg_replace(
        $expresion,
        $reemplazo,
        $t
    );
}

function sc_str_incluye_expresion_regular($t,$expresion,$depurar=false){
    $expresion = sc_str_corregir_expresion_regular($expresion);
    sc_dev_depurar($depurar,array($t,$expresion),'sc_str_incluye_expresion_regular');
    return preg_match($expresion,$t);
}

function sc_str_corregir_expresion_regular($expresion,$depurar=false){
    sc_dev_depurar($depurar,array($expresion),'sc_str_corregir_expresion_regular');
    return (sc_str_inicia_con($expresion,'/') && sc_str_finaliza_con($expresion,'/')) ?
        $expresion :
        '/'.$expresion.'/';
}

function sc_str_extraer_expresion_regular($t,$expresion,$depurar=false){
    sc_dev_depurar($depurar,$expresion,'sc_str_extraer_expresion_regular');
    $expresion     = sc_str_corregir_expresion_regular($expresion);
    $coincidencias = false;

    if(sc_str_incluye_expresion_regular($t,$expresion)){
        preg_match($expresion,$t,$coincidencias,PREG_OFFSET_CAPTURE);
        $coincidencias = ($coincidencias[0][0]) ?
            $coincidencias[0][0]:
            false;
    }
    return $coincidencias;
}

function sc_str_inicia_con($t,$busqueda){
    return (strpos($t, $busqueda) === 0);
}

function sc_str_finaliza_con($t,$busqueda){
    $cantidadCaracteres = strlen ($busqueda);
    return ($cantidadCaracteres && substr($t, -$cantidadCaracteres) == $busqueda);
}

function sc_str_quitar_espacios_extra($t,$depurar=false){
    sc_dev_depurar($depurar,$t);
    return trim(sc_str_reemplazar_expresion_regular($t,'/(\n|\s)+/',' '));
}

function sc_str_quitar_espacios_blancos($t,$depurar=false){
    sc_dev_depurar($depurar,$t);
    return trim(sc_str_reemplazar_expresion_regular($t,'(\n|\s|\t|\r)+',''));
}

/*FECHAS*/
function sc_fec_formatear($fecha,$formato='Y-m-d H:i:s',$depurar=false){
    sc_dev_depurar($depurar,array($fecha,$formato),'sc_fec_formatear');
    return date($formato, strtotime($fecha));
}


/*ARRAY*/
function sc_arr_incluye_expresion_regular($array,$expresion,$depurar=false){
    sc_dev_depurar($depurar,array($array,$expresion),'sc_arr_incluye_expresion_regular');

    if (is_array($array) && isset($expresion{1})){
        $expresion = sc_str_corregir_expresion_regular($expresion);
        foreach ($array as $valor){
            if (sc_str_incluye_expresion_regular($valor,$expresion)){
                return true;
            }
        }
    }

    return false;
}

?>

