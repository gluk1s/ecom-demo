<?php 
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
        $servername = "localhost";
        $username = "root";
        $password = "";
        $db = "final_project";
        $conn = new mysqli($servername, $username, $password, $db);
        $stmt = $conn->prepare(
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
        $conn->close();
    }
}
?>