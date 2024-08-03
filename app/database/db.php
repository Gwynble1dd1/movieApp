<?php
session_start();
require('connect.php');

function tt($value){
    echo '<pre>';
    print_r($value);
    echo '<pre>';
    exit();
}

// error debuging

function dbCheckError($query){
    $errorInfo = $query->errorInfo();

    if ($errorInfo[0] !== PDO::ERR_NONE) {
        echo $errorInfo[2];
        exit();
    }
    return true;
}

// select all from table

function selectAll($table, $params = []){
    global $pdo;
    $sql = "SELECT * FROM $table";

    if (!empty($params)) {
        $i = 0;
        foreach ($params as $key => $value) {
            if (!is_numeric($value)){
                $value = "'".$value."'";
            }
            if ($i === 0) {
                $sql = $sql . " WHERE $key = $value";
            }else{
                $sql = $sql . " AND  $key = $value";
            }
            $i++;
        }
    }
   
    $query = $pdo->prepare($sql);
    $query->execute();

    dbCheckError($query);
    return $query->fetchAll(); // выбрать все записи
}

//select one from one $table
function selectOne($table, $params = []){
    global $pdo;
    $sql = "SELECT * FROM $table";

    if (!empty($params)) {
        $i = 0;
        foreach ($params as $key => $value) {
            if (!is_numeric($value)){
                $value = "'". $value ."'";
            }
            if ($i === 0) {
                $sql = $sql . " WHERE $key = $value";
            }else{
                $sql = $sql . " AND  $key = $value";
            }
            $i++;
        }
    }

    $query = $pdo->prepare($sql);
    $query->execute();

    dbCheckError($query);
    return $query->fetch(); // choose only one record from
}


function insert($table, $params){
    global $pdo;
    $i = 0;
    $column = '';
    $mask = '';
    foreach ($params as $key => $value) {
        if ($i === 0){
            $column = $column . "$key";
            $mask = $mask . "'" . "$value" . "'";
        }else{
            $column = $column . ", $key";
            $mask = $mask . ", '" . "$value" ."'";
        }
        $i++;
    }

    $sql = "INSERT INTO $table ($column) VALUES ($mask)";

    $query = $pdo->prepare($sql);
    $query->execute();
    dbCheckError($query);
    return $pdo->lastInsertId();
}

// update parameters
function update($table, $id, $params){
    global $pdo;
    $i = 0;
    $str = '';
    foreach ($params as $key => $value) {
        if ($i === 0){
            $str = $str . $key . " = '" . $value . "'";
        }else {
            $str = $str .", " . $key . " = '" . $value . "'";
        }
        $i++;
    }

    $sql = "UPDATE $table SET $str WHERE id =" . $id;
    $query = $pdo->prepare($sql);
    $query->execute();
    dbCheckError($query);
}

function moneyOnWallet($id){
    global $pdo;
    
    $sql = "SELECT wallet from users where id =" . $id;
    $query = $pdo->prepare($sql);
    $query->execute();
    return $query->fetch();
};

function deleteMoney($id, $price){
    global $pdo;
    $wallet = moneyOnWallet($id);
    $newWallet = $wallet['wallet'] - $price;
    if ($newWallet < 0) {
        return "No money";
        
    }else{
        $sql = "UPDATE users SET wallet = $newWallet WHERE id =" . $id;
        $query = $pdo->prepare($sql);
        $query->execute();
        return $query->fetch();
    }
}


function addFilmToPurchases($id_film, $id_user){
    global $pdo;
    $sql = "INSERT INTO purchases (bought_film, user_id) VALUES ($id_film, $id_user)";

    $query = $pdo->prepare($sql);
    $query->execute();
    dbCheckError($query);
    return $pdo->lastInsertId();
}

function selectPurchasedFilms($id){
    global $pdo;    
    $sql = "SELECT 
    films.films_id, 
    films.film_name, 
    films.price, 
    purchases.user_id, 
    users.login 
FROM 
    purchases 
INNER JOIN 
    films 
ON 
    CAST(purchases.bought_film AS UNSIGNED) = films.films_id 
INNER JOIN 
    users 
ON 
    purchases.user_id = users.id 
WHERE 
    users.id = ". $id;

    $query = $pdo->prepare($sql);
    $query->execute();
    dbCheckError($query);
    return $query->fetchAll();
}

?>