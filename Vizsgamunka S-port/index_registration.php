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
    <title>S-port</title>
    <link rel="stylesheet" href="CSS/style_registration.css">
</head>
<body>

<div id="wrapper">  <!--Ezzel állítom az oldal tartalmát középre-->
  <div id="kep">
    <img src="IMG\sport.jpg" alt="S-port">
  </div>
<header>
  <h2>Üdvözöllek a S-port oldalon!</h2>
</header>
    <form action="index_registration.php" method="POST">
       
        <legend>Regisztráció</legend><br>
        felhasznaló név<input type="text" name="felhasznalo_nev"><br><br>
        email<input type="email" name="email" ><br><br>
        jelszó<input type="password" name="jelszo" ><br><br>
        jelszo_újra<input type="password" name="jelszo_ujra"><br><br>
        <input value="Regisztráció" type="submit" name="submit"/>
    
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