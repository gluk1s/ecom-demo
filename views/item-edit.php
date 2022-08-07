<?php 
$title = "admin homepage";
include ("./inc/header-admin.php");
include ("./models/Item.php");

$itemID = substr($_SERVER['REQUEST_URI'], 35); 
$item = Item::showItem($itemID);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
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
                <form action="" method="post">
                    <div class="item-info">
                        <label for="itemName" class="form-label">Item brand (name)</label>
                        <input type="text" class="form-control" id="itemName" name="name" value="<?= $item->name; ?>">

                        <label for="itemPrice" class="form-label">Item price ($)</label>
                        <input type="text" class="form-control" id="itemPrice" name="price"
                            value="<?= $item->price; ?>">

                        <h4>Gender:</h4>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="gender" id="male" <?php echo ($item->gender == "M") ? ("checked") : (""); ?>>
                            <label class="form-check-label" for="flexRadioDefault1">
                                Male
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="gender" id="female" <?php echo ($item->gender == "F") ? ("checked") : (""); ?>>
                            <label class="form-check-label" for="flexRadioDefault2">
                                Female
                            </label>
                        </div>

                        <h4>Type:</h4>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="type" id="clothes" <?php echo ($item->type == "clothes") ? ("checked") : (""); ?>>
                            <label class="form-check-label" for="clothes">
                                Clothes
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="type" id="accessories" <?php echo ($item->type == "accessories") ? ("checked") : (""); ?>>
                            <label class="form-check-label" for="accessories">
                                Accessories
                            </label>
                        </div>
                    </div>
                    <div class="item-form-container">

                        <div class="item-form-btn-container">
                            <button type="submit" class="btn-to-cart">UPDATE</button>
                        </div>
                </form>
            </div>
        </div>
    </div>
</div>

</div>


<?php 
include("./inc/footer-admin.php"); 
?>

<script>
scriptByPage("item");
</script>

<?php 
function validateInputs($name, $price, $gender, $type) {

}
?>