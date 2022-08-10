<?php 
$title = "Item edit";
include ("./inc/header-admin.php");
include ("./models/Item.php");

$itemID = substr($_SERVER['REQUEST_URI'], 34); 
$item = Item::showItem($itemID);

// Update item info
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update'])) {
    $validated = validateInputs($_POST['name'], 
        $_POST['price'],
        $_POST['gender'],
        $_POST['type']);
    if ($validated) {
        Item::updateItem(intval($itemID),
            $_POST['name'],
            floatval($_POST['price']),
            $_POST['gender'],
            $_POST['type']);
    }
    header("Location: http://localhost/projects/final_project/item/edit/" . $itemID);
    exit();
}

// Delete item and images from dir
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['deleteItem'])) {
    $target_dir = "./public/items/";
    $fileName1 = $target_dir . $item->img_dir1;
    $fileName2 = $target_dir . $item->img_dir2;
    $fileName3 = $target_dir . $item->img_dir3;
    
    if (file_exists($fileName1) &&
        file_exists($fileName2) &&
        file_exists($fileName3)) {
            // delete item from checkout
            foreach ($_SESSION['checkoutItems'] as $checkoutItem) {
                if ($checkoutItem['id'] == $itemID) {
                        $index = array_search($checkoutItem, $_SESSION['checkoutItems']);
                        unset($_SESSION['checkoutItems'][$index]);
                    }
            }
            unlink(getcwd() . "/public/items/" . $item->img_dir1);
            unlink(getcwd() . "/public/items/" . $item->img_dir2);
            unlink(getcwd() . "/public/items/" . $item->img_dir3);
            Item::deleteItem($item->id);
      } else {
        header("Location: http://localhost/projects/final_project/item/edit/" . $itemID);
        exit();
      }

    header("Location: http://localhost/projects/final_project/admin_homepage");
    exit();
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
                        <label class="admin-item-first-label" for="itemName" class="form-label ">Item brand
                            (name)</label>
                        <input type="text" class="form-control" id="itemName" name="name" value="<?= $item->name; ?>">

                        <label for="itemPrice" class="form-label admin-item-title">Item price ($)</label>
                        <input type="text" class="form-control" id="itemPrice" name="price"
                            value="<?= $item->price; ?>">

                        <h4 class="admin-item-title">Gender:</h4>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="gender" value="M" id="male"
                                <?php echo ($item->gender == "M") ? ("checked") : (""); ?>>
                            <label class="form-check-label" for="male">
                                Male
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="gender" value="F" id="female"
                                <?php echo ($item->gender == "F") ? ("checked") : (""); ?>>
                            <label class="form-check-label" for="female">
                                Female
                            </label>
                        </div>

                        <h4 class="admin-item-title">Type:</h4>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="type" value="clothes" id="clothes"
                                <?php echo ($item->type == "clothes") ? ("checked") : (""); ?>>
                            <label class="form-check-label" for="clothes">
                                Clothes
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="type" value="accessories"
                                id="accessories" <?php echo ($item->type == "accessories") ? ("checked") : (""); ?>>
                            <label class="form-check-label" for="accessories">
                                Accessories
                            </label>
                        </div>
                    </div>
                    <div class="item-form-container">

                        <div class="item-form-btn-container">
                            <button type="submit" class="btn-to-cart" name="update"
                                value="<?= $itemID; ?>">UPDATE</button>
                        </div>
                </form>
                <div class="item-form-btn-container">
                    <form action="" method="post">
                        <button type="submit" class="admin-btn-delete" name="deleteItem" value="<?= $itemID; ?>">
                            DELETE ITEM
                        </button>
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
    $validation = true;
    $genders = ['F', 'M'];
    $types = ['clothes', 'accessories'];

    if (!in_array($gender, $genders)) {
        $validation = false;
    }
    if (!in_array($type, $types)) {
        $validation = false;
    }
    if (!is_numeric($price)) {
        $validation = false;
    }

    return $validation;
}
?>