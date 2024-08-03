<?php
include "path.php";
include "app/controllers/profile.php";
$movies=selectAll('films');
$purchasedMovies = selectPurchasedFilms($_SESSION['id']);
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

    <?php include("app/includes/header.php");?>
<div class="container">
    <div class="col-md-5 border-right">
        <div class="p-3 py-5">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h4 class="text-right">Profile Settings</h4>
            </div>
            <form method="post" action="./profile.php" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?=$_SESSION['id'];?>">
            <div class="row mt-2">
                <div class="col-6">
                    <label class="labels">Login</label>
                    <input type="text" name="login" class="form-control" placeholder="login">
                </div>
                <div class="col-6">
                    <label class="labels">Password</label>
                    <input type="text" name="password" class="form-control" placeholder="password">

                </div>
            </div>
                
            <div class="row">
                <div class="col-6">
                    <button class="btn btn-primary profile-button" type="submit" name="update-login">Update Login</button>
                </div>
                <div class="col-6">
                    <button class="btn btn-primary profile-button" type="submit" name="update-password">Update Password</button>
                </div>
            </div> 
        </div>
    </div>
    <div class="upload_movie">
        <label for="add_video">Click to upload an video</label><br>
        <input name="add_video" id="add_video" type="file">
        <input name="price" type="number" placeholder="PRICE, 100$ by default">
        <button type="submit" class="btn btn-primary profile-button" name="add_video" id="add_video">submit</button>
    </div>
    </>

    <div class="row title-table">
        <h2 class="row">Bought Films</h2>
        <div class="col-8">Name</div>
        <div class="col-4">Price</div>
    </div>
    <?php foreach ($purchasedMovies as $film):?>
    <div class="row title-table">
        <div class="col-8"><?=$film['film_name'];?></div>
        <div class="col-4"><?=$film['price'];?>$</div>
    </div>
    <?php endforeach;?>
</div>
    <?php include("app/includes/footer.php");?>
</body>
</html>