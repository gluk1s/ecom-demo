<?php 
include ("./models/DB.php");
class Item {
    public $name;
    public $price;
    public $gender;
    public $type;
    public $img_dir1;
    public $img_dir2;
    public $img_dir3;
    public $id;

    function __construct(
        $name, 
        $price, 
        $gender, 
        $type, 
        $img_dir1, 
        $img_dir2 = null, 
        $img_dir3 = null,
        $id = null) 
    {
        $this->name = $name;
        $this->price = $price;
        $this->gender = $gender;
        $this->type = $type;
        $this->img_dir1 = $img_dir1;
        $this->img_dir2 = $img_dir2;
        $this->img_dir3 = $img_dir3;
        $this->id = $id;
    }
    // Add item to db
    function addItemToDB() {
        $db = new DB();
        $stmt = $db->conn->prepare(
            "INSERT INTO items (name, price, gender, type, img_dir1, img_dir2, img_dir3) 
            VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sdsssss", 
            $this->name, 
            $this->price, 
            $this->gender,
            $this->type,
            $this->img_dir1,
            $this->img_dir2,
            $this->img_dir3);

        $stmt->execute();
        $stmt->close();
        $db->conn->close();
    }

    // Delete item from db
    public static function deleteItem($id) {
        $db = new DB();
        $stmt = $db->conn->prepare("DELETE FROM items WHERE id=?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->close();
        $db->conn->close();
    }

    // Return Items data
    public static function showItems() {
        $arrOfJSON = [];
        $db = new DB();
        if ($db->conn->connect_error) {
            die("Connection failed: " . $db->conn->connect_error);
        }        
        $sql = "SELECT name, price, gender, type, img_dir1, img_dir2, img_dir3, id FROM items";
        $result = $db->conn->query($sql);
        if ($result->num_rows > 0) {
            // output data to array of JSON
            while($row = $result->fetch_assoc()) {
                $myJSON = json_encode(new Item(
                    $row["name"], 
                    $row["price"], 
                    $row["gender"], 
                    $row["type"],
                    $row["img_dir1"],
                    $row["img_dir2"],
                    $row["img_dir3"],
                    $row["id"]));
        
                $arrOfJSON[] = $myJSON;
            }
        } else {
            echo "0 results";
        }
            
        $db->conn->close();
        return $arrOfJSON;
    }

    public static function showItem($itemID) {
        $db = new DB();
        if ($db->conn->connect_error) {
            die("Connection failed: " . $db->conn->connect_error);
        }        
        $sql = "SELECT * FROM items WHERE id = " . $itemID . "";
        $result = $db->conn->query($sql);
        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
                $item = new Item(
                    $row["name"], 
                    $row["price"], 
                    $row["gender"], 
                    $row["type"],
                    $row["img_dir1"],
                    $row["img_dir2"],
                    $row["img_dir3"],
                    $row["id"]);
            }
            } else {
            // Redirect to shop if id not exists
            $db->conn->close();
            header("Location: http://localhost/projects/final_project/shop");
            exit();
            }
            $db->conn->close();
            return $item;
    }

    public static function updateItem($id, $name, $price, $gender, $type) {
        $db = new DB();
        if ($db->conn->connect_error) {
            die("Connection failed: " . $db->conn->connect_error);
        }    
        $stmt = $db->conn->prepare(
            "UPDATE items SET name=?, price=?, gender=?, type=? 
            WHERE id=?");
        $stmt->bind_param("sdssi", 
            $name,
            $price,
            $gender,
            $type,
            $id);

        $stmt->execute();
        $stmt->close();
        $db->conn->close();
    }


}
?>