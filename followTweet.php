<?php
require("TwitterAPIExchange.php");
  class followTweet{
    public function publicarTweet(){
        $settings = array(
            'oauth_access_token' =>$btok,
            'oauth_access_token_secret' =>$bsec,
            'consumer_key' =>"mkzhlnnGNoZFgG1M7vI6WIqTX",
            'consumer_secret' =>"wI5aubrVcUVFANQfRMbbqhI1KZvo1WGAlBwOUIHMo0YIE8m7MO"
        );
        //Metodo get para coger las cosas
        //REcurso de API que queremos consultar
        //El url lo sacamos en funcion de lo que queremos usar 
        //Mas tarde la variable asociativa status
        $url = 'https://api.twitter.com/1.1/statuses/update.json';
        $postdata = array('status'=>"¡Esta es mi nueva apariencia gracias a www.camuflame.es!");
        $requestMethod = 'POST';
        $twitter = new TwitterAPIExchange($settings);
        echo $twitter->setPostfields($postdata)
                     ->buildOauth($url, $requestMethod)
                     ->performRequest();
    }

    public function follow($usuario){
        ini_set('display_errors', 1);
        require_once('TwitterAPIExchange.php');
        $settings = array(
           'oauth_access_token' => $btok,
           'oauth_access_token_secret' => $bsec,
           'consumer_key' => "mkzhlnnGNoZFgG1M7vI6WIqTX",
           'consumer_secret' => "wI5aubrVcUVFANQfRMbbqhI1KZvo1WGAlBwOUIHMo0YIE8m7MO"
        );
        $url = 'https://api.twitter.com/1.1/friendships/create.json';
        $requestMethod = 'POST';
        $postfields = array('screen_name' => $usuario,'follow' => "true" );
        $twitter = new TwitterAPIExchange($settings);
        return $twitter->buildOauth($url, $requestMethod)->setPostfields($postfields)->performRequest();
    }
  }
?>	 