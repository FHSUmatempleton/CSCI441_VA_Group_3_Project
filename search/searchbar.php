<html>
    <!--bootstrap-->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
</html>

<!--reference database files-->
<?php 
    require_once($_SERVER['DOCUMENT_ROOT'].'/model/db.php');
    require_once($_SERVER['DOCUMENT_ROOT'].'/model/search_db.php');
 ?>
 <!--ajax-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript" src="../js/search/search.js"></script>
<style>
<?php include '../css/search/search.css'; ?>
</style>


<!--reference search javascript file-->
<script src="../js/search/search.js"></script>

<!--*****Get data****-->
<?php
//data for search bar
$manufacturers  = get_all_makes();      // query unique make
$models         = get_all_models();     // query unique model
$colors         = get_all_colors();     // query unique colors
$bodytypes      = get_all_bodytypes();  // query unique body type

//data for search area
$searchresults = get_all_cars(0, 25); //query year make model mileage and url for cars
//$make_array = mysqli_fetch_array($manufacturers); //array for **NOT USED YET***
?>

<!-- HTML FOR PAGE --> 
<body>
<!--------------------search dropdown---------------->
<!-------------------make & model----------------->
    <select id="model_search" onchange="selectModel()">
        <option hidden>Make & Model</option>
        <?php
        foreach ($manufacturers as $row): 
        ?>
            <option value ="<?php echo $row["manufacturer"] ?>"><?php echo (ucfirst($row["manufacturer"])) ?></option>
            
        <?php endforeach ?>
        
    </select>
    
<!-----------------------price search--------------------->
    <select id="price_search" onchange="selectPrice()">
        <option hidden>Price</option>
        <?php
        foreach ($colors as $row):
        ?>
            <option value ="<?php echo $row["color"] ?>"><?php echo (ucfirst($row["color"])) ?></option>
        <?php endforeach;       ?>
    </select> 
    
<!-------------------------mileage search---------------->
    <select id="mileage_search" onchange="selectMileage()">
        <option hidden>Mileage</option>
        <option value=" BETWEEN 0 AND 4999 "> < 5,000 miles</option>
        <option value=" BETWEEN 5000 AND 9999 "> 5,000 - 10,000 miles </option>
        <option value=" BETWEEN 10000 AND 29999 "> 10,000 - 30,000 miles</option>
        <option value=" BETWEEN 30000 AND 49999 "> 30,000 - 50,000 miles</option>
        <option value=" BETWEEN 50000 AND 99999 "> 50,000 - 100,000 miles</option>
        <option value=" BETWEEN 100000 AND 300000 "> > 100,000 miles</option>
    </select>

<!-------------------year search------------------------>
    <select id="year_search" onchange="selectYear()">
        <option hidden>Years</option>
        <option value=" BETWEEN 2020 AND 3000 ">2020 and newer</option>
        <option value=" BETWEEN 2010 AND 2019 ">2010 to 2019</option>
        <option value=" BETWEEN 2005 AND 2009 ">2005 and 2009</option>
        <option value=" BETWEEN 2000 AND 2004 ">2000 and 2004</option>
        <option value=" BETWEEN 1900 AND 2000 ">2000 and older</option>
    </select>


<!-------------------color search------------------------>
    <select id="color_search" onchange="selectColor()">
        <option hidden>Colors</option>
        <?php
        foreach ($colors as $row):
        ?>
            <option value ="<?php echo $row["color"] ?>"><?php echo (ucfirst($row["color"])) ?></option>
        <?php endforeach;   ?>
    </select>

<!----------------body type search----------------------->
<select id="bodytype_search" onchange="selectBodyType()">
        <option hidden>Body Type</option>
        <?php
        foreach ($bodytypes as $row): 
        ?>
            <option value ="<?php echo $row["body"] ?>"><?php echo (ucfirst($row["body"])) ?></option>
        <?php endforeach; ?>
</select>