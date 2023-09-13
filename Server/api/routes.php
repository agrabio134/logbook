<?php
require_once "./config/Connection.php";
require_once "./mainmodule/Get.php";
require_once "./mainmodule/Post.php";
require_once "./mainmodule/Auth.php";
require_once "./mainmodule/Global.php";
// require_once "./mainmodule/Index.php";


$db = new Connection();
$pdo = $db->connect();
$global = new GlobalMethods($pdo);
$get = new Get($pdo);
$auth = new Auth($pdo);
$post = new Post($pdo);

if (isset($_REQUEST['request'])) {
    $req = explode('/', rtrim($_REQUEST['request'], '/'));
} else {
    $req = array("errorcatcher");
}

switch ($_SERVER['REQUEST_METHOD']) {
    case 'POST':
        $data = json_decode(file_get_contents("php://input"));
        switch ($req[0]) {
            case 'login':
                echo json_encode($auth->login($data));
                break;
            
            case 'register':
                echo json_encode($auth->register($data));
                break; 
                
            case 'create_log':
                echo json_encode($post->create_log($data));
                break;    
        
        
            default:
                echo json_encode(array('error' => 'request not found'));
                break;
        }
        break;

    case 'GET':
        $data = json_decode(file_get_contents("php://input"));

        switch ($req[0]) {
            case 'login':
                echo json_encode($auth->login($data));
                break;
        }





    default:
        echo json_encode(array('error' => 'failed request'));
        break;
}
