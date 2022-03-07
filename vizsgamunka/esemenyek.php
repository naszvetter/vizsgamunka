<!DOCTYPE html>
<?php
include_once 'include/connect.php';
?>
<html lang="HU">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="">
    <title>Események</title>

<body  id="wrapper">
    <div>
        <div>
            <header>
                <nav>
                    <ul>
                        <li><a href="">Események keresése</a></li>
                        <li><a href="../sport_esemenyek/uj_esemeny.php">Új esemény léterhozása</a></li>
                    </ul>
                </nav>
            </header>
        </div>
    </div>
    
<?php        
 

$sql = "SELECT * FROM esemenyek";

$result = $connect->query($sql);

// eredmény kiíratása
if ($result->num_rows > 0) { // ha a lekérdezésnek van eredménye, akkor belépünk az if-be
  while($row = $result->fetch_assoc()) { // amíg van rekord, addig kiírom őket
    echo "id: " . $row["esemeny_id"]. ", esemény: " . $row["esemeny_nev"].", esemény ideje:". $row["esemeny_ido"].", esemény leírása".$row["esemeny_leiras"]. ", esemény helye:".$row["telepulesek_telepules_id"]. "<br>";
  }
} else {
  echo "A lekérdezésnek nincs eredménye."; // nincs eredmény
}
?>

<?php
//legördülő lista
$result=mysqli_query($connect,"select * from sportok");
// ha középre kell tenni echo"<center>";

echo"<h2> Kereshetsz az események között!</h2>";
echo"<hr/>";
echo"<select>";
echo"<option>---válassz sportágat!--</option>";
while($row=mysqli_fetch_array($result))
{
    echo"<option>$row[sport_nev]</option>";
}
echo"</select>";

echo"</center>";
mysqli_close($connect);
?>
</body>
</html>