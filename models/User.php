<?php 
include ("./models/DB.php");

class User {
    public $username;
    public $password;
    public $type;

    function __construct($username, $password, $type) {
        $this->username = $username;
        $this->password = $password;
        $this->type = $type;
    }

    // Add user to db
    public static function userToDB($username, $password, $tyoe) {
        $db = new DB();
        $stmt = $db->conn->prepare("INSERT INTO users (username, password, type) 
            VALUES (?, ?, ?)");
        $password = "admin";
        $user_type = "admin";
        $hashed_paswrod = $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $stmt->bind_param("sss", 
            $username, 
            $hashed_password, 
            $user_type);

        $stmt->execute();
        $stmt->close();
        $db->conn->close();
    }

    // validate user
    public static function validateUser($username, $password) {
        $db = new DB();
        if ($db->conn->connect_error) {
            die("Connection failed: " . $db->conn->connect_error);
        }        
        $sql = "SELECT * FROM users";
        $result = $db->conn->query($sql);
        $validated = false;
        if ($result->num_rows > 0) {
            // output data to array of JSON
            while($row = $result->fetch_assoc()) {
                if($row['username'] == $username &&
                password_verify($password, $row['password'])) {
                    $validated = true;
                };
            }
        } else {
            echo "0 results";
        }
        return $validated;
    }
}
?>