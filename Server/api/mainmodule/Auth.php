<?php
class Auth
{
    protected $pdo;
    protected $gm;

    public function __construct(\PDO $pdo)
    {
        $this->pdo = $pdo;
        $this->gm = new GlobalMethods($pdo);
    }

    private function check_password($password, $existing_hash)
    {
        $hash = crypt($password, $existing_hash);
        if ($hash === $existing_hash) {
            return true;
        }
        return false;
    }

    private function encrypt_password($password_string)
    {
        $hash_format = "$2y$10$";
        $salt_length = 22;
        $salt = $this->generate_salt($salt_length);
        return crypt($password_string, $hash_format . $salt);
    }

    private function generate_salt($length)
    {
        $urs = md5(uniqid(mt_rand(), true));
        $b64_string = base64_encode($urs);
        $mb64_string = str_replace('+', '.', $b64_string);
        return substr($mb64_string, 0, $length);
    }

    private function generate_token($id)
    {
        $header = json_encode(['typ' => 'JWT', 'alg' => 'HS256']);
        $payload = json_encode(['user_id' => $id]);
        $base64UrlHeader = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($header));
        $base64UrlPayload = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($payload));
        $signature = hash_hmac('sha256', $base64UrlHeader . "." . $base64UrlPayload, 'abC123!', true);
        $base64UrlSignature = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($signature));
        $jwt = $base64UrlHeader . "." . $base64UrlPayload . "." . $base64UrlSignature;
        return $jwt;
    }
    // create user
    public function register($received_data)
    {

        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $username = $_POST['username'];
        $password = $this->encrypt_password($_POST['password']);
        $token = $this->generate_token($fname);

        // Check if username already exists
        $stmt = $this->pdo->prepare("SELECT COUNT(*) FROM users WHERE username = ?");
        $stmt->execute([$username]);
        if ($stmt->fetchColumn() > 0) {
            $code = 409; // Conflict status code
            $remarks = "failed";
            $message = "Username already exists.";
            $payload = null;
        } else {

            //insert data to database
            $sql = "INSERT INTO users (user_id, fname, lname, username, password, token)
         VALUES (?, ?, ?, ?, ?, ?)";
            $stmt = $this->pdo->prepare($sql);

            try {
                $stmt->execute([null, $fname, $lname, $username, $password, $token]);
                if ($stmt->rowCount() > 0) {
                    $code = 200;
                    $remarks = "success";
                    $message = "User created successfully.";
                    $payload = null;

                    header("Location: http://localhost/logbook/frontend/index.php");

                } else {
                    $code = 500;
                    $remarks = "failed";
                    $message = "Failed to create user.";
                    $payload = null;

                    header("Location: http://localhost/logbook/frontend/index.php");

                }
            } catch (\PDOException $e) {
                $code = 500;
                $remarks = "failed";
                $message = "Failed to create user.";
                $payload = null;

                header("Location: http://localhost/logbook/frontend/index.php");

            }
            return $this->gm->returnPayload($payload, $remarks, $message, $code);

            header("Location: http://localhost/logbook/frontend/index.php");


            // using the server redirect to the login page

        }
    }

    // logout
    public function logout()
    {
        session_start();
   
        session_destroy();

        //check if session is destroyed
        if (session_status() == PHP_SESSION_NONE) {
            $code = 200;
            $remarks = "success";
            $message = "Logged out successfully.";
            $payload = null;
        } else {
            $code = 500;
            $remarks = "failed";
            $message = "Failed to logout.";
            $payload = null;
        }

        // Redirect to the login page
        header("Location: {$_SERVER['HTTP_REFERER']}/login.php");

        // return $this->gm->returnPayload($payload, $remarks, $message, $code);

        exit;
    }

    // create user
    public function login($received_data)

    {
        session_start();
        $username = $_POST['username'];
        $pword =  $_POST['password'];

        $sql = "SELECT * FROM users WHERE username = ? ";
        $stmt = $this->pdo->prepare($sql);

        header('Content-Type: text/html; charset=utf-8');


        try {
            $stmt->execute([$username]);
            if ($stmt->rowCount() > 0) {
                $res = $stmt->fetch();
                if ($this->check_password($pword, $res['password'])) {
                    $id = $res['user_id'];
                    $fname = $res['fname'];
                    $lname = $res['lname'];

                    $token = $this->generate_token($res['fname']);
                    // $role = $res['role'];

                    $code = 200;
                    $remarks = "success";
                    $message = "Logged in successfully.";
                    $payload = array(
                        "id" => $id,
                        "fname" => $fname,
                        "lname" => $lname,
                        "token" => $token
                    );

                    session_start();

                    $_SESSION['users_id'] = $id;
                    $_SESSION['fname'] = $fname;
                    $_SESSION['lname'] = $lname;


                    echo "<script>alert('Logged in Successfully!'); window.location.href = 'http://localhost/logbook/frontend/index.php';</script>";
                    exit;
                } else {

                    echo "<script>alert('Invalid username or password'); window.location.href = 'http://localhost/logbook/frontend/login.php';</script>";




                    $code = 401;
                    $remarks = "failed";
                    $message = "Invalid username or password."; 
                    $payload = null;

                    exit;
                }
            } else {
                $code = 401;
                $remarks = "failed";
                $message = "Invalid username or password.";
                $payload = null;
                echo "<script>alert('Invalid username or password'); window.location.href = 'http://localhost/logbook/frontend/login.php';</script>";



            }
        } catch (\PDOException $e) {
            $code = 500;
            $remarks = "failed";
            $message = "Failed to login.";
            $payload = null;
        }





        return $this->gm->returnPayload($payload, $remarks, $message, $code);
    }
}
