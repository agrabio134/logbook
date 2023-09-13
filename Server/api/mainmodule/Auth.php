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
        // header("Location: http://localhost/gymbro/signup.php");
        if ($stmt->fetchColumn() > 0) {
            $code = 409; // Conflict status code
            $remarks = "failed";
            $message = "Username already exists.";
            $payload = null;
        } else {

        //insert data to database
        $sql = "INSERT INTO users (id, fname, lname, username, password, token)
         VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $this->pdo->prepare($sql);
        // header("Location: http://localhost/gymbro/login.php");

        try {
            $stmt->execute([null, $fname, $lname, $username, $password, $token]);
            if ($stmt->rowCount() > 0) {
                $code = 200;
                $remarks = "success";
                $message = "User created successfully.";
                $payload = null;
            } else {
                $code = 500;
                $remarks = "failed";
                $message = "Failed to create user.";
                $payload = null;
            }
        } catch (\PDOException $e) {
            $code = 500;
            $remarks = "failed";
            $message = "Failed to create user.";
            $payload = null;
        }
        return $this->gm->returnPayload($payload, $remarks, $message, $code);

        // using the server redirect to the login page

    }
}
    
    //logout
    // public function logout()
    // {
    //     session_start();
    //     // Unset all session variables
    //     $_SESSION = array();
    //     // Destroy the session
    //     session_destroy();
    //     // Redirect to the login page
    //     header("Location: {$_SERVER['HTTP_REFERER']}/login.html");
    //     exit;
    // }

    // create user
    public function login($received_data)
    {
        // session_start();



        $username = $_POST['username'];
        $pword =  $_POST['password'];

        $sql = "SELECT * FROM users WHERE username = ? ";
        $stmt = $this->pdo->prepare($sql);

        try {
            $stmt->execute([$username]);
            if ($stmt->rowCount() > 0) {
                $res = $stmt->fetch();
                if ($this->check_password($pword, $res['password'])) {
                    $id = $res['id'];
                    $fname = $res['first_name'];
                    $lname = $res['last_name'];
                    $address = $res['address'];
                    $email = $res['email'];



                    $token = $this->generate_token($res['first_name']);
                    // $role = $res['role'];

                    $code = 200;
                    $remarks = "success";
                    $message = "Logged in successfully.";
                    $payload = array(
                        "id" => $id,
                        "first_name" => $fname,
                        "last_name" => $lname,
                        "address" => $address,
                        "email" => $email,


                        "token" => $token
                    );

                    session_start();

                    $_SESSION['users_id'] = $id;

                    echo  $id;
                    header("Location: http://localhost/gymbro/index.php");
                } else {
                    $code = 401;
                    $remarks = "failed";
                    $message = "Invalid username or password.";
                    $payload = null;
                }
            } else {
                $code = 401;
                $remarks = "failed";
                $message = "Invalid username or password.";
                $payload = null;
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
