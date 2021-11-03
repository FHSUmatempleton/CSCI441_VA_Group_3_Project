<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

<?php 

    require "../search/searchdb.php"; //including php file for database connection
?>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<script src="../search/search.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

<!--db search-->
<?php 
  $select_data= "SELECT image_url, year, manufacturer, model, odo, price FROM cars ORDER BY id DESC"; //search all year, make, model, mileage, price data from DB

  $searchresults = mysqli_query($conn, $select_data); //query all data listed above
  
  //$display_array = array();

  while($row = mysqli_fetch_assoc($searchresults)){
   // $array[] = $row;
    //echo $row['model'];
    echo '  <div class="card" style="width: 20rem;">
    <img class="card-img-top" src="" alt="Vehicle image">
    <div class="card-body">
      <p class="card-text">year_make model</p> <!--year and make and model-->
      <p class="card-text">price</p> <!--price-->
      <p class="card-text">mileage</p> <!--mileage-->
  </div>';
  }


?>

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