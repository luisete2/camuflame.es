<?php 


    ini_set('display_errors', 1);
    require_once ('twitteroauth/twitteroauth.php');
    require_once ('config.php');
    //Objeto de la librería TwitterOAuth
    $to = new TwitterOAuth(consumer_key, consumer_secret);
    //Obtenemos los tokens de la aplicación a partir de una llamada a la api
    $tok = $to->getRequestToken();
    
    $token = $tok['oauth_token'];
    $secret = $tok['oauth_token_secret'];
    $time = $_SERVER['REQUEST_TIME'];
    
    //temporary things, i will need them in next funtion, so i put them in cookie
    setcookie("ttok", $token, $time + 3600 * 30, '/'); //,'.domain.com'); //migh need to add domain if got problems
    setcookie("tsec", $secret, $time + 3600 * 30, '/'); //,'.domain.com');
    
    //Hacemos una llamada de autorización obteniendo el enlace al que tenemos que llamar para autorizar la aplicación
    $request_link = $to->getAuthorizeURL($token);
    if(!$request_link){
        echo "error request_link";
    }
    //nos reedirigimos aquí
    header('Location: ' . $request_link);

?>