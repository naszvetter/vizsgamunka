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
    <link rel="stylesheet" href="CSS/esemenyek.css">
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
        <li><a href="../vizsgamunka/uj_esemeny.php">Új esemény léterhozása</a></li>
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

<div class="container">
<h3 style="text-align: center;font-weight:bold"> Sport események közötti keresés</h3>

  <div class="row">
  <label></label>
    <form class="form-horizontal" action="esemenyek.php" method="POST">
  
      <div class="form-group row">
      <label></label>
      <div class="col-sm-4">  
        <select name="esemeny_hely" class="form-control" > 
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
    <div class="col-sm-4">
      <input type="text" name="esemeny_ido" id="from" class="form-control" placeholder="Időpont">
    </div>
  </div>

  <div class="form-group">
  <label></label>
    <div class="col-sm-4">
      <input type="submit"name="submit" class="btn btn-primary" value="Keresés">
    </div>
  </div>

  </form>
  </div>
</div>


<div class="container">
<div class="row">
  <table class="table table-striped table-hoover">
    <thead>
      <tr>
        <td>Esemény név</td>
        <td>Esemény helye</td>
        <td>Esemény időpontja</td>
        <td>Részletek</td>
      </tr>
    </thead>
  
  <tbody>
    <?php
    include_once 'include/connect.php';
    if(isset($_POST['submit'])) 
    {
        $telepulesek=$_POST['esemeny_hely'];
        $fromdate=$_POST['esemeny_ido'];
        $fdate= strtotime($fromdate);
        $fdate= date("Y/m/d", $fdate);
    }
    if ($telepulesek != "" || $fromdate != "")
    {
     $query= ("SELECT * FROM esemenyek WHERE esemeny_hely= '$telepulesek' OR esemeny_ido='$fdate' "); 
     $data= mysqli_query($connect, $query) OR die('error');
  
      if(mysqli_num_rows($data)>0)
      {
          while($row=mysqli_fetch_assoc($data))
          {
              $esemenyneve= $row['esemeny_nev'];  
              $telepulesek= $row['esemeny_hely'];
              $fromdate= $row['esemeny_ido'];
              $esemenyleiras= $row['esemeny_leiras'];
          
             ?>
            <tr>
              <td><?php echo $esemenyneve; ?></td>
              <td><?php echo $telepulesek; ?></td>
              <td><?php echo $fromdate; ?></td>
              <td><?php echo $esemenyleiras; ?></td> 
            </tr> 
            <?php 
          } 
      }?>
      else{
        <tr>
          <td>Nincs találat!</td>
        </tr>
        }<?php

    }
    ?>
  </tbody>
  </table>
</div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script

</body>
</html>