<?php 
    require_once($_SERVER['DOCUMENT_ROOT'].'/model/db.php');
    require_once($_SERVER['DOCUMENT_ROOT'].'/model/search_db.php');
?>



<!--db search-->
<?php 
  $searchresults = get_all_cars(0, 25); //query all data listed above
  
  //$display_array = array();

  // while($row = mysqli_fetch_assoc($searchresults)){
  //  // $array[] = $row;
  //   //echo $row['model'];
  //   echo '  <div class="card" style="width: 20rem;">
  //   <img class="card-img-top" src="" alt="Vehicle image">
  //   <div class="card-body">
  //     <p class="card-text">year_make model</p> <!--year and make and model-->
  //     <p class="card-text">price</p> <!--price-->
  //     <p class="card-text">mileage</p> <!--mileage-->
  // </div>';
  // }


?>

<!-- car search results -->
<?php
foreach($searchresults as $row): ?>
  <div class="card">
    <img class="card-img-top" src=<?php echo('"'.$row['image_url'].'"');?> alt="Vehicle Image">
    <div class="card-body">
      <p class="card-text" style="text-transform:uppercase;" id="results_yearmakemodel_text"><?php echo(''.$row['year'].'  '.$row['manufacturer'].' '.$row['model']);?> </p> <!--year and make and model-->
      <p class="card-text">Price: $ <?php echo(''.$row['price']);?></p> <!--price-->
      <p class="card-text">Mileage: <?php echo(''.$row['odo']);?></p></p> <!--mileage-->
    </div>
  </div>
<?php endforeach; ?>

