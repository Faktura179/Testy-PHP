<?php
$mysqli = @new mysqli("localhost", "root", "", "stadnik");
if ($mysqli->connect_errno) {
    die("Nie udało się zalogować");
}
$mysqli->set_charset('utf8');
$stmt = $mysqli->prepare("INSERT INTO pytania VALUES(null,?, ?, ?, ?, ?, ?, 0, 0)");

$stmt->bind_param("ssssss", $_POST["pytanie"], $_POST["A"], $_POST["B"], $_POST["C"], $_POST["D"], $_POST["dobre"]);
$stmt->execute();

header("Location: admin.php?nav=addQue");
?>