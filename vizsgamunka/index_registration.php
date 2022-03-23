<!DOCTYPE html>
<?php
include_once 'include/connect.php';

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
            session_start();
            $_SESSION['email']=$email;
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

<! --Itt kezdődik a NAVbar -->

  <header>
    <a href="#" class="logo">S-port</a>
    <div id="toggle"></div>
    <div id=navbar>
      <ul>
        <li><a href="#">Események</a></li>
        <li><a href="#">Új esemény léterhozása</a></li>
        <li><a href="#">Rólunk</a></li>
        <li><a href="#">Kijelentkezés</a></li>
      </ul>
    </div>
  </header>
  



<! -- script kód a NAVbar-hoz -->
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

<! -- NAVbar vége -->

  
<! -- regisztáció start -->

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

<! -- regisztráció finish -->

    <?php
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