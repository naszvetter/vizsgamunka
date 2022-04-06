<?php 

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sport_esemenyek";

$connect = new mysqli($servername, $username, $password, $dbname);
if ($connect->connect_error) {
    die("Sikertelen kapcsolódás: " . $connect -> connection_error);
} else {
    echo "sikeres kapcsolódás az adatbázishoz";
}

?>