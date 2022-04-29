<!DOCTYPE html>
<?php
include_once 'include/connect.php';
//ellenőrzi, hogy minden adat kitöltésre került-e
  if(isset($_POST['submit']))
    {
        $errors = array();
        $true = true;
        if(empty($_POST['felhasznalo_nev']))
        {
            $true=false;
            array_push($errors, "A felhasználói név üres");
        }
        if(empty($_POST['email']))
        {
            $true=false;
            array_push($errors, "Az e-mail üres");
        }
        if(empty($_POST['jelszo']))
        {
            $true=false;
            array_push($errors, "A jelszó üres");
        }
        if(empty($_POST['jelszo_ujra']))
        {
            $true=false;
            array_push($errors, "A jelszó megerősítése üres");
        }
        //ellenőrzi, hogy a megadott jelszó és a megerősítés egyforma-e
        if(!($_POST['jelszo']==$_POST['jelszo_ujra']))
        {
            $true=false;
            array_push($errors,"A jelszavak nem egyeznek meg!");
        }
        if($true)
        {
            //regisztráció
            $felhasznalo_nev=mysqli_real_escape_string($connect, $_POST['felhasznalo_nev']);
            $email=mysqli_real_escape_string($connect, $_POST['email']);
            $jelszo=mysqli_real_escape_string($connect, $_POST['jelszo']);
            $jelszo=md5($jelszo);

            $sql="INSERT INTO felhasznalok(felhasznalo_nev, jelszo, email) VALUES('$felhasznalo_nev','$jelszo','$email')";
            $connect-> query($sql);
            session_start();
            $_SESSION['email']=$email;
            //amennyiben a regisztráció sikeres, a bejelenkezés oldalra lép
            header('location:index_login.php');
        }
    }
    $connect->close();
?>
<html lang="HU">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="icon" type="image/png" sizes="32x32" href="IMG/favicon2.png">
    <link rel="stylesheet" href="CSS/style_registration.css">
    
    <title>Regisztráció</title>
    
</head>
<body>

<!--NAVbar start-->

  <header>
    <a href="./HTML/AFSZ.html" class="logo">S-port</a>
    <div id="toggle"></div>
    <div id=navbar>
      <ul>
        <li><a href="./HTML/about_us.html">Rólunk</a></li>
        <li><a href="./HTML/AFSZ.html">Adatkezelés</a></li>
      </ul>
    </div>
  </header>
  
<!-- script kód a NAVbar-hoz-->

<script src="js/navbar.js"></script>
  
<!--NAVbar finish-->
  
<!--Registration start-->

    <form action="index_registration.php" method="POST">
      <div class="container-login">
          <div class="login-form">
              <div class="login">
                <h3>Regisztráció</h3>
              </div>
              <input type="text" name="felhasznalo_nev" placeholder="Felhasználónév">
              <input type="email" name="email" placeholder="email">
              <input type="password" name="jelszo" placeholder="jelszó">
              <input type="password" name="jelszo_ujra" placeholder="jelszó mégegyszer">
              <input class="btn" value="Regisztráció" type="submit" name="submit"/>
          </div>
      </div>    
    </form>

<!--Registration finish-->

    <?php
    //ha valamilyen adat hiányzik, akkor azt kiírja
    if(!empty($errors))
    {
        foreach($errors as $key)
        {
            echo $key."<br/>";
        }
    }

    ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</body>

</html>