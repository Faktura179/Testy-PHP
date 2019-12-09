<?php
session_start();
if($_SESSION["user"]==null){
    header("Location: index.php");
    if($_SESSION["admin"]!=true){
        header("Location: index.php");
    }
}
$mysqli = @new mysqli("localhost", "root", "", "stadnik");
if ($mysqli->connect_errno) {
    die("Nie udało się zalogować");
}
$mysqli->set_charset('utf8');
if($_GET["item"]=="user"){
    $stmt = $mysqli->prepare("DELETE FROM users WHERE username=?");
    $stmt->bind_param("s",$_GET["username"]);
    $stmt->execute();
} elseif($_GET["item"]=="question"){
    $stmt = $mysqli->prepare("DELETE FROM pytania WHERE ID=?");
    $stmt->bind_param("s",$_GET["ID"]);
    $stmt->execute();
}




header("Location: admin.php");
?>