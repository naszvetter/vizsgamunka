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

  <!--Itt kezdődik a NAVbar-->

  <header>
    <a href="#" class="logo">S-port</a>
    <div id="toggle"></div>
    <div id=navbar>
      <ul>
        <!--li><a href="#">Események</a></li-->
        <li><a href="../vizsgamunka/uj_esemeny.php">Új esemény léterhozása</a></li>
        <li><a href="#">Rólunk</a></li>
        <li><a href="#">Kijelentkezés</a></li>
      </ul>
    </div>
  </header>
  
<!-- script kód a NAVbar-hoz-->
  <script>
    const header = document.getElementById('header');
    const toggle = document.getElementById('toggle');
    const navbar = document.getElementById('navbar');
    
    document.onclick = function(e){
      if(e.target.id !== 'header' && e.target.id !== 'toggle' && e.target.id !== 'navbar'){
        toggle.classList.remove('active');
        navbar.classList.remove('active');
      }
    }
    
    toggle.onclick = function(){
      toggle.classList.toggle('active');
      navbar.classList.toggle('active');
    }
  </script>

<!-- NAVbar vége -->

<div id="carouselExampleFade" class="carousel slide carousel-fade" data-bs-ride="carousel">
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="IMG/esemenyek2.png" class="d-block w-300" alt="...">
    </div>
    <div class="carousel-item">
      <img src="IMG/login2.png" class="d-block w-300" alt="...">
    </div>
    <div class="carousel-item">
      <img src="IMG/uj_esemeny2.png" class="d-block w-300" alt="...">
    </div>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
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