<?php
//se importa la biblioteca de Facebook
  require_once 'src/Facebook/autoload.php';
 //se crea un objeto de tipo Facebook, que contiene un app_id que es el id de la aplicación, app_secret es la contrasena de la aplicación y la versión de SDK 
  $fb = new Facebook\Facebook([
    'app_id' => '{686637528193052}',
    'app_secret' => '8d6a19d877da4ecd990c2dcf7acec164',
    'default_graph_version' => 'v2.9',
  ]);
//Se crea un objeto llamado response en el cual se guardan, mediante otro objeto $fb con el metodo get los datos traídos de la aplicacion, en este caso los videos de chilevision, tambien se encuentra el token obtenido en el explorador de api graph
  try {
    // Returns a `Facebook\FacebookResponse` object
    $response = $fb->get('/chilevision/?fields=video_lists{title,description,creation_time}', 'EAAJwfkH1GBwBAAxsmL9KrI2Sle3g5OHZAu12Q3s6PY3J7ttHyfZAtyRjMzJ0IQ4gbBbQ8t4KVDJ7bLhhdFckh9w3bkwb39dyBZCow3JrLE1yVXjfg56j6ejLhrN7qgihemuJMsxNG4mD1B45mNfLK4wcHngIHO07A84tFHLTO2ZAOXP5izwDp3A5Af6ZCMvcZD');
  } catch(Facebook\Exceptions\FacebookResponseException $e) {
    echo 'Graph returned an error: ' . $e->getMessage();
    exit;
  } catch(Facebook\Exceptions\FacebookSDKException $e) {
    echo 'Facebook SDK returned an error: ' . $e->getMessage();
    exit;
  }
//se crea un objeto llamado $user en el cual se guardan los datos obtenidos en el response
  $video = $response->getGraphUser();

  //echo 'Video List: ' . $video['video_lists'] . "\n";

//muestra los datos mediante un arreglo bidimensional
foreach ($video as $videos) {
  if (is_array($videos) || is_object($videos))
  {
    foreach ($videos as $campo)
    {
        echo 'Title : ' . $campo['title'] . "\n";
        echo 'Description : ' . $campo['description'] . "\n";
        echo 'Creation_time: ' . $campo['creation_time'] . "\n";
        echo 'Id: ' . $campo['id'] . "\n";
    }
  }
}
 
 ?>