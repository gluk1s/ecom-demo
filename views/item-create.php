<?php 
$title = "Item create";
include ("./inc/header-admin.php");
include ("./models/Item.php");


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $validated = validateInputs($_POST['name'], 
        $_POST['price'],
        $_POST['gender'],
        $_POST['type']);
    if ($validated) {
        include ("./upload.php");
        if ($uploadOk = 1) {
            $item = new Item(
                $_POST['name'],
                floatval($_POST['price']),
                $_POST['gender'],
                $_POST['type'],
                $target_file_name1,
                $target_file_name2,
                $target_file_name3
            );
            $item->addItemToDB();
        } else {
            header("Location: http://localhost/projects/final_project/item/create");
            exit();
        }
    } else {
        header("Location: http://localhost/projects/final_project/item/create");
        exit();
    }

    header("Location: http://localhost/projects/final_project/admin_homepage");
    exit();

}

?>

<!-- HTML Code -->
<div class="item-page-container">
    <div class="container">
        <form action="" method="post" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-6">
                    <div class="">
                        <div class="">
                            <label for="formFile" class="form-label">Image picture 1:</label>
                            <input class="form-control" type="file" id="formFile1" name="fileToUpload1">
                        </div>
                        <div class="">
                            <label for="formFile" class="form-label">Image picture 2:</label>
                            <input class="form-control" type="file" id="formFile2" name="fileToUpload2">
                        </div>
                        <div class="">
                            <label for="formFile" class="form-label">Image picture 3:</label>
                            <input class="form-control" type="file" id="formFile3" name="fileToUpload3">
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="item-info">
                        <label class="admin-item-first-label" for="itemName" class="form-label ">Item brand
                            (name)</label>
                        <input type="text" class="form-control" id="itemName" name="name">

                        <label for="itemPrice" class="form-label admin-item-title">Item price ($)</label>
                        <input type="text" class="form-control" id="itemPrice" name="price">

                        <h4 class="admin-item-title">Gender:</h4>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="gender" value="M" id="male">
                            <label class="form-check-label" for="male">
                                Male
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="gender" value="F" id="female">
                            <label class="form-check-label" for="female">
                                Female
                            </label>
                        </div>

                        <h4 class="admin-item-title">Type:</h4>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="type" value="clothes" id="clothes">
                            <label class="form-check-label" for="clothes">
                                Clothes
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="type" value="accessories"
                                id="accessories">
                            <label class="form-check-label" for="accessories">
                                Accessories
                            </label>
                        </div>
                    </div>
                    <div class="item-form-container">

                        <div class="item-form-btn-container">
                            <button type="submit" class="btn-to-cart">Add New Item</button>
                        </div>

                    </div>
                </div>
            </div>
        </form>
    </div>

    <?php 
include("./inc/footer-admin.php"); 
?>

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