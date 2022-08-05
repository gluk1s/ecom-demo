<?php 
$title = "Cart";
include ("./inc/header.php");
include ("./models/Item.php"); 
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
// print_r($arrOfItems);
foreach($arrOfItems as $item) {
    print_r($item);
}

?>

<div class="cart-container">
    <div class="table-container">
        <?php if (count($arrOfItems) > 0) { ?>
        <table class="table">
            <thead>
                <tr class="cart-th-tr">
                    <th class="cart-th" scope="col">Product</th>
                    <th class="cart-th" scope="col">Size</th>
                    <th class="cart-th" scope="col">Price</th>
                    <th class="cart-th" scope="col">Qty</th>
                    <th class="cart-th" scope="col">Total</th>

                </tr>
            </thead>
            <tbody>
                <?php foreach($arrOfItems as $item) { ?>
                <tr class="cart-td-tr">
                    <td scope="row">
                        <div class="cart-item-image-container">
                            <img class="cart-item-image" src="./public/items/<?= $item['img_dir1'];?>" alt="">
                        </div>
                        <div class="cart-item-name"><p><?= $item['name'];?></p></div>
                    </td>
                    <td><?= $item['size'];?></td>
                    <td>$ <?= $item['price'];?></td>
                    <td><?= $item['qty'];?></td>
                    <td>$ <?php echo ($item['qty'] * $item['price']); ?></td>
                </tr>
                <?php } ?>
                
            </tbody>
        </table>
        <?php } else { ?>
        <div class="cart-empty">

        </div>
        <?php } ?>
    </div>
</div>

<?php
include ("./inc/footer.php");
?>