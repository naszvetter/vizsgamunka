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
    <link rel="stylesheet" href="CSS/uj_esemeny.css">
    
</head>
    <title>Új esemény</title>
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
          <a class="nav-link active" aria-current="page" href="../vizsgamunka/esemenyek.php">Események</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Rólunk</a>
      </ul>
    </div>
  </div>
</nav>

   

        
    
    <div><h2>Hozd létre saját sporteseményed</h2></div>

  

    <form action="uj_esemeny.php" method="POST"></form>
    
    

    <?php
//legördülő lista- sportok
$result=mysqli_query($connect,"select * from sportok");

echo"<hr/>";
echo"<select>";
echo"<option>---válassz sportágat!--</option>";
while($row=mysqli_fetch_array($result))
{
    echo"<option>$row[sport_nev]</option>";
}
echo"</select>";
//mysqli_close($connect);

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
<?php
        /*  <select name="sportagak" class="form-control">
            <?php
            $lekerdezes = mysqli_query($mysqli, "SELECT DISTINCT sport_nev FROM sportok");
            while ($sortomb = mysqli_fetch_assoc($lekerdezes)) {
              $sportnev = $sortomb['sport_nev'];
              echo "
                    <option value='$sportnev'>$sportnev</option>
                  ";
            }
            ?>
             </select><br><br>
             <button type="submit" name="f_submit" id="kalkgomb">Keresés</button>
        </form>*/
        ?>
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>


     
</body>
</html>