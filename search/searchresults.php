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

<?php
foreach($searchresults as $row): ?>
  <div class="card" style="width: 20rem;">
    <img class="card-img-top" src=<?php echo('"'.$row['image_url'].'"');?> alt="Vehicle Image">
    <div class="card-body">
      <p class="card-text"></p>
    </div>
  </div>
<?php endforeach; ?>

<!-- car search results -->

<div class="card" style="width: 20rem;">
  <img class="card-img-top" src="../img/examplecar.jpg" alt="Vehicle image">
  <div class="card-body">
    <p class="card-text">year_make model</p> <!--year and make and model-->
    <p class="card-text">price</p> <!--price-->
    <p class="card-text">mileage</p> <!--mileage-->
</div>
<div class="card" style="width: 20rem;">
  <img class="card-img-top" src="../img/examplecar.jpg" alt="Vehicle image">
  <div class="card-body">
    <p class="card-text">year_make model</p> <!--year and make and model-->
    <p class="card-text">price</p> <!--price-->
    <p class="card-text">mileage</p> <!--mileage-->
</div>     
</div>