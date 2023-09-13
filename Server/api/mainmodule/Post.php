<?php
    class Post{
        protected $pdo;
        protected $gm;

        public function __construct(\PDO $pdo)
        {
            $this->pdo = $pdo;
            $this->gm = new GlobalMethods($pdo);
        }


        public function create_log($received_data)
        {
          //get the users id from the session

        // session_start();
        // $user_id = $_SESSION['id'];

        $item_no = $_POST['item_no'];
        $fault_code = $_POST['fault_code'];
        $fault_desc = $_POST['fault_desc'];
        $transfer_to_do_no = $_POST['transfer_to_do_s_no'];
        $mel_item_no = $_POST['mel_item_no'];
        $cat = $_POST['cat'];
        // $action_taken = $_POST['action_taken'];


        // if empty return error
        if (empty($item_no) || empty($fault_code) || empty($fault_desc)  || empty($cat) || empty($action_taken)) {
            $code = 401;
            $remarks = "failed";
            $message = "Please fill up all fields.";
            $payload = null;
        } else {
            // insert data to database
            $sql = "INSERT INTO logs (item_no, fault_code, fault_desc, transfer_to_do_s_no, mel_item_no, cat, action_taken) VALUES (?,?,?,?,?,?,?)";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([$item_no, $fault_code, $fault_desc, $transfer_to_do_no, $mel_item_no, $cat, $action_taken]);

            $code = 200;
            $remarks = "success";
            $message = "Log created successfully.";
            $payload = null;

        }

        return $this->gm->returnPayload($payload, $remarks, $message, $code);

        header ("Location: http://localhost/logbook/frontend/index.php");


        }

        public function edit_logt($id)
        {
         
        }

        public function get_logs(){
            $sql = "SELECT * FROM logs";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();
            $logs = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $code = 200;
            $remarks = "success";
            $message = "Logs retrieved successfully.";
            $payload = $logs;
            return $this->gm->returnPayload($payload, $remarks, $message, $code);
        }


        public function delete_post($id)
        {
            $sql = "DELETE FROM cms_contents WHERE id = ?";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([$id]);
            header('Location: /cms/content');
            exit;
        }


       


    }
