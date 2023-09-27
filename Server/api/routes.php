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

            case 'logout':
                echo json_encode($auth->logout());
                break;

            case 'login':
                echo json_encode($auth->login($data));
                break;

            case 'register':
                echo json_encode($auth->register($data));
                break;


            case 'create_log':
                echo json_encode($post->create_log($data));
                break;

            case 'update_log':


                if (isset($_POST['log_id'], $_POST['item_no'], $_POST['fault_code'], $_POST['fault_desc'], $_POST['transfer_to_do_s_no'], $_POST['mel_item_no'], $_POST['cat'], $_POST['action_taken'])) {


                    $data = $_POST; // Assign the data to the $data variable
                    echo json_encode($global->update("logs", $data, "log_id = " . $data['log_id']));
                } else {

                    echo json_encode(array("code" => 400, "errmsg" => "Invalid data"));
                }

                break;


            case 'add_detail':
                echo json_encode($post->add_detail($data));
                break;
            case 'update_detail':
                echo json_encode($post->update_detail($data));
                break;


            default:
                echo json_encode(array('error' => 'request not found'));
                break;
        }
        break;

    case 'GET':

        switch ($req[0]) {

            case 'get_logs':
                echo json_encode($post->get_logs());
                break;
            case 'get_summary':
                echo json_encode($post->get_summary());
                break;
                // getting sum by id
            case 'get_sum_by_id':
                $logId = $_GET['id'];
                echo json_encode($get->get_common("summary", $logId));
                break;

            case 'get_log_by_id':
                $logId = $_GET['id'];
                echo json_encode($get->get_common("logs", "log_id = $logId"));
                break;

            case 'get_archived_logs':
                echo json_encode($post->get_archived_logs());
                break;

            case 'archive':
                $logId = $_GET['id'];
                echo json_encode($post->archive_log($logId));
                break;

            case 'retrieve':
                $logId = $_GET['id'];
                echo json_encode($post->retrieve_log($logId));
                break;

            default:
                echo json_encode(array('error' => 'request not found'));
                break;
        }
        break;


    default:
        echo json_encode(array('error' => 'failed request'));
        break;
}
