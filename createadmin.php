<?php
$mysqli = @new mysqli("localhost", "root", "", "stadnik");
if ($mysqli->connect_errno) {
    die("Nie udało się zalogować");
}
$mysqli->set_charset('utf8');
$stmt = $mysqli->prepare("INSERT INTO users VALUES(?, ?, ?)");
$hashed = password_hash("admin", PASSWORD_BCRYPT, ['cost' => 6,]);
echo($hashed); 
$login = "admin";
$admin =1;
$stmt->bind_param("ssi", $login, $hashed,$admin);
$stmt->execute();
?>