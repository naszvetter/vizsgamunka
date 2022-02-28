<?php

function eu_osszes_eauto() {
  include 'connect.php';
  $query = "SELECT CONCAT(FORMAT(SUM(eu_world.elektromos),0),' db')  AS osszes_eu FROM eu_world";
  $result = mysqli_query($connect, $query);
    if (mysqli_num_rows($result) > 0) {
      while ($row = mysqli_fetch_array($result)) {
              echo $row['osszes_eu'];
      }
    }
}

function osszes_auto(){
  include 'connect.php';
  $query = "SELECT CONCAT(FORMAT(SUM(eu_world.hagyomanyos),0),' db')  AS osszes_auto FROM eu_world";

  $result = mysqli_query($connect, $query);
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_array($result)) {
            echo $row['osszes_auto'] ;
        }
    }
}

function eu_world_arany(){
include 'connect.php';
$query =  "SELECT FORMAT((SUM(eu_world.elektromos)) / (SUM(eu_world.hagyomanyos)) * 100 ,2) AS arany FROM eu_world";

  $result = mysqli_query($connect, $query);
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_array($result)) {
            echo $row['arany']. '%';
        }
    }
}


?>