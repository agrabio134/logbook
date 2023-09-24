<?php
class Post
{
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

        session_start();
        $user_id = $_SESSION['id'];


        $user_id = $_POST['user_id'];
        $item_no = $_POST['item_no'];
        $fault_code = $_POST['fault_code'];
        $fault_desc = $_POST['fault_desc'];
        $transfer_to_do_no = $_POST['transfer_to_do_s_no'];
        $mel_item_no = $_POST['mel_item_no'];
        $cat = $_POST['cat'];
        $action_taken = $_POST['action_taken'];


        // if empty return error
        if (empty($item_no) || empty($fault_code) || empty($fault_desc)  || empty($cat) || empty($action_taken)) {
            $code = 401;
            $remarks = "failed";
            $message = "Please fill up all fields.";
            $payload = null;
        } else {
            // insert data to database
            $sql = "INSERT INTO logs (user_id, item_no, fault_code, fault_desc, transfer_to_do_s_no, mel_item_no, cat, action_taken) VALUES (?, ?,?,?,?,?,?,?)";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([$user_id, $item_no, $fault_code, $fault_desc, $transfer_to_do_no, $mel_item_no, $cat, $action_taken]);

            $code = 200;
            $remarks = "success";
            $message = "Log created successfully.";
            $payload = null;
        }

        // return $this->gm->returnPayload($payload, $remarks, $message, $code);

        header("Location: http://localhost/logbook/frontend/index.php");
    }
    public function update_detail($received_data)
    {
        session_start();
        $user_id = 1;

        // Check if the request contains JSON data
        $json_data = file_get_contents('php://input');
        $data = json_decode($json_data, true);

        // Check if the required fields are present in the JSON data
        if (
            empty($data['arrival_fuel_lh']) || empty($data['arrival_fuel_ctr']) || empty($data['arrival_fuel_rh']) ||
            empty($data['tire_pressure']) || empty($data['nose_lh']) || empty($data['nose_rh']) ||
            empty($data['lh_main_inbd']) || empty($data['lh_main_outbd']) || empty($data['rh_main_inbd']) ||
            empty($data['rh_main_outbd'])
        ) {
            // update with the current data
            $idToUpdate = 1; // Update this to the correct ID

            // Construct the SQL query for updating


            // get the current data
            $sql1 = "SELECT * FROM summary WHERE id = 1";
            $stmt1 = $this->pdo->prepare($sql1);
            $stmt1->execute();
            $summ = $stmt1->fetchAll(PDO::FETCH_ASSOC);
            $code = 200;
            $remarks = "success";
            $message = "summary retrieved successfully.";
            $payload = $summ;

            // Execute the SQL query with data



            $sql = "UPDATE summary SET arrival_fuel_lh=?, arrival_fuel_ctr=?, arrival_fuel_rh=?, tire_pressure=?, nose_lh=?, nose_rh=?, lh_main_inbd=?, lh_main_outbd=?, rh_main_inbd=?, rh_main_outbd=? WHERE id=?";
            $stmt = $this->pdo->prepare($sql);
            $result = $stmt->execute([
               
            //   if empty get the current data
                $data['arrival_fuel_lh'] == "" ? $summ[0]['arrival_fuel_lh'] : $data['arrival_fuel_lh'],
                $data['arrival_fuel_ctr'] == "" ? $summ[0]['arrival_fuel_ctr'] : $data['arrival_fuel_ctr'],
                $data['arrival_fuel_rh'] == "" ? $summ[0]['arrival_fuel_rh'] : $data['arrival_fuel_rh'],
                $data['tire_pressure'] == "" ? $summ[0]['tire_pressure'] : $data['tire_pressure'],
                $data['nose_lh'] == "" ? $summ[0]['nose_lh'] : $data['nose_lh'],
                $data['nose_rh'] == "" ? $summ[0]['nose_rh'] : $data['nose_rh'],
                $data['lh_main_inbd'] == "" ? $summ[0]['lh_main_inbd'] : $data['lh_main_inbd'],
                $data['lh_main_outbd'] == "" ? $summ[0]['lh_main_outbd'] : $data['lh_main_outbd'],
                $data['rh_main_inbd'] == "" ? $summ[0]['rh_main_inbd'] : $data['rh_main_inbd'], 
                $data['rh_main_outbd'] == "" ? $summ[0]['rh_main_outbd'] : $data['rh_main_outbd'],
                    


                
                $idToUpdate // Use the correct ID for updating
            ]);

            if ($result) {
                $code = 200;
                $remarks = "success";
                $message = "Data updated successfully.";
                $payload = null;
            } else {
                // Handle the update failure and log any errors
                $code = 500;
                $remarks = "error";
                $message = "Failed to update data.";
                $payload = null;

                // Log the SQL query and error for debugging
                error_log("SQL Query: " . $sql);
                error_log("SQL Error: " . json_encode($stmt->errorInfo()));
            }

            $code = 401;
            $remarks = "failed";
            $message = "Please fill up all fields.";
            $payload = null;
        } else {
            // Determine the ID for updating based on your logic
            $idToUpdate = 1; // Update this to the correct ID

            // Construct the SQL query for updating
            $sql = "UPDATE summary SET arrival_fuel_lh=?, arrival_fuel_ctr=?, arrival_fuel_rh=?, tire_pressure=?, nose_lh=?, nose_rh=?, lh_main_inbd=?, lh_main_outbd=?, rh_main_inbd=?, rh_main_outbd=? WHERE id=?";
            $stmt = $this->pdo->prepare($sql);

            // Execute the SQL query with data


            $result = $stmt->execute([
                $data['arrival_fuel_lh'],
                $data['arrival_fuel_ctr'],
                $data['arrival_fuel_rh'],
                $data['tire_pressure'],
                $data['nose_lh'],
                $data['nose_rh'],
                $data['lh_main_inbd'],
                $data['lh_main_outbd'],
                $data['rh_main_inbd'],
                $data['rh_main_outbd'],
                $idToUpdate // Use the correct ID for updating
            ]);

            if ($result) {
                $code = 200;
                $remarks = "success";
                $message = "Data updated successfully.";
                $payload = null;
            } else {
                // Handle the update failure and log any errors
                $code = 500;
                $remarks = "error";
                $message = "Failed to update data.";
                $payload = null;

                // Log the SQL query and error for debugging
                error_log("SQL Query: " . $sql);
                error_log("SQL Error: " . json_encode($stmt->errorInfo()));
            }
        }

        // Send the response as JSON
        header('Content-Type: application/json');
        echo json_encode([
            'code' => $code,
            'remarks' => $remarks,
            'message' => $message,
            'payload' => $payload
        ]);
    }

    public function add_detail($received_data)
    {
        session_start();
        // $user_id = $_SESSION['id'];
        $user_id = 1;

        $arr_fuel_lh = $_POST['arrival_fuel_lh'];
        $arr_fuel_ctr = $_POST['arrival_fuel_ctr'];
        $arr_fuel_rh = $_POST['arrival_fuel_rh'];
        $tire_pressure = $_POST['tire_pressure'];
        $nose_lh = $_POST['nose_lh'];
        $nose_rh = $_POST['nose_rh'];
        $lh_main_inbd = $_POST['lh_main_inbd'];
        $lh_main_outbd = $_POST['lh_main_outbd'];
        $rh_main_inbd = $_POST['rh_main_inbd'];
        $rh_main_outbd = $_POST['rh_main_outbd'];

        // If any required field is empty, return an error
        if (empty($arr_fuel_lh) || empty($arr_fuel_ctr) || empty($arr_fuel_rh) || empty($tire_pressure) || empty($nose_lh) || empty($nose_rh) || empty($lh_main_inbd) || empty($lh_main_outbd) || empty($rh_main_inbd) || empty($rh_main_outbd)) {
            $code = 401;
            $remarks = "failed";
            $message = "Please fill up all fields.";
            $payload = null;
        } else {
            // Insert data into the database

            $sql = "INSERT INTO summary (id, arrival_fuel_lh, arrival_fuel_ctr, arrival_fuel_rh, tire_pressure, nose_lh, nose_rh, lh_main_inbd, lh_main_outbd, rh_main_inbd, rh_main_outbd, user_id) VALUES (null,?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([$arr_fuel_lh, $arr_fuel_ctr, $arr_fuel_rh, $tire_pressure, $nose_lh, $nose_rh, $lh_main_inbd, $lh_main_outbd, $rh_main_inbd, $rh_main_outbd, $user_id]);

            $code = 200;
            $remarks = "success";
            $message = "Data added successfully.";
            $payload = null;
        }

        echo json_encode([
            'code' => $code,
            'remarks' => $remarks,
            'message' => $message,
            'payload' => $payload
        ]);
        // Redirect to a different page after processing the data
        // header("Location: http://localhost/logbook/frontend/print_summary.php");
    }


    public function archive_log($logId)
    {
        $sql = "UPDATE logs SET is_archived = 1 WHERE log_id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$logId]);

        $code = 200;
        $remarks = "success";
        $message = "Log Archived successfully.";
        $payload = null;

        // You can also redirect to a specific page or return a response as needed.
        // For example, to redirect to the same page where the logs are displayed:
        header('Location: http://localhost/logbook/frontend/');
        exit;

        // Or, you can return a response in JSON format:
        // return $this->gm->returnPayload($payload, $remarks, $message, $code);
    }

    public function retrieve_log($logId)
    {
        $sql = "UPDATE logs SET is_archived = 0 WHERE log_id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$logId]);

        $code = 200;
        $remarks = "success";
        $message = "Log Retrieved successfully.";
        $payload = null;

        // You can also redirect to a specific page or return a response as needed.
        // For example, to redirect to the same page where the logs are displayed:
        header('Location: http://localhost/logbook/frontend/');
        exit;

        // Or, you can return a response in JSON format:
        // return $this->gm->returnPayload($payload, $remarks, $message, $code);
    }



    public function get_logs()
    {
        $sql = "SELECT * FROM logs Where is_archived = 0";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        $logs = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $code = 200;
        $remarks = "success";
        $message = "Logs retrieved successfully.";
        $payload = $logs;
        return $this->gm->returnPayload($payload, $remarks, $message, $code);
    }

    public function get_summary()
    {
        $sql = "SELECT * FROM summary";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        $summ = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $code = 200;
        $remarks = "success";
        $message = "summary retrieved successfully.";
        $payload = $summ;
        return $this->gm->returnPayload($payload, $remarks, $message, $code);
    }



    public function get_archived_logs()
    {
        $sql = "SELECT * FROM logs Where is_archived = 1";
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
