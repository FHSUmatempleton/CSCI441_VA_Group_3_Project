<html>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css"></html>
<?php 
    require_once($_SERVER['DOCUMENT_ROOT'].'/model/db.php');
    require_once($_SERVER['DOCUMENT_ROOT'].'/model/search_db.php');
?>

<?php

$manufacturers  = get_all_makes();      // query unique make
$models         = get_all_models();     // query unique model
$colors         = get_all_colors();     // query unique colors
$bodytypes      = get_all_bodytypes();  // query unique body type

//$make_array = mysqli_fetch_array($manufacturers); //array for **NOT USED YET***
?>
<!-- Make and Model button -->

<div class="btn-group" style="margin-left: 2%;">
  <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
  Make & Model
  </button>

  <div class="dropdown-menu dropdown-menu-right">
    <?php
      foreach ($manufacturers as $row) {
        echo('<button class="dropdown-item" type="button">');
        echo(ucfirst(strtolower($row["manufacturer"])));
        echo('</button>');
      }
    ?>
    <button class="dropdown-item" type="button">
        <?php 
            // foreach ($manufacturers as $row) {
            //   // var_dump($row["manufacturer"]);
            //   echo "" . $row["manufacturer"] . "<br>";
            // }

            // while($row = mysqli_fetch_assoc($manufacturers)) {
            // echo "" . $row["manufacturer"]. "<br>";
            //     }
        ?>
    </button>
  </div>
</div>
<!-- Price button -->
<div class="btn-group"> 
  <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
  Price
  </button>
  
  <div class="dropdown-menu dropdown-menu-right">
    <button class="dropdown-item" type="button" value="BETWEEN 0 AND 4999.99">< $5,000</button>
    <button class="dropdown-item" type="button" value="BETWEEN 5000 AND 9999.99"> $5,000 - $9,999</button>
    <button class="dropdown-item" type="button" value="BETWEEN 10000 AND 19999.99"> $10,000 - $19,999</button>
    <button class="dropdown-item" type="button" value="BETWEEN 20000 AND 29999.99"> $20,000 - $29,999</button>
    <button class="dropdown-item" type="button" value="BETWEEN 30000 AND 999999.99"> $20,000 - $29,999</button>
  </div>
</div>
<!-- Mileage button -->
<div class="btn-group">
  <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
  Mileage
  </button>
<div class="dropdown-menu dropdown-menu-right">
    <button class="dropdown-item" type="button" value="BETWEEN 0 AND 4999"> < 5,000 miles</button>
    <button class="dropdown-item" type="button" value="BETWEEN 0 AND 9999"> < 10,000 miles </button>
    <button class="dropdown-item" type="button" value="BETWEEN 0 AND 29999"> < 30,000 miles</button>
    <button class="dropdown-item" type="button" value="BETWEEN 0 AND 49999"> < 50,000 miles</button>
    <button class="dropdown-item" type="button" value="BETWEEN 0 AND 99999"> < 100,000 miles</button>
    <button class="dropdown-item" type="button" value="BETWEEN 100000 AND 300000"> > 100,000 miles</button>
  </div>
</div>

<!-- Year button -->
<div class="btn-group">
  <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
  Year
  </button>
  
  <div class="dropdown-menu dropdown-menu-right">
    <button class="dropdown-item" type="button" value="2020  AND 3000">2020 and newer</button>
    <button class="dropdown-item" type="button" value="BETWEEN 2010 AND 3000"> 2010 and newer</button>
    <button class="dropdown-item" type="button" value="BETWEEN 2005 AND 3000"> 2005 and newer</button>
    <button class="dropdown-item" type="button" value="BETWEEN 2000 AND 3000"> 2000 and newer</button>
    <button class="dropdown-item" type="button" value="BETWEEN 1900 AND 2000"> 2000 and older</button>
  </div>
</div>

<!-- Color button -->
<div class="btn-group">
  <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
  Color
  </button>
  
  <div class="dropdown-menu dropdown-menu-right">
      <?php
        foreach ($colors as $row) {
          echo('<button class="dropdown-item" type="button">');
          echo(ucfirst($row["color"]));
          echo('</button>');
        }
      ?>
  </div>
</div>

<!-- Body type button -->
<div class="btn-group">
  <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
  Body Type
  </button>
  
  <div class="dropdown-menu dropdown-menu-right">
   <?php
      foreach ($bodytypes as $row) {
        echo('<button class="dropdown-item" type="button">');
        echo(ucfirst($row["body"]));
        echo('</button>');
      }
    ?>
  </div>
</div>

