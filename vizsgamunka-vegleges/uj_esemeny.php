<!DOCTYPE html>
<?php
include_once 'include/connect.php';

  if(isset($_POST['submit']))
    {
        $errors = array();
        $true = true;
        if(empty($_POST['esemeny_nev']))
        {
            $true=false;
            array_push($errors, "Az esemény név üres");
        }
        if(empty($_POST['esemeny_hely']))
        {
            $true=false;
            array_push($errors, "Az esemény helye üres");
        }
        if(empty($_POST['esemeny_ido']))
        {
            $true=false;
            array_push($errors, "Az esemény időpontja üres");
        }
        if(empty($_POST['esemeny_leiras']))
        {
            $true=false;
            array_push($errors, "Az esemény leírás üres");
        }
        if($true)
        {
            //új esemény rögzítése
            $esemenynev=mysqli_real_escape_string($connect, $_POST['esemeny_nev']);

            $sportag=mysqli_real_escape_string($connect, $_POST['sportag']);
            $query_sportagid= ("SELECT sport_id FROM sportok WHERE sport_nev= '$sportag' "); 
            $sportagid1= mysqli_query($connect, $query_sportagid) OR die('error');
            if(mysqli_num_rows($sportagid1)>0)
             {
              while($row=mysqli_fetch_assoc($sportagid1))
             {
              $sportagid= $row['sport_id']; 
             }
            }

            $esemenyhely=mysqli_real_escape_string($connect, $_POST['esemeny_hely']);
            $query_telepulesektelepulesid= ("SELECT telepules_id FROM telepulesek WHERE telepules_nev= '$esemenyhely' "); 
            $telepulesektelepulesid1= mysqli_query($connect, $query_telepulesektelepulesid) OR die('error');
            if(mysqli_num_rows($telepulesektelepulesid1)>0)
             {
              while($row=mysqli_fetch_assoc($telepulesektelepulesid1))
             {
              $telepulesektelepulesid= $row['telepules_id']; 
             }
            }

            $esemenyido=mysqli_real_escape_string($connect, $_POST['esemeny_ido']);
            $esemenyleiras=mysqli_real_escape_string($connect, $_POST['esemeny_leiras']);

            $esemenyhely2="";
            $fdate= strtotime($esemenyido);
            $fdate= date("Y/m/d", $fdate);

            $sql="INSERT INTO esemenyek(esemeny_nev, sport_id,esemeny_ido , esemeny_leiras, telepulesek_telepules_id) VALUES('$esemenynev','$sportagid','$fdate','$esemenyleiras', '$telepulesektelepulesid')";
            $connect-> query($sql);
            //session_start();
           // $_SESSION['esemeny_nev']=$esemenynev;
            header('location:uj_esemeny.php');
        }
    }
    
?>

<html lang="HU">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="icon" type="image/png" sizes="32x32" href="IMG/favicon2.png">
    <link rel="stylesheet" href="CSS/uj_esemeny.css">
    <link rel="stylesheet" type="text/css" href="CSS/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="CSS/jquery-ui.css">
    <script type="text/javascript" src="js/jquery-1.12.4.js" ></script>
    <script type="text/javascript" src="js/jquery-ui.js" ></script>
    <script type="text/javascript">

  $( function() {
    $( "#from" ).datepicker();
    } );

    $( function() {
    $( "#to" ).datepicker();
    } );

  </script>
    
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
        <li><a href="HTML/about_us.html">Rólunk</a></li>
        <li><a href="#">Kijelentkezés</a></li>
      </ul>
    </div>
  </header>
  
<!-- script kód a NAVbar-hoz-->

<script src="js/navbar.js"></script>
  
  <!-- NAVbar vége -->
  
<div class="section">
<div class=""><h2 style="text-align: center; font-weight: bold">Hozd létre saját sporteseményed</h2></div>


<div class="container">
<div class="row"> 
    <form class="form-horizontal" action="uj_esemeny.php" method="POST">
    
    <div class="form-group">
      <label class="col-lg-2 control-label"></label>
      <div class="col-lg-4">
        <input type="text" name="esemeny_nev" class="radius" placeholder="Esemény neve">
      </div>
    </div>
    
    <!-- EZ LESZ A SPORTÁG VÁLASZTÓ, EHEZ ÍRD A PHP-T -->

    <div class="form-group">
      <label></label>
      <div class="col-lg-4">  
        <select name="sportag" class="radius" > 
        <option>Sportág választása</option>
        <?php
        $result3=mysqli_query($connect,"SELECT * from sportok");
        while($row=mysqli_fetch_array($result3))
        {
         $sport=$row['sport_nev'];
        echo "<option> $sport </option>";
        } 
        ?>
        </select>
        </div>
    </div>

    <div class="form-group">
      <label></label>
      <div class="col-lg-4">
        <select name="esemeny_hely" class="radius"> 
          <option>Esemény helye</option>
            <?php
            $result2=mysqli_query($connect,"SELECT * from telepulesek");
            while($row=mysqli_fetch_array($result2))
            {
              $telepules=$row['telepules_nev'];
              echo "<option> $telepules </option>";
              } 
              ?>
        </select>
      </div>
    </div>

    <div class="form-group">
        <label class="col-lg-2 control-label"></label>
      <div class="col-lg-4">
          <input type="text" name="esemeny_ido" id="from" class="radius" placeholder="Esemény időpontja">
      </div>
    </div>

    <div class="form-group">
      <label class="col-lg-2 control-label"></label>
      <div class="col-lg-4">
        <input type="text" name="esemeny_leiras" class="radius" maxlength="200" placeholder="Esemény részletei (max. 200 karakter)">
      </div>
    </div>

    

    <div class="form-group">
      <label class="col-lg-2 control-label"></label>
      <div class="col-lg-4">
        <input type="submit" name="submit" class="btn1 btn-danger radius" value="Rögzítés">
      </div>
    </div>
  </form>
    </form>
  </div>
</div>
</div>



     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<?php

mysqli_close($connect);
?>


</body>
</html>