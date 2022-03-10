<!DOCTYPE html>
<?php
include_once 'include/connect.php';
?>
<html lang="HU">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="icon" type="image/png" sizes="32x32" href="IMG/favicon2.png">
    <link rel="stylesheet" href="CSS/esemenyek.css">
    
    
    <title>Események</title>

<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container">
    <a class="navbar-brand" href="#">S-port</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="../vizsgamunka/uj_esemeny.php">Új esemény léterhozása</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Rólunk</a>
      </ul>
    </div>
  </div>
</nav>
    <div>
        <div>
            <header>
                <nav>
                    <ul>
                        <li><a href="">Események keresése</a></li>
                        <li><a href="../vizsgamunka/uj_esemeny.php">Új esemény léterhozása</a></li>
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
//legördülő lista- sportok
$result=mysqli_query($connect,"select * from sportok");


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

//legördülő lista- települések
$result2=mysqli_query($connect,"select * from telepulesek");

echo"<hr/>";
echo"<select>";
echo"<option>---válassz települést!--</option>";
while($row=mysqli_fetch_array($result2))
{
    echo"<option>$row[telepules_nev]</option>";
}
echo"</select>";
mysqli_close($connect);
?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</body>
</html>