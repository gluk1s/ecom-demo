<?php 
$title = "Item";
include ("./inc/header.php");
include ("./models/Item.php");
// url item query
$itemID = substr($_SERVER['REQUEST_URI'], 30); 
$item = Item::showItem($itemID);
print_r($item);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $sizeArr = ["S", "M", "L", "XL"];
    if (!isset($_SESSION)) {
        session_start();
    }
    if (!isset($_SESSION['checkoutItems'])) {
        $_SESSION['checkoutItems'] = [];
    }
    if (in_array($_POST['size'], $sizeArr)) {
        if (count($_SESSION['checkoutItems']) > 0) {
            $counter = 0;
            foreach ($_SESSION['checkoutItems'] as &$checkoutItem) {
                // Increasing item qty which already in checkout (session)
                if ($checkoutItem['id'] == $item->id && $checkoutItem['size'] == $_POST['size']) {
                    $checkoutItem['qty']++;
                    $counter++;
                }
            }
            if ($counter == 0) {
                $itemToAdd = array("id"=>$item->id, "size"=>$_POST['size'], "qty"=>1);
                $_SESSION['checkoutItems'][] = $itemToAdd;
            }
        // Adding first item of this category to checkout (session)
        } else {
            $itemToAdd = array("id"=>$item->id, "size"=>$_POST['size'], "qty"=>1);
            $_SESSION['checkoutItems'][] = $itemToAdd;
        }

        $_SESSION['counter'] = $counter;
        header("Location: http://localhost/projects/final_project/shop");
        exit();
    }
    else {
        header("Location: http://localhost/projects/final_project/items/" . $item->id);
        exit();
    }
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