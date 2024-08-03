<?php 
include  SITE_ROOT . "/app/database/db.php";

$errMSG = [];

function UserAuth($param){
    $_SESSION['id'] = $param['id'];
    $_SESSION['login'] = $param['login'];
    $_SESSION['wallet'] = $param['wallet'];
    header('location: '. BASE_URL);
};
if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update-login'])){

    $id= $_POST['id'];
    $login = trim($_POST["login"]);

    if($login === ''){
        array_push($errMSG, 'Any of field filled');
    }elseif (mb_strtolower($login, 'UTF-8') < 2){
        array_push($errMSG,'Login can not be shorter 2 symbols');
    }
    else{
        $exist = selectOne('users', ['login'=> $login]);
        if(!empty($exist['login'])){
            array_push($errMSG, 'User with this login is exist');
        }else{
                $user = [
                    "login"=> $login
                ];
                $id = update('users', $id, $user);
                $_SESSION['login'] = $login;
            }
        }
    };

if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update-password'])){
    $id= $_POST['id'];
    $password = trim($_POST["password"]);
    if($password === ''){
        array_push($errMSG, 'Any of field filled');
    }else{
        $user = [
            "password"=> $password
        ];
        $id = update('users', $id, $user);
    }
};

if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_video'])){
    $id= $_POST['id'];
    $price = $_POST['price'];
    $imgName = time()."_".$_FILES['add_video']['name'];
    $fileType = $_FILES['add_video']['type'];
    $imgTmp = $_FILES['add_video']['tmp_name'];
    $imgSize = $_FILES['add_video']['size'];

    $destination = ROOT_PATH . '\video\\'. $imgName;
    if(strpos($fileType, 'video') === false) {
        array_push($errMSG, 'Only video supported');
        header('location: '. 'profile.php');
        exit();
    }
    if(empty($price)){
        $price=100;
    }

    if(move_uploaded_file($imgTmp, $destination)){
        $_POST["img"] = $imgName;
        $movie= [
            'film_name'=> $imgName,
            'price' => $price
        ];
        insert('films', $movie);
    }else{
         array_push($errMSG, 'Error in uploading image to server');
    }
}



