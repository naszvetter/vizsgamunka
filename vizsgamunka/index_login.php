<!DOCTYPE html>
<?php
include_once 'include/connect.php';
//$connect = new mysqli('localhost' , 'root' , '' , 'sport_esemenyek');
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
    <title>S-port</title>
    <link rel="stylesheet" href="CSS/style_login.css">
</head>
<body>

<div id="wrapper">  <!--Ezzel állítom az oldal tartalmát középre-->
  <div id="kep">
    <img src="IMG\sport.jpg" alt="S-port">
  </div>
<header>
  <h2>Üdvözöllek a S-port oldalon!</h2>
</header>
    <form action="index_login_v2.php" method="POST">
       
        <legend>Bejelentkezés</legend><br>
        email<input type="email" name="email" ><br><br>
        jelszó<input type="password" name="jelszo" ><br><br>
        <input value="Bejelentkezés" type="submit" name="submit"/>
        <a href="lacalhost/vizsgamunka/index_registration.php"><button>Regisztráció</button></a>
    
    </form>
    <?php
    if(!empty($errors))
    {
        foreach($errors as $key)
        {
            echo $key."<br/>";
        }
    }

    ?>
</div>

</body>


</html>