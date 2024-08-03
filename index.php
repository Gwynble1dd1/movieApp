<?php
include 'path.php';
include SITE_ROOT . "\app\controllers\users.php";
$movies=selectAll('films');
if(isset($_SESSION['id'])){
    $money = moneyOnWallet($_SESSION['id']);
    $_SESSION['wallet'] = $money['wallet'];
}
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

    <!-- BODY -->
    <div class="container">
        <div class="row">
            <?php foreach($movies as $movie): ?>
            <div class="card col-4" style="width: 16rem; margin: 1.5rem 2rem 0 0;">
                <img class="card-img-top" src="img/film-stocks.jpg" alt="Card image cap">
                <div class="card-body">
                    <h5 class="film_name"><?=$movie['film_name']?></h5>
                    <p class="card-text">PRICE: <?=$movie['price']?>$</p>
                    <?php if(isset($_SESSION['id'])):?>
                    <a href="single_film.php?id=<?=$movie['films_id']?>" class="btn btn-primary" name="buy-movie">Buy movie</a>
                    <?php else:?>
                    <a href="" class="btn btn-primary">Register before</a>
                    <?php endif;?>
                </div>
            </div>
            <?php endforeach?>


        </div>
    </div>

<!-- FOOTER -->

<?php include("app/includes/footer.php");?>


</body>
</html>