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
    <link rel="stylesheet" href="CSS/esemenyek.css">
    <link rel="stylesheet" type="text/css" href="CSS/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="CSS/jquery-ui.css"-->
    <link rel="icon" type="image/png" sizes="32x32" href="IMG/favicon2.png">
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


    <title>Események</title>
</head>
<body>

  <!--Itt kezdődik a NAVbar-->

  <header>
    <a href="#" class="logo">S-port</a>
    <div id="toggle"></div>
    <div id=navbar>
      <ul>
        <!--li><a href="#">Események</a></li-->
        <li><a href="./uj_esemeny.php">Új esemény léterhozása</a></li>
        <li><a href="HTML/about_us.html">Rólunk</a></li>
        <li><a href="#">Kijelentkezés</a></li>
      </ul>
    </div>
  </header>
  
<!-- script kód a NAVbar-hoz-->

  <script src="js/navbar.js"></script>
  
<!-- NAVbar vége -->

<div class="section">
<div class="container">
<h2 style="text-align: center;font-weight:bold"> Sport események közötti keresés</h2>

  <div class="row">
  <label></label>
    <form class="form-horizontal" action="esemenyek.php" method="POST">
  
    <div class="form-group">
          <label></label>
          <div class="col-lg-4">  
            <select name="sportag" class="radius" > 
            <option>Sportág választása</option>
            <?php
            $result3=mysqli_query($connect,"select * from sportok");
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
            <select name="esemeny_hely" class="radius" > 
            <option>Település választása</option>
            <?php
            $result2=mysqli_query($connect,"select * from telepulesek");
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
      <label></label>
        <div class="col-lg-4">
          <input type="text" name="esemeny_ido" id="from" class="radius" placeholder="Időpont">
        </div>
      </div>

      <div class="form-group">
      <label></label>
        <div class="col-lg-4">
          <input type="submit" name="submit" class="radius btn1 btn-danger" value="Keresés">
        </div>
      </div>

  </form>
  </div>
</div>
</div>


      
<div class="container">
  <div class="table my-3">     
    <div class="row headcolor">
      <div class="col-sm-3 d-none d-sm-block text-white text-center fs-4 fw-bolder">Esemény név</div>
      <div class="col-sm-3 d-none d-sm-block text-white text-center fs-4 fw-bolder">Esemény helye</div>
      <div class="col-sm-3 d-none d-sm-block text-white text-center fs-4 fw-bolder">Esemény időpontja</div>
      <div class="col-sm-3 d-none d-sm-block text-white text-center fs-4 fw-bolder reszletek">Részletek</div>
    </div>
        
    <?php
    include_once 'include/connect.php';
    if(isset($_POST['submit'])) 
    {
        $telepulesek=$_POST['esemeny_hely'];
        $sportok=$_POST['sportag'];
        $fromdate=$_POST['esemeny_ido'];
        $fdate= strtotime($fromdate);
        $fdate= date("Y/m/d", $fdate);
    
    if ($telepulesek != "" || $fromdate != "" || $sportok!="")
    {
     $query= ("SELECT esemenyek.esemeny_nev , esemenyek.sport_id , esemenyek.telepulesek_telepules_id , esemenyek.esemeny_ido , esemenyek.esemeny_leiras FROM (esemenyek INNER JOIN telepulesek ON esemenyek.telepulesek_telepules_id=telepulesek.telepules_id) INNER JOIN sportok ON esemenyek.sport_id=sportok.sport_id WHERE esemeny_ido='$fdate' OR telepulesek.telepules_nev ='$telepulesek' OR sportok.sport_nev='$sportok'"); 
     $data= mysqli_query($connect, $query) OR die('error');
  
      if(mysqli_num_rows($data)>0)
      {
          while($row=mysqli_fetch_assoc($data))
          {
              $esemenyneve= $row['esemeny_nev'];  
            //  $telepulesek1= $row['esemeny_hely'];
              $telepulesid= $row['telepulesek_telepules_id']; 
              $fromdate= $row['esemeny_ido'];
              $esemenyleiras= $row['esemeny_leiras'];

              $query_telepulesid= ("SELECT telepules_nev FROM telepulesek WHERE telepules_id= '$telepulesid' "); 
              $telepid1= mysqli_query($connect, $query_telepulesid) OR die('error');
              if(mysqli_num_rows($telepid1)>0)
              {
                while($row=mysqli_fetch_assoc($telepid1))
                  {
                    $telepid= $row['telepules_nev']; 
                  }
              } 
          
             ?>
            <div class="row tablecolor">
              <div class="col-lg-3 fs-5 text-center fw-bold"><?php echo $esemenyneve; ?></div>
              <div class="col-lg-3 fs-5 text-center fw-bold"><?php echo $telepid; ?></div>
              <div class="col-lg-3 fs-5 text-center fw-bold"><?php echo $fromdate; ?></div>
              <div class="col-lg-3 fs-5 text-center fw-bold"><?php echo $esemenyleiras; ?></div>
            </div> 
            <?php 
          } 
      }
      ?>
                 <!-- else{
                    <tr>
                      <td>Nincs találat!</td>
                    </tr> -->
   <?php

    }?>
    <?php
    }
    ?>
    </div> 
</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script

</body>
</html>