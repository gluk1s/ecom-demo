<?php 
$title = "Shop";
include ("./inc/header.php");
include ("./models/Item.php"); 
$arrayOfItems = Item::showItems();

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

<!-- </div> -->
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

<script>
    scriptByPage("shop");
</script>