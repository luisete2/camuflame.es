<?php
    
    require_once ('twitteroauth/twitteroauth.php');
    require_once ('config.php');


    $oauth_token = $_GET['oauth_token'];

    if(!isset($_COOKIE['ttok'])) {
    die('No tenemos la cookie que hemos generado en login.php');
    }
    $ttok = $_COOKIE['ttok'];
    $tsec = $_COOKIE['tsec']; 

    $to = new TwitterOAuth(consumer_key, consumer_secret, $ttok, $tsec);

    $tok = $to->getAccessToken($_GET['oauth_verifier']);
    if(!isset($tok['oauth_token'])) {
    die('try again!');
    }

    $btok = $tok['oauth_token'];
    $bsec = $tok['oauth_token_secret'];

    $to = new TwitterOAuth(consumer_key, consumer_secret, $btok, $bsec);
    $content = $to->OAuthRequest('https://api.twitter.com/1.1/account/verify_credentials.json',"GET",""); 
    if(!isset($content)){
        die("oauth request error");
    }

    $json = json_decode($content);
    //Obtenemos el nombre del usuario y el id_twitter
    $nombre = $json->screen_name;
    $id_twitter = $json->id;

  

    if(!isset($id_twitter)){
        die("Error fatal");
    }
    
   
    //delete temp. cookies
    setcookie("ttok", '', 0, '/');
    setcookie("tsec", '', 0, '/');
    
    $time = $_SERVER['REQUEST_TIME'];
    $domain = ($_SERVER['HTTP_HOST'] != 'localhost') ? $_SERVER['HTTP_HOST'] : false;

    If(!setcookie("usuario",$bsec,$time + 3600 * 30, '/', $domain, false))
    {
        echo "Fallo cooki";
    }

    $conn = new mysqli(SERVER, USER, PASS, DB);
    $NombreArroba = "prueba";


    $sql1 = "SELECT * FROM usuario WHERE token_secret='$bsec'";
    $result = $conn->query($sql1) or die(mysqli_error());

    $row = mysqli_fetch_row($result);
   

    
    if(is_null($row)){

        $sql = "insert into usuario (id_twitter,nombre,token,token_secret,nombreGen) 
        values (".$id_twitter.",'".$nombre."','".$btok."','".$bsec."','".$NombreArroba."');";
        $result = $conn->query($sql) or die(mysql_error());

    }else
    {


        //Comparamos los datos del array con los datos recogidos de twitter para ver si ahy algún cambio
        //Y si lo hay actualizamos la fila correspondiente
        if($row[1] != $nombre or $row[2]!=$btok or $row[3] != $bsec or $row[4] != $nombreGen){
        
         $result = $conn->query("UPDATE usuario SET nombre='$nombre', token='$btok', token_secret='$bsec',nombreGen='$NombreArroba' WHERE token_secret='$bsec'") 
        or die(mysql_error());
        }
    }

   header('Location: http://www.camuflame.es/callback.html');


?>