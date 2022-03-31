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
    
 <!--Itt kezdődik a NAVbar-->

 <header>
    <a href="#" class="logo">S-port</a>
    <div id="toggle"></div>
    <div id=navbar>
      <ul>
        <li><a href="../esemenyek.php">Események</a></li>
        <!--li><a href="../vizsgamunka/uj_esemeny.php">Új esemény léterhozása</a></li-->
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

   

        
    
    <div><h2>Hozd létre saját sporteseményed</h2></div>

  <form action="uj_esemeny.php" method="POST"></form>

    
    
    

    <?php
//legördülő lista- sportok
/*$result=mysqli_query($connect,"select * from sportok");

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
echo"</select>";*/
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

<input type="date" id="start" name="trip-start"
       value="2018-07-22"
       min="2018-01-01" max="2018-12-31">

<div class="container">
  <div class="row">
    <div class="col-sm-12">
      <div class="card p-4">
        <form>
          <div class="form-group row">
            <label for="inputEmail3" class="col-sm-2 col-form-label">Sportág</label>
            <div class="col-sm-10">
              <select class="form-control">
              <option>---válassz sportágat!---</option>
            <?php
//legördülő lista- sportok
$result=mysqli_query($connect,"select * from sportok");
while($row=mysqli_fetch_array($result))
{
    echo"<option>$row[sport_nev]</option>";
}
?>
              </select>
            </div>
          </div>
          <div class="form-group row">
            <label for="inputEmail3" class="col-sm-2 col-form-label">Település</label>
            <div class="col-sm-10">
              <select>
                <option>---Válassz települést!---</option>
                <?php
                $result2=mysqli_query($connect,"select * from telepulesek");
                while($row=mysqli_fetch_array($result2))
{
    echo"<option>$row[telepules_nev]</option>";
}
?>

              </select>
            </div>
            <div class="form-group row">
            <label for="inputPassword3" class="col-sm-2 col-form-label">Időpont</label>
            <div class="col-sm-10">
              <input type="date" id="start" name="trip-start"
               value="2018-07-22"
              min="2018-01-01" max="2018-12-31">
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<?php

mysqli_close($connect);
?>

     
</body>
</html>