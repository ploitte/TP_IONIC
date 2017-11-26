<?php 
use \Firebase\JWT\JWT;

//Autorise certains sites (ici tous) à faire des requêtes cross domain
if (isset($_SERVER['HTTP_ORIGIN'])) {
    header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
    header('Access-Control-Allow-Credentials: true');
    header('Access-Control-Max-Age: 86400');
}
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD'])) {
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
    }
    if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS'])) {
        header("Access-Control-Allow-Headers:        {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");
    }
    exit(0);
}

require "flight/Flight.php"; 
require "autoload.php";
require_once('vendor/autoload.php');

Flight::route('GET /', function() {
    echo 'salut';
});

Flight::route("POST /api/inscription", function(){


    $postEncode = file_get_contents('php://input');
    $post = json_decode($postEncode, true);


    $bdd = new bddManager();
    $user = new User();
    $service = new ServiceIns();
    $service -> setParams($post);

    if($service -> controls() === true){
        $user -> setUsername($post["username"]);
        $user -> setEmail($post["email"]);
        $user -> setPassword($post["password"]);
        $user -> addUser($bdd);
        $error = "You are now registered";
        $success = "good";
    }else{
        $error = $service -> getError();
        $success = "bad";
    }

    $result = [
        "error" => $error,
        "success" => $success
    ];

    echo json_encode($result);
});

Flight::start();