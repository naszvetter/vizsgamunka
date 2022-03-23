<!DOCTYPE html>
<?php
include_once 'include/connect.php';

  if(isset($_POST['submit']))
    {
        $errors = array();
        $true = true;
        
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

        if($true)
        {
            $email=mysqli_real_escape_string($connect, $_POST['email']);
            $jelszo=mysqli_real_escape_string($connect, $_POST['jelszo']);
            $jelszo=md5($jelszo);
            
            $sql="SELECT * FROM felhasznalok WHERE email = '$email' AND jelszo='$jelszo'";
            $query = $connect -> query ($sql);
            if (mysqli_num_rows($query) == 1)
              {
                  session_start();
                  $_SESSION['email'] = $email;
                  header('location: esemenyek.php');
              }
            else
              {
               array_push($errors, "Az emailcím és a jelszó nem megfeleő");
              }
              
            
          
        }
    }
    $connect->close();
?>
<html lang="HU">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!--Bootstrap CSS-->

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <!--Favicon-->

    <link rel="icon" type="image/png" sizes="32x32" href="IMG/favicon2.png">
    <link rel="stylesheet" href="CSS/style_login.css">
    
    <title>Bejelentkezés</title>
    
</head>
<body>

    <!--Itt kezdődik a NAVbar-->

  <header>
    <a href="#" class="logo">S-port</a>
    <div id="toggle"></div>
    <div id=navbar>
      <ul>
        <li><a href="#">Események</a></li>
        <li><a href="#">Új esemény léterhozása</a></li>
        <li><a href="#">Rólunk</a></li>
        <!--li><a href="#">Kijelentkezés</a></li-->
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


     <form action="index_login.php" method="POST">
        <div class="container-login">
          <div class="login-form">
            <div class="login">
              <h3>Bejelentkezés</h3>
            </div>
            <input type="text" name="email" placeholder="email"><br>
            <input type="password" name="jelszo" placeholder="jelszó"><br>
            <!-- ez még nem szép, de nekem a bejelentkezéshez input mező kellene, hogy áttudja adni az adatokat -->
            <input class="btn" value="Bejelentkezés" type="submit" name="submit">
            <a href="./index_registration.php">
                <div class="btn">Regisztráció</div></a>
          </div>      
        </div>
      </form>



    <footer></footer>

    <?php
    if(!empty($errors))
    {
        foreach($errors as $key)
        {
            echo $key."<br/>";
        }
    }

    ?>


  <!--Bootstrap Bundle with Popper-->
  
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>




</body>


</html>


<!--nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container">
    <a class="navbar-brand" href="#">S-port</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse"     id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="../vizsgamunka/esemenyek.php">Események</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Rólunk</a>
        </li>
      </ul>
      <form class="d-flex">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success" type="submit">Search</button>
      </form>
    </div>
  </div>
</!--nav>