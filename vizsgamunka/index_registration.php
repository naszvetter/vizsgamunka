<!DOCTYPE html>
<?php
include_once 'include/connect.php';
//$connect = new mysqli('localhost' , 'root' , '' , 'sport_esemenyek');
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
            /*session_start();
            $_SESSION['username']=$username;
            header('location:home.php');*/
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

  

<!--header>
  <h2>Üdvözöllek a S-port oldalon!</h2>
</header-->
    <form action="index_registration.php" method="POST"></form>
       
        <!--legend>Itt tudsz regisztrálni</!--legend><br>
        felhasznaló név
        <input type="text" name="felhasznalo_nev"><br><br>
        email
        <input type="email" name="email" ><br><br>
        jelszó
        <input type="password" name="jelszo" ><br><br>
        jelszo_újra
        <input type="password" name="jelszo_ujra"><br><br>
        <input value="Regisztráció" type="submit" name="submit"/-->

    <div class="container-login">
      <div class="login-form">
        <div class="login">
          <h3>Regisztráció</h3>
        </div>
        <input type="text" name="ferlhasznalo_nev" placeholder="Felhasználónév"><br>
        <input type="email" name="email" placeholder="email"><br>
        <input type="password" name="jelszo" placeholder="jelszó">
        <input type="password" name="jelszo_ujra" placeholder="jelszó mégegyszer">
        <div class="btn">Regisztráció</div>
      </div>
    </div>
    
    
    <?php
    if(!empty($errors))
    {
        foreach($errors as $key)
        {
            echo $key."<br/>";
        }
    }

    ?>

<!--div><footer>Minden jog fenntartva</footer></!--div-->


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</body>


</html>