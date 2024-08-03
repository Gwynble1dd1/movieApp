<?php
include "path.php";
include "app/controllers/users.php"; 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Film Store</title>
        <!-- Bootstrap 5 -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <!-- Font Awesome -->
        <script src="https://kit.fontawesome.com/4cdb3a5b68.js" crossorigin="anonymous"></script>
        <!--  Google Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Comfortaa:wght@300..700&display=swap" rel="stylesheet">
        <!-- My css -->
        <link rel="stylesheet" href="css/style.css">
</head>
<body>
<!-- HEADER -->
    <?php include("app/includes/header.php");?>

    <div class="container reg_form">
        <form class="row justify-content-center" method="post" action="./log.php">
            <h2>Auth Form</h2>
            <div class="mb-3 col-12 col-md-4 error">
                <p>
                    <?php include("app/includes/errorInfo.php") ?>
                </p>
            </div>

            <div class="w-100"></div>
            <div class="mb-3 col-12 col-md-4">
                <label for="formGroupExampleInput" class="form-label">Login</label>
                <input name="login" type="text" value="" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
            </div>
            <div class="w-100"></div>
            <div class="mb-3 col-12 col-md-4">
                <label for="exampleInputPassword1" class="form-label">Password</label>
                <input type="password" name="password" class="form-control" id="exampleInputPassword1">
            </div>
            <div class="w-100"></div>
            <div class="mb-3 col-12 col-md-4">
                <button type="submit" name="button-log" class="btn btn-secondary">Log In</button>
                <a href="auth.php">Registration</a>
            </div>
        </form>
    </div>  

<!-- FOOTER -->
    <?php include("app/includes/footer.php");?>
</body>
</html>