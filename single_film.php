<?php
    include 'path.php';
    include SITE_ROOT . "\app\controllers\\film.php";
    $movie = selectOne('films', ['films_id'=> $_GET['id']]);

    $movie_price = $movie['price'];
    $money = moneyOnWallet($_SESSION['id']);
    deleteMoney($_SESSION['id'], $movie_price);
    $_SESSION['wallet'] = $money['wallet'];
    addFilmToPurchases($_GET['id'],$_SESSION['id']);
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
    <div class="container">
        <video width="320" height="240" controls>
        <source src="video/<?=$movie['film_name']?>" type="video/mp4">
        Your browser does not support the video tag.
        </video>
    </div>
<!-- FOOTER -->
    <?php include("app/includes/footer.php");?>
</body>
</html>