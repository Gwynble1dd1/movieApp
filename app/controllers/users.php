<?php 
include  SITE_ROOT . "/app/database/db.php";

$errMSG =[];

function UserAuth($param){
    $_SESSION['id'] = $param['id'];
    $_SESSION['login'] = $param['login'];
    $_SESSION['wallet'] = $param['wallet'];
    header('location: '. BASE_URL);
};

// registration new user

if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['button-reg'])){
    $login = trim($_POST["login"]);
    $pass_first = trim($_POST["pass-first"]);
    $pass_second = trim($_POST["pass-second"]);

    if($login === '' || $pass_first === ''){
        array_push($errMSG, 'Not all field filled');
    }elseif (mb_strtolower($login, 'UTF-8') < 2){
        array_push($errMSG,'Login can not be shorter 2 symbols');
    }elseif ($pass_first !== $pass_second) {
        array_push($errMSG,'Passwords not same');
    }
    else{
        $exist = selectOne('users', ['login'=> $login]);
        if(!empty($exist['login'])){
            array_push($errMSG, 'User with this login is exist');
        }else{
            
            $user = [
                "login"=> $login,
                "password"=> $pass_second
            ];
        
            $id = insert('users', $user);
            $user = selectOne('users', ['id' => $id]);
            
            UserAuth($user);
 
            // $errMSG = "<div style ='color: green;'> User <strong> $login </strong> has beed created </div>";
        }
    }
    }else{
        $login = '';
    };

if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['button-log'])){
    $login = trim($_POST["login"]);
    $password = trim($_POST["password"]);
    
    if($login === '' || $password === ''){
        array_push($errMSG, 'Not all field filled');
    }else{
        $exist = selectOne('users', ['login'=> $login]);
        if($exist && $password === $exist['password']){
            UserAuth($exist);
        }else{
            array_push($errMSG, 'Wrong login or password!');
        }}

}else{
    $login = '';
}
?>