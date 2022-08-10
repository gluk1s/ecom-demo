<?php 
$title = "Cart";
include ("./inc/header.php");
include ("./models/Item.php");
// Delete item from cart 
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete'])) {
    $index = 0;
    foreach ($_SESSION['checkoutItems'] as $item) {
        if ($item['id'] == $_POST['delete'] && 
        $item['size'] == $_POST['size']) {
                $index = array_search($item, $_SESSION['checkoutItems']);
                unset($_SESSION['checkoutItems'][$index]);
            }
    }
    header("Location: http://localhost/projects/final_project/checkout");
    exit();
}
// Decrease item qty
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['dec'])) {
    $index = 0;
    foreach ($_SESSION['checkoutItems'] as $item) {
        if ($item['id'] == $_POST['dec'] && 
        $item['size'] == $_POST['size']) {
                if ($item['qty'] == 1) {
                    $index = array_search($item, $_SESSION['checkoutItems']);
                    unset($_SESSION['checkoutItems'][$index]);
                } else {
                    $index = array_search($item, $_SESSION['checkoutItems']);
                    $_SESSION['checkoutItems'][$index]['qty']--;
                }
            }
    }
    header("Location: http://localhost/projects/final_project/checkout");
    exit();
}

// Increase item qty
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['inc'])) {
    $index = 0;
    foreach ($_SESSION['checkoutItems'] as $item) {
        if ($item['id'] == $_POST['inc'] && 
        $item['size'] == $_POST['size']) {
                if ($item['qty'] < 10) {
                    $index = array_search($item, $_SESSION['checkoutItems']);
                    $_SESSION['checkoutItems'][$index]['qty']++;
                } else {
                    header("Location: http://localhost/projects/final_project/checkout");
                    exit();
                }
            }
    }
    header("Location: http://localhost/projects/final_project/checkout");
    exit();
}

// Create cart associative array
$arrOfItems = [];
if (isset($_SESSION['checkoutItems'])) {
    foreach ($_SESSION['checkoutItems'] as $item) {
        $itemData = Item::showItem($item['id']);
        $customArr = array(
            "id"=>$item['id'],
            "name"=>$itemData->name,
            "size"=>$item['size'],
            "price"=>$itemData->price,
            "qty"=>$item['qty'],
            "img_dir1"=>$itemData->img_dir1
        );
        $arrOfItems[] = $customArr;
    }
}

?>

<div class="cart-container">
    <div class="table-container">
        <?php if (count($arrOfItems) > 0) { ?>
        <table class="table">
            <thead>
                <tr class="cart-th-tr">
                    <th class="cart-th cart-first-td" scope="col">Product</th>
                    <th class="cart-th" scope="col">Size</th>
                    <th class="cart-th" scope="col">Price</th>
                    <th class="cart-th" scope="col">Qty</th>
                    <th class="cart-th" scope="col">Total</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $total = 0;
                foreach($arrOfItems as $item) { 
                    $total+= $item['price'] * $item['qty'];?>
                <tr class="cart-td-tr">
                    <td scope="row cart-first-td">
                        <div class="cart-item-image-container">
                            <img class="cart-item-image" src="./public/items/<?= $item['img_dir1'];?>" alt="">
                        </div>
                        <div class="cart-item-name">
                            <p><?= $item['name'];?></p>
                        </div>
                    </td>
                    <td><?= $item['size'];?></td>
                    <td>$ <?= $item['price'];?></td>
                    <td>
                        <div class="cart-qty-minus">
                            <form action="" method="post">
                                <input type="text" name="size" value="<?= $item['size'];?>" hidden>
                                <button class="cart-qty-btn" type="submit" name="dec" value="<?= $item['id'];?>">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="25" fill="currentColor"
                                        class="bi bi-dash" viewBox="0 0 16 16">
                                        <path d="M4 8a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7A.5.5 0 0 1 4 8z" />
                                    </svg>
                                </button>
                            </form>
                        </div>
                        <div class="cart-qty"><?= $item['qty'];?></div>
                        <div class="cart-qty-plus">
                            <form action="" method="post">
                                <input type="text" name="size" value="<?= $item['size'];?>" hidden>
                                <button class="cart-qty-btn" type="submit" name="inc" value="<?= $item['id'];?>">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="25" fill="currentColor"
                                        class="bi bi-plus" viewBox="0 0 16 16">
                                        <path
                                            d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z" />
                                    </svg>
                                </button>
                            </form>
                        </div>
                    </td>
                    <td>$ <?php echo ($item['qty'] * $item['price']); ?></td>
                    <td>
                        <form action="" method="post">
                            <input type="text" name="size" value="<?= $item['size'];?>" hidden>
                            <button type="submit" class="cart-delete-btn" name="delete" value="<?= $item['id'];?>">
                                <svg xmlns="http://www.w3.org/2000/svg" width="22" fill="currentColor"
                                    class="bi bi-trash-fill .cart-remove-item" viewBox="0 0 16 16">
                                    <path
                                        d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z" />
                                </svg>
                            </button>
                        </form>
                    </td>
                </tr>
                <?php } ?>

                <tr class="cart-footer-tr">
                    <td class="cart-checkout-btn-container" colspan="4">
                        <form action="">
                            <button class="cart-checkout-btn">PROCEED TO CHECKOUT</button>
                        </form>
                    </td>
                    <td>$ <?= $total;?></td>
                </tr>
            </tbody>
        </table>
        <?php } else { ?>
        <div class="cart-empty">
            <svg xmlns="http://www.w3.org/2000/svg" width="30" fill="currentColor" class="bi bi-bag-fill"
                viewBox="0 0 16 16">
                <path
                    d="M8 1a2.5 2.5 0 0 1 2.5 2.5V4h-5v-.5A2.5 2.5 0 0 1 8 1zm3.5 3v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4h-3.5z" />
            </svg>
            <h4>Your bag is empty</h4>
            <a href="./shop"><button class="cart-empty-btn">Go to Shop</button></a>
        </div>
        <?php } ?>
    </div>
</div>

<?php
include ("./inc/footer.php");
?>