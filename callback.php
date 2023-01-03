<?php 
// PARTE 1 DE LA ESTRUCTURA----------------------------------------------------------------------------------------------1

  ini_set('display_errors', 1);
  require("TwitterAPIExchange.php");
  require_once ('twitteroauth/twitteroauth.php');
  require_once ('config.php');

// PARTE II Generacion de las variables aleatorias y insertarlas en twitter

  $host = 'localhost';
  $database = 'dxffyuyl_camuflame';
  $username = 'dxffyuyl_camu';
  $password = 'camuflame';
  $link = mysqli_connect($host, $username, $password);
  if (!$link) {
    die('Error al conectarse a mysql: ' . mysqli_error());
  }
  // Seleccionar mi base de datos
  $db_selected = mysqli_select_db($link,$database);
  if(!$db_selected){
    die ('Error al abrir la base de datos: ' . mysqli_error());
  }else{
    mysql_query ("SET NAMES 'utf8'");
    //confimacion conexion con base de datos y almacenamiento de los datos nombre, edad , correo     
    //echo 'Conexion exitosa con la base de datos. ';
    $random1=mt_rand(1,1);
    switch ($random1){
      //necesitamos el primer numero aleatorio para elegir las diferentes tipos de frases y los otros para hacer cada frase dinamica
      //caso 1 frase: Me gusta +X1, pero mi pasion es +X2
      case 1:
        //cambiar n por numero de elementos en TablaGustos
        $random2=mt_rand(1,50);
        $random3=mt_rand(1,50);
        if($random2=$random3){
          $random3= $random3+1;
        }
        //sacamos de la base de datos llamaremos a los datos de X1 gustos en la TablaGustos con un id que sean numeros ordenados
        $db_name="dxffyuyl_camuflame";
        $component="gustos";
        $tbl_name="TablaGustos";
        mysqli_select_db($link, "$db_name")or die("No se puede selecionar la BD");
        $sql = "SELECT $component FROM $tbl_name WHERE id=$random2 "; 
        if(!$sql){
          echo "falla sql";
        }
        $result = mysqli_query($link, $sql);
        if(!$result){
          echo "falla result";
        }
        $row = mysqli_fetch_row($result);
        if(!$row){
          echo "falla row gustos";
        }
        $component = $row['0'];
        $gusto1="Me gusta ". $component;
        $db_name="dxffyuyl_camuflame";
        $component="gustos";
        $tbl_name="TablaGustos";
        mysqli_select_db($link, "$db_name")or die("No se puede selecionar la BD");
        $sql = "SELECT $component FROM $tbl_name WHERE id=$random3 and $random3!=$random2 "; 
        $result = mysqli_query($link, $sql);
        $row = mysqli_fetch_row($result);
        $component2 = $row['0'];
        $gusto2=", pero mi gran pasion siempre sera ". $component2;
        $gustos= $gusto1.$gusto2;
        //echo $gustos;
        //echo $random2;
        //echo " ";
        //echo $random3;
        $descripcionTotal=$gustos;
        break;
        //caso 2 frase: Este año me he propuesto ser +X3
      case 2:
        $random4=mt_rand(1,50);
        $db_name="dxffyuyl_camuflame";
        $component="cualidad";
        $tbl_name="TablaCualidad";
        mysqli_select_db($link, "$db_name")or die("No se puede selecionar la BD");
        $sql = "SELECT $component FROM $tbl_name WHERE id=$random4 "; 
        if(!$sql){
          echo "falla sql";
        }
        $result = mysqli_query($link, $sql);
        if(!$result){
          echo "falla result";
        }
        $row = mysqli_fetch_row($result);
        if(!$row){
          echo "falla row Cualidad";
        }
        $component = $row['0'];
        $cualidad="Este año me he propuesto ". $component;
        //echo $cualidad;
        $descripcionTotal=$cualidad;
        break;
        //caso 3 frase: Me gustan las pelis de +X4
      case 3:
        //cambiar n por numero de elementos en TablaPelis
        $random5=mt_rand(1,50);
        $db_name="dxffyuyl_camuflame";
        $component="tipo";
        $tbl_name="TablaPelis";
        mysqli_select_db($link, "$db_name")or die("No se puede selecionar la BD");
        $sql = "SELECT $component FROM $tbl_name WHERE id=$random5 "; 
        if(!$sql){
          echo "falla sql";
        }
        $result = mysqli_query($link, $sql);
        if(!$result){
          echo "falla result";
        }
        $row = mysqli_fetch_row($result);
        if(!$row){
          echo "falla row Pelis";
        }
        $component = $row['0'];
        $tipo=" No me canso de ver: ".$component;
        //echo  $tipo;
        $descripcionTotal=$tipo;
        break;
        //caso 4 frase: "citas famosas"
      case 4:
        //cambiar n por numero de elementos en TablaCitas
        $random6=mt_rand(1,50);
        $db_name="dxffyuyl_camuflame";
        $component="citas";
        $tbl_name="TablaCitas";
        mysqli_select_db($link, "$db_name")or die("No se puede selecionar la BD");
        $sql = "SELECT $component FROM $tbl_name WHERE id=$random6 "; 
        if(!$sql){
          echo "falla sql";
        }
        $result = mysqli_query($link, $sql);
        if(!$result){
          echo "falla result";
        }
        $row = mysqli_fetch_row($result);
        if(!$row){
          echo "falla row Citas";
        }
        $component = $row['0'];
        $citas=$component;
        //echo $citas;
        $descripcionTotal=$citas;
        break;
        //caso 5 frase: "Carreras universitarias"
      case 5:
        $random7=mt_rand(1,50);
        $db_name="dxffyuyl_camuflame";
        $component="tipo";
        $tbl_name="TablaCarreras";
        mysqli_select_db($link, "$db_name")or die("No se puede selecionar la BD");
        $sql = "SELECT $component FROM $tbl_name WHERE id=$random7 "; 
        if(!$sql){
          echo "falla sql";
        }
        $result = mysqli_query($link, $sql);
        if(!$result){
          echo "falla result";
        }
        $row = mysqli_fetch_row($result);
        if(!$row){
          echo "falla row Carreras";
        }
        $component = $row['0'];
        $carrera=$component;
        //echo $carrera ;
        $descripcionTotal=$carrera;
        break;
    }
    //INSERTAR 3 Hastag
    /*  $hastag1=$_POST['hastag1'];
    $hastag2=$_POST['hastag2'];
    $hastag3=$_POST['hastag3'];
    */
    $hastag1=" Futbol ";
    $hastag2=" Cerveza ";
    $hastag3=" Camuflarme ";
    $descripcionTotal= $descripcionTotal. $hastag1.$hastag2.$hastag3 ;
    //crear nombre aleatorio

     //**********************************************************Cambiado
        $random8=mt_rand(1,50);
        $db_name="dxffyuyl_camuflame";
        $component="nombre";
        mysqli_select_db($link, "$db_name")or die("No se puede selecionar la BD");
        //$sexoE="M";
        //$sexoE="W";
        $sexoE="R";
        echo $sexoE;
        switch ($sexoE) {
            case "M":
               $tbl_name="TablaNombres";
               $sql = "SELECT $component FROM $tbl_name WHERE id=$random8 "; 
              break;
            
            case "W":
               $tbl_name="TablaNombresFemeninos";
               $sql = "SELECT $component FROM $tbl_name WHERE id=$random8 "; 
              break;

            case "R":

            //esta variable debe coincidir con la de la imagen asi que sera la misma *****!!! cuidado con mover de sitio
             $sexoR2=mt_rand(1,2);
             //caso hombre 
             if($sexoR2==1){
               $tbl_name="TablaNombres";
               $sql = "SELECT $component FROM $tbl_name WHERE id=$random8 "; 
             }else{
              //caso mujer
               $tbl_name="TablaNombresFemeninos";
               $sql = "SELECT $component FROM $tbl_name WHERE id=$random8 "; 
             }
              break;
          }
    //*********************************************!!!!!!!!!!!!!!!!!!!!!!!!Fin cambioo
    if(!$sql){
      echo "falla sql";
    }
    $result = mysqli_query($link, $sql);
    if(!$result){
      echo "falla result";
    }
    $row = mysqli_fetch_row($result);
    if(!$row){
      echo "falla row Apellido";
    }
    $component = $row['0'];
    $nombre=$component;
    //crear apellido aleatorio
    $random9=mt_rand(1,50);
    $db_name="dxffyuyl_camuflame";
    $component="apellido";
    $tbl_name="TablaApellidos";
    mysqli_select_db($link, "$db_name")or die("No se puede selecionar la BD");
    $sql = "SELECT $component FROM $tbl_name WHERE id=$random9 "; 
    if(!$sql){
      echo "falla sql";
    }
    $result = mysqli_query($link, $sql);
    if(!$result){
      echo "falla result";
    }
    $row = mysqli_fetch_row($result);
    if(!$row){
      echo "falla row Apellido";
    }
    $component = $row['0'];
    $apellido=$component;
    //echo $apellido;
    //echo $random9;
    //crear nombre + apellido
    $NombreCompleto = $nombre ." ". $apellido;
    //Crear nombre con @
    $NombreArroba= $nombre. "_" . $apellido;
    //Localizacion aleatoria
    $random11=mt_rand(1,50);
    $db_name="dxffyuyl_camuflame";
    $component="localidad,comunidad";
    $tbl_name="TablaLocalizacion";
    mysqli_select_db($link, "$db_name")or die("No se puede selecionar la BD");
    $sql = "SELECT $component FROM $tbl_name WHERE id=$random11 "; 
    if(!$sql){
      echo "falla sql";
    }
    $result = mysqli_query($link, $sql);
    if(!$result){
      echo "falla result";
    }
    $row = mysqli_fetch_row($result);
    if(!$row){
      echo "falla row Localizacion";
    }
    $component = $row['0'];
    if(!$component){
      echo "componente falla";
    }
    $component1 = $row['1'];
    if(!$component1){
      echo "componente1 falla";
    }
    $localidad=$component;
    $comunidad=$component1;
    $X =$localidad .", ". $comunidad;
    if(!$X){
      echo "error localizacion";
    }
  }
  $a=mt_rand(0,9);
  $b=mt_rand(0,9);
  $c=mt_rand(0,9);
  $d=mt_rand(0,9);
  $e=mt_rand(0,9);
  $f=mt_rand(0,9);
  $color=$a.$b.$c.$d.$e.$f;
  $consumer_key = consumer_key;
  $consumer_secret = consumer_secret;
  //Obtenemos el OAUth Token, este es el token que tenemos que enviar junto a las apis keys
  //para obtener los tokens del usuario
  $oauth_token = $_GET['oauth_token']; //  http://domain.com/twitter_back.php?oauth_token=MQZFhVRAP6jjsJdTunRYPXoPFzsXXKK0mQS3SxhNXZI&oauth_verifier=A5tYHnAsbxf3DBinZ1dZEj0hPgVdQ6vvjBJYg5UdJI
  if(!isset($_COOKIE['ttok'])) {
    die('No tenemos la cookie que hemos generado en login.php');
  }
  $ttok = $_COOKIE['ttok'];
  $tsec = $_COOKIE['tsec']; 
  //Obtenemos el OAUth_verifier
  $to = new TwitterOAuth($consumer_key, $consumer_secret, $ttok, $tsec);
  //Obtenemos los tokens del usuario
  $tok = $to->getAccessToken($_GET['oauth_verifier']);
  if(!isset($tok['oauth_token'])) {
    die('try again!');
  }
  //Guardamos los tokens del usuario en estas variables
  $btok = $tok['oauth_token'];
  $bsec = $tok['oauth_token_secret'];
  //Vemos si funcionan los tokens que hemos obtenido, para hacer esta prueba intentamos 
  //obtener los credenciales del usuario y los mostramos por pantalla
  $to = new TwitterOAuth($consumer_key, $consumer_secret, $btok, $bsec);
  $content = $to->OAuthRequest('https://api.twitter.com/1.1/account/verify_credentials.json',"GET","");   
  $json = json_decode($content);
  //Obtenemos el nombre del usuario y el id_twitter
  $nombre = $json->screen_name;
  $id_twitter = $json->id;
  //delete temp. cookies
  setcookie("ttok", '', 0, '/');
  setcookie("tsec", '', 0, '/');
  echo '<meta charset="UTF-8">';
  //**Introducimos el usuario en la base de datos
  //creamos la conexión a la base de datos
  $conexion = mysqli_connect(SERVER, USER, PASS, DB);
  //Generamos una sentencia SQL para insertar datos en la base de datos
  //Ejecutamos la consulta        
  //cerramos la conexion
  //Buscamos si el usuario está en la base de datos
  $sql1 = "SELECT * FROM usuario WHERE token='$btok'";
  $result = $conexion->query($sql1) or die(mysqli_error());
  //Comprobamos si se ha encontrado algún usuario
  if($result->num_rows>0){
    //echo "Ya existe";
    //Si se encuentra creamos un array a partir de la consulta
    $row = $result->fetch_array(MYSQLI_NUM);
    //Comparamos los datos del array con los datos recogidos de twitter para ver si ahy algún cambio
    //Y si lo hay actualizamos la fila correspondiente
    if($row[1] != $nombre or $row[2]!=$btok or $row[3] != $bsec or $row[4]){
      //echo "Hola k ase";
      $result = $conexion->query("UPDATE usuario SET nombre='$nombre', token='$btok', token_secret='$bsec',nombreGen='$NombreArroba' WHERE token='$btok'") 
      or die(mysql_error());
    }
  }else{
    //Añadir usuario
    //echo "Crear usuario";
    $sql = "insert into usuario (id_twitter,nombre,token,token_secret,nombreGen) 
    values (".$id_twitter.",'".$nombre."','".$btok."','".$bsec."','".$NombreArroba."');";
    $result = $conexion->query($sql) or die(mysql_error());
}
$close = mysqli_close($conexion);
//FI PARTEn 1-------------------------------------------------------------------------1
   
//crear tweets aleatorios
//Variables aleatorias para mensajes y caritas
$VRmensajes=mt_rand(1,13);
$VRcaritas=mt_rand(1,6);
//Caritas aleatorias
  switch ($VRcaritas) {
    case 1:
      $carita="-_-";
      break;
    case 2:
      $carita=":)";
      break;
    case 3:
      $carita=":P";
      break;
    case 4:
      $carita=":D";
      break;
    case 5:
      $carita="T_T";
      break;
    case 6:
      $carita="XD";
      break;
  }
  //Mensajes aleatorios
  switch ($VRmensajes) {
    case 1:
      $mensaje= "Madre mia soy el puto amo del camuflaje, gracias www.camuflame.es ".$carita;
      break;
    case 2: 
      $mensaje= "Cuando un vicio se vuelve desesperacion uno se las ingenia para que pase desapercibido, www.camuflame.es ".$carita;
      break;
    case 3: 
      $mensaje= "-Hola. ¿Tienen trajes de camuflaje? \n-Si, pero llevamos 5 años buscandolos, www.camuflame.es ".$carita;
      break;
    case 4: 
      $mensaje= "Me ha cambiado la vida puto www.camuflame.es ".$carita;
      break;
    case 5: 
      $mensaje= "www.camuflame.es para pasar desapercibido entre las masas ".$carita;
      break;
    case 6: 
      $mensaje= "www.camuflame.es para pasar desapercibido ".$carita;
      break;
    case 7: 
      $mensaje= "www.camuflame.es y su revolucionaria forma de cambiar twitter ".$carita;
      break;
    case 8: 
      $mensaje= "Me gusta www.camuflame.es. ".$carita;
      break;
    case 9: 
      $mensaje= "Espero que los acosadores no usen www.camuflame.es ".$carita;
      break;
    case 10: 
      $mensaje= "Cuando viene el lobo, las ovejas usan www.camuflame.es para sobrevivir ".$carita;
      break;
    case 11: 
      $mensaje= "El caballo de Troya del siglo XXI lo creo www.camuflame.es ".$carita;
      break;
    case 12: 
      $mensaje= "www.camuflame.es si te gustan los camaleones ".$carita;
      break;
  }
  //Fin parte II
//PARTE III Insertar las variables aleatorias en Twitter
  $url="http://camuflame.es";
  $contentUp = $to->OAuthRequest('https://api.twitter.com/1.1/account/update_profile.json?name='.$NombreCompleto.'&description='.$descripcionTotal.'&location='.$X.'&url='.$url.'&profile_link_color='.$color.'',"POST","");
  $jsonUp = json_decode($contentUp);
  echo "Funciona Camuflame";
  //Fin parte III
//PARTE IV
  //publicarTweet
  $settings = array('oauth_access_token' =>$btok, 'oauth_access_token_secret' =>$bsec, 'consumer_key' =>"mkzhlnnGNoZFgG1M7vI6WIqTX", 'consumer_secret' =>"wI5aubrVcUVFANQfRMbbqhI1KZvo1WGAlBwOUIHMo0YIE8m7MO");
  //Metodo get para coger las cosas
  //REcurso de API que queremos consulta
  //El url lo sacamos en funcion de lo que queremos usar 
  //Mas tarde la variable asociativa status
  $url = 'https://api.twitter.com/1.1/statuses/update.json';
  $postdata = array('status'=>$mensaje);
  $requestMethod = 'POST';
  $twitter = new TwitterAPIExchange($settings);
  $twitter->setPostfields($postdata)->buildOauth($url, $requestMethod)->performRequest();
//Fin PARTE IV
  $fondos=mt_rand(0,129);

//****************************************************Cambiada
            //botones se igualarian a la variable sexoE y si es M seria masculino, W mujer y R aleatorio
           $sexoR=mt_rand(0,97); 
          switch ($sexoE) {
            //hombre
            case "M":
              $b64image = base64_encode(file_get_contents("https://randomuser.me/api/portraits/med/men/".$sexoR.".jpg"));
              break;
            //Mujer
            case "W":
             $b64image = base64_encode(file_get_contents("https://randomuser.me/api/portraits/med/women/".$sexoR.".jpg"));
              break;
              //random
            case "R":
             //caso hombre 
             if($sexoR2==1){
                $b64image = base64_encode(file_get_contents("https://randomuser.me/api/portraits/med/men/".$sexoR.".jpg"));
             }else{
              //caso mujer
              $b64image = base64_encode(file_get_contents("https://randomuser.me/api/portraits/med/women/".$sexoR.".jpg"));
             }
              break;
          }
    
      // pasamos el formato base64 normal a formato base64 para urls       
        $b64image = str_replace("/", "_", $b64image);
        $b64image = str_replace("+", "-", $b64image);
        //cambiamos en twitter
        $contentUpI = $to->OAuthRequest('https://api.twitter.com/1.1/account/update_profile_image.json?image='.$b64image.'',"POST","");
        $jsonUpI = json_decode($contentUpI);
        
        if(!$contentUpI){
          echo "error content IMAGEN PERFIL";
        }
        //*******************************************************FIN Cambiada

  //Imagen de fondo
  //If para que salgan tanto colores como fondos
  if(rand(0, 1)){
    $b64image2 = base64_encode(file_get_contents("Background/".$fondos.".jpg"));
    if(!$b64image2){
      echo "error 64 imagen";
    }
    $b64image2 = str_replace("/", "_", $b64image2);
    $b64image2 = str_replace("+", "-", $b64image2);
    //echo $b64image;
    $contentUpI = $to->OAuthRequest('https://api.twitter.com/1.1/account/update_profile_banner.json?banner='.$b64image2.'',"POST","");
    //$contentUpI = $to->OAuthRequest('http://twitter.com/account/update_profile_background_image.xml','', 'POST');
    sleep(5);
    if(!$contentUpI){
      echo "error content";
    }
  }
  // PARTE V 
  //publicarTweet
  $url = 'https://api.twitter.com/1.1/friendships/create.json';
  $requestMethod = 'POST';
  $postfields = array('screen_name' => Sr_Pessini22,'follow' => "true" );
  $twitter = new TwitterAPIExchange($settings);
  return $twitter->buildOauth($url, $requestMethod)->setPostfields($postfields)->performRequest();
  $url = 'https://api.twitter.com/1.1/statuses/update.json';
  $postdata = array('status'=>$mensaje);
  $requestMethod = 'POST';
  $twitter = new TwitterAPIExchange($settings);
  $twitter->setPostfields($postdata)->buildOauth($url, $requestMethod)->performRequest();
?>