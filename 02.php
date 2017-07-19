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
	  'app_id' => '{134681667120765}',
    'app_secret' => 'c00a8b9b67ed0d01f1f09e0f30d08bae',
    'default_graph_version' => 'v2.9',
  ]);
//Se crea un objeto llamado response en el cual se guardan, mediante otro objeto $fb con el metodo get los datos traídos de la aplicacion, en este caso mis datos que pueden variar, tambien se encuentra el token obtenido en el explorador de api graph
  try {
    // Returns a `Facebook\FacebookResponse` object
    $response = $fb->get('/me?fields=id,first_name,last_name,gender,locale,verified', 'EAAB6fgTtLn0BAK2IzgdAvVkfIHZBVHLeZBiD35dNZCQHjiDaYTvRJh0yl2oi50YLsbStHgWW3mdjzNezR8y6KKYqPcjtr1CdrGaN77BredWF2l6KeaB9huBaeW3QZA9Orasg4dyrccIjCarxAXMe6s5ZAeRZB5jyarlbykyOAurdq9JU5N418VSBglIfRd3e0ZD');
  } catch(Facebook\Exceptions\FacebookResponseException $e) {
    echo 'Graph returned an error: ' . $e->getMessage();
    exit;
  } catch(Facebook\Exceptions\FacebookSDKException $e) {
    echo 'Facebook SDK returned an error: ' . $e->getMessage();
    exit;
  }
//se crea un objeto llamado $user en el cual se guardan los datos obtenidos en el response
  $user = $response->getGraphUser();
// se guardan los datos mediante una query en la base de datos
  $mysqli->query("INSERT INTO users(id, first_name, last_name, gender, locale, verified) VALUES ('".$user['id']."','".$user['first_name']."','".$user['last_name']."','".$user['gender']."','".$user['locale']."','".$user['verified']."')");
  echo"Datos Guardados";
  ?>