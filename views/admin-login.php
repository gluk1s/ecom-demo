<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin login</title>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous">
    </script>
    <link rel="stylesheet" href="/projects/final_project/public/css/reset.css">
    <link rel="stylesheet" href="/projects/final_project/public/css/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>

<body>
    <?php 
    include ("./models/User.php");
    // auto logout if logged in
    if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_SESSION['login'])) {
        unset($_SESSION['login']);        
    }

    // login validation
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (!isset($_SESSION)) {
            session_start();
        }
        
        if (!isset($_SESSION['login'])) {
            $_SESSION['login'] = [];
        }

        $username = $_POST['username'];
        $password = $_POST['password'];

        $validated = User::validateUser($username, $password);

        if ($validated) {
            $user = array('type'=>'admin');
            $_SESSION['login'][] = $user;
            header("Location: http://localhost/projects/final_project/admin_homepage");
            exit();
        } else {
            header("Location: http://localhost/projects/final_project/admin");
            exit();
        }
    }
    
    $validation = User::validateUser('admin', 'admin');
    ?>
    <div class="admin-login-container">
        <form method="post">
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" id="username" name="username">
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Password</label>
                <input type="password" class="form-control" id="exampleInputPassword1" name="password">
            </div>
            <button type="submit" class="admin-login-btn">Login</button>
        </form>
    </div>

    <script src="/projects/final_project/public/js/app.js"></script>
</body>

</html>