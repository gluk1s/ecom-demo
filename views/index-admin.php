<?php 
$title = "admin homepage";
include ("./inc/header-admin.php");
include ("./models/Item.php");
$arrayOfItems = Item::showItems();
?>
<script>
let items = <?php echo json_encode($arrayOfItems); ?>;
</script>

<div class="admin-homepage-container">
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

<?php 
include("./inc/footer-admin.php"); 
?>

<script>
    scriptByPage("admin-index");
</script>