<?php
session_start();

include("path.php");

unset($_SESSION['id']);
unset($_SESSION['login']);
unset($_SESSION['wallet']);
session_destroy();

header('location: '. BASE_URL);
?>