<?php
$mysqli = @new mysqli("localhost", "root", "", "stadnik");
if ($mysqli->connect_errno) {
    die("Nie udało się zalogować");
}
$mysqli->set_charset('utf8');
$stmt = $mysqli->prepare("UPDATE pytania SET pytanie = ?, A = ?, B = ?, C = ?, D = ?, dobra = ? WHERE ID = ?");

$stmt->bind_param("sssssss", $_POST["pytanie"], $_POST["A"], $_POST["B"], $_POST["C"], $_POST["D"], $_POST["dobre"], $_POST["ID"]);
$stmt->execute();

header("Location: admin.php?nav=pyt");

?>