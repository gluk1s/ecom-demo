<?php 
$title = "Shop";
include ("./inc/header.php");
include ("./models/Item.php"); 
$arrayOfItems = showItems();
?>
<!-- Pass items data to JS -->
<script>
    let items = <?php echo json_encode($arrayOfItems); ?>;
</script>


<div class="shop-container">
    <div class="filter">
        <button id="allItems" class="filter-btn filter-btn-active">All Products</button>
        <button id="womenItems" class="filter-btn">Women</button>
        <button id="menItems" class="filter-btn">Men</button>
        <button id="accessoriesItems" class="filter-btn">Accessories</button>
    </div>
    <div class="items">
        <div id="filter-box" class="container items-grid">
            <div id="filter-row" class="row">

            </div>
        </div>
    </div>
</div>

</div>
<!-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal">
  Launch static backdrop modal
</button> -->
<!-- Modal -->
<!-- <div id="modal" class="modal" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Modal title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p>Modal body text goes here.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div> -->


<?php include("./inc/footer.php") ?>
<?php 
function showItems() {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $db = "final_project";
    $arrOfJSON = [];

    // Create connection
    $conn = new mysqli($servername, $username, $password, $db);

    // Check connection
    if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT name, price, gender, type, img_dir1, img_dir2, img_dir3, id FROM items";

    $result = $conn->query($sql);

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
    
    $conn->close();
    return $arrOfJSON;
}
?>

<script>
    scriptByPage("shop");
</script>