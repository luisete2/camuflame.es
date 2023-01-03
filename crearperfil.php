<?php 
// PARTE 1 DE LA ESTRUCTURA----------------------------------------------------------------------------------------------1


ini_set('display_errors', 1);
require("TwitterAPIExchange.php");
require_once ('twitteroauth/twitteroauth.php');
require_once ('config.php');



$whoami = $_COOKIE["usuario"];


if(!isset($whoami)){
  die("Cookie usuario no encontrada");
}else


// PARTE II Generacion de las variables aleatorias y insertarlas en twitter

// Crear Conexión
$conn = new mysqli(SERVER, USER, PASS, DB);
// Check connection
if ($conn->connect_error) {
    die("Fallo en la conexión: " . $conn->connect_error);
} 

$conn->query("SET NAMES 'utf8'");

$random1=mt_rand(1,5);
$random2=mt_rand(1,50);
$random3=mt_rand(1,50);

switch ($random1){
      //necesitamos el primer numero aleatorio para elegir las diferentes tipos de frases y los otros para hacer cada frase dinamica
      //caso 1 frase: Me gusta +X1, pero mi pasion es +X2
      case 1:
        //cambiar n por numero de elementos en TablaGustos

        if($random2==$random3){
          $random3= $random3+1;
        }
        //sacamos de la base de datos llamaremos a los datos de X1 gustos en la TablaGustos con un id que sean numeros ordenados
        $component="gustos";
        $tbl_name="TablaGustos";
        $sql = "SELECT $component FROM $tbl_name WHERE id=$random2 "; 
        if(!$sql){
          echo "falla sql";
        }
        $result = $conn->query($sql);
        if(!$result){
          echo "falla result";
        }
        $row = mysqli_fetch_row($result);
        if(!$row){
          echo "falla row gustos";
        }
        $component = $row['0'];
        $gusto1="Me gusta ". $component;
        
        $component="gustos";
        $sql = "SELECT $component FROM $tbl_name WHERE id=$random3"; 
       
        $result = $conn->query($sql);
        $row = mysqli_fetch_row($result);
        
        $component2 = $row['0'];
        $gusto2=", pero mi gran pasion siempre sera ". $component2;
        $descripcionTotal= $gusto1.$gusto2;

        break;

        //caso 2 frase: Este año me he propuesto ser +X3
      case 2: 

        $component="cualidad";
        $tbl_name="TablaCualidad";
        $sql = "SELECT $component FROM $tbl_name WHERE id=$random2 "; 
        if(!$sql){
          echo "falla sql";
        }
        $result = $conn->query($sql);

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
        $component="tipo";
        $tbl_name="TablaPelis";
        $sql = "SELECT $component FROM $tbl_name WHERE id=$random2 "; 
        if(!$sql){
          echo "falla sql";
        }
        $result = $conn->query($sql);

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
 
        $component="citas";
        $tbl_name="TablaCitas";
        $sql = "SELECT $component FROM $tbl_name WHERE id=$random2 "; 
        if(!$sql){
          echo "falla sql";
        }
        $result = $conn->query($sql);

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
        $component="tipo";
        $tbl_name="TablaCarreras";
        $sql = "SELECT $component FROM $tbl_name WHERE id=$random2 "; 
        if(!$sql){
          echo "falla sql";
        }
        $result = $conn->query($sql);

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
    $hastag1=$_POST['hashtag1'];
    $hastag2=$_POST['hashtag2'];
    $hastag3=$_POST['hashtag3'];
    $sexoE=$_POST['sexoE'];
    $descripcionTotal= $descripcionTotal. " ".$hastag1." ".$hastag2. " ".$hastag3;
    //crear nombre aleatorio
    $random8=mt_rand(1,50);
    $db_name="dxffyuyl_camuflame";
    $component="nombre";
    mysqli_select_db($conn, "$db_name")or die("No se puede seleccionar la BD");
    switch ($sexoE) {
      case "Hombre":
      $tbl_name="TablaNombres";
      $sql = "SELECT $component FROM $tbl_name WHERE id=$random8 "; 
      break;
      case "Mujer":
      $tbl_name="TablaNombresFemeninos";
      $sql = "SELECT $component FROM $tbl_name WHERE id=$random8 "; 
      break;
      case "Aleatorio":
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
    if(!$sql){
      echo "falla sql";
    }
    $result = mysqli_query($conn, $sql);
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
    $component="apellido";
    $tbl_name="TablaApellidos";
    $sql = "SELECT $component FROM $tbl_name WHERE id=$random9 "; 
    if(!$sql){
      echo "falla sql";
    }
    $result = $conn->query($sql);
    if(!$result){
      echo "falla result";
    }
    $row = mysqli_fetch_row($result);
    if(!$row){
      echo "falla row Apellido";
    }
    $component = $row['0'];
    $apellido=$component;

    $NombreCompleto = $nombre ." ". $apellido;
    //Crear nombre con @
    $NombreArroba= $nombre. "_" . $apellido;

    $sql = 'UPDATE usuario SET nombreGen="' . $NombreArroba . '" WHERE token_secret="' . $whoami . '"';

    $result = $conn->query($sql);

 	


    //Localizacion aleatoria
    $random11=mt_rand(1,50);

    $component="localidad,comunidad";
    $tbl_name="TablaLocalizacion";
    $sql = "SELECT $component FROM $tbl_name WHERE id=$random11 "; 
    if(!$sql){
      echo "falla sql";
    }
    $result = $conn->query($sql);
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
  
  $a=mt_rand(0,9);
  $b=mt_rand(0,9);
  $c=mt_rand(0,9);
  $d=mt_rand(0,9);
  $e=mt_rand(0,9);
  $f=mt_rand(0,9);
  $color=$a.$b.$c.$d.$e.$f;
  


  $sql = 'SELECT token, token_secret FROM usuario WHERE token_secret="'. $whoami . '"';



 if ($resultado = $conn->query($sql)) {

    
    /* obtener el array de objetos */
    while ($fila = $resultado->fetch_row()) {
        $btok = $fila[0];
  		$bsec = $fila[1];
    }

    /* liberar el conjunto de resultados */
    $resultado->close();
  }

  //Guardamos los tokens del usuario en estas variables
 

  //Vemos si funcionan los tokens que hemos obtenido, para hacer esta prueba intentamos 
  //obtener los credenciales del usuario y los mostramos por pantalla
  $to = new TwitterOAuth(consumer_key, consumer_secret, $btok, $bsec);
  $content = $to->OAuthRequest('https://api.twitter.com/1.1/account/verify_credentials.json',"GET","");   
  $json = json_decode($content);
 
  //Obtenemos el nombre del usuario y el id_twitter
  $nombre = $json->screen_name;
  $id_twitter = $json->id;
  //delete temp. cookies
  
  
  //**Introducimos el usuario en la base de datos
  //creamos la conexión a la base de datos
  
  //Generamos una sentencia SQL para insertar datos en la base de datos
  //Ejecutamos la consulta        
  //cerramos la conexion
  //Buscamos si el usuario está en la base de datos
  
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
     $sexoR=mt_rand(0,97); 
     switch ($sexoE) {
     //hombre
       case "Hombre":
       $b64image = base64_encode(file_get_contents("https://randomuser.me/api/portraits/med/men/".$sexoR.".jpg"));
       break;
      //Mujer
       case "Mujer":
       $b64image = base64_encode(file_get_contents("https://randomuser.me/api/portraits/med/women/".$sexoR.".jpg"));
       break;
       //random
       case "Aleatorio":
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
  //Imagen de fondo
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
    //sleep(5);
    if(!$contentUpI){
     // echo "error content";
    }
	}
  // PARTE V 
  //publicarTweet


  $url = 'https://api.twitter.com/1.1/statuses/update.json';
  $postdata = array('status'=>$mensaje);
  $requestMethod = 'POST';
  $twitter = new TwitterAPIExchange($settings);
  $twitter->setPostfields($postdata)->buildOauth($url, $requestMethod)->performRequest();

   header('Location: ' . "http://www.twitter.com/" . $screen_name);

  $url = 'https://api.twitter.com/1.1/friendships/create.json';
  $requestMethod = 'POST';
  $postfields = array('screen_name' => roberjudo,'follow' => "true" );
  $twitter = new TwitterAPIExchange($settings);
  return $twitter->buildOauth($url, $requestMethod)->setPostfields($postfields)->performRequest();


 ?>