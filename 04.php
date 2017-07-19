<?php
//se importa la biblioteca de Facebook
  require_once 'src/Facebook/autoload.php';
//se crea la conexion a la base de datos de mysql
  $mysqli = new mysqli("127.0.0.1", "admin", "admin", "facebook");
    if ($mysqli->connect_errno) {
        echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
    }
//se crea un objeto de tipo Facebook, que contiene un app_id que es el id de la aplicación, app_secret es la contrasena de la aplicación y la versión de SDK
  $fb = new Facebook\Facebook([
    'app_id' => '{686637528193052}',
    'app_secret' => '8d6a19d877da4ecd990c2dcf7acec164',
    'default_graph_version' => 'v2.9',
  ]);
//Se crea un objeto llamado response en el cual se guardan, mediante otro objeto $fb con el metodo get los datos traídos de la aplicacion, en este caso los videos de chilevision, tambien se encuentra el token obtenido en el explorador de api graph
  try {
    // Returns a `Facebook\FacebookResponse` object
    $response = $fb->get('/chilevision/?fields=video_lists{title,description,creation_time}', 'EAAJwfkH1GBwBAIIcsLSMpbtAm9qqWXM2mtk2aC26FH5UuE7nMPKI9WbSqIRwjH1SN9LmxZAUKqekRbZANCpK4wj3ZBn1n8eyKwE18GTlJEWq0jYFwTLu2eEa0ZCvmKcBtmWSCG8iOlHZCtepfSQ4868RVcvWZBxhobBZBzhtQyj9ZAYfEiZCMPxz06lg52KRT2WMZD');
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

//se guardan los datos mediante query en el arreglo bidimensional
  foreach ($video as $videos) {
  if (is_array($videos) || is_object($videos))
  {
    foreach ($videos as $campo)
    {
      $mysqli->query("INSERT INTO videos(title, description, creation_time, id) VALUES ('".$campo['title']."','".$campo['description']."','".$campo['creation_time']."','".$campo['id']."')");
      var_dump($campo['title']);
      var_dump($campo['description']);
      var_dump($campo['creation_time']);
      var_dump($campo['id']);
    }
  }
}

 
 ?>