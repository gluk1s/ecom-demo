<?php 
$title = "Item";
include ("./inc/header.php");
include ("./models/Item.php");
// url item query
$itemID = substr($_SERVER['REQUEST_URI'], 30);
// Take item data from db
$servername = "localhost";
$username = "root";
$password = "";
$db = "final_project";
// Create connection
$conn = new mysqli($servername, $username, $password, $db);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
$sql = "SELECT * FROM items WHERE id = " . $itemID . "";
$result = $conn->query($sql);

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
    header("Location: http://localhost/projects/final_project/shop");
    exit();
}
print_r($item);
$conn->close(); 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $sizeArr = ["S", "M", "L", "XL"];
    if (!isset($_SESSION)) {
        session_start();
    }
    if (in_array($_POST['size'], $sizeArr)) {
        header("Location: http://localhost/projects/final_project/shop");
        exit();
    }
    else {
        header("Location: http://localhost/projects/final_project/items/" . $item->id);
        exit();
    }
    // $_SESSION[''];
}

?>

<!-- HTML Code -->
<div class="item-page-container">
    <div class="container">
        <div class="row">
            <div class="col-md-7">
                <div class="item-photos-container">
                    <div class="item-mini-photo mini-photo-active"><img
                            src="/projects/final_project/public/items/<?= $item->img_dir1 ;?>" alt=""></div>
                    <div class="item-mini-photo"><img src="/projects/final_project/public/items/<?= $item->img_dir2 ;?>"
                            alt=""></div>
                    <div class="item-mini-photo"><img src="/projects/final_project/public/items/<?= $item->img_dir3 ;?>"
                            alt=""></div>
                </div>

                <div id="big-item-photo" class="item-photo">
                    <img src="/projects/final_project/public/items/<?= $item->img_dir1 ;?>" alt="">
                </div>
            </div>
            <div class="col-md-5">
                <div class="item-info">
                    <h4><?= $item->name; ?></h4>
                    <h5 class="item-page-price">$<?= $item->price; ?></h5>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolores, nobis.</p>
                </div>
                <div class="item-form-container">
                    <form action="" method="post">
                        <div class="size-text-container">
                            <p>Size:</p>
                        </div>
                        <div class="select-container input-group mb-3">
                            <select class="form-select" name="size" id="">
                                <option class="item-select-option" value="" selected>Choose an option</option>
                                <option class="item-select-option" value="S">Size S</option>
                                <option class="item-select-option" value="M">Size M</option>
                                <option class="item-select-option" value="L">Size L</option>
                                <option class="item-select-option" value="XL">Size XL</option>
                            </select>
                        </div>
                        <div class="item-form-btn-container">
                            <button type="submit" class="btn-to-cart">ADD TO CART</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>

<?php include ("./inc/footer.php"); ?>

<script>
scriptByPage("item");
</script>