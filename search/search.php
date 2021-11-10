
<?php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
    require_once($_SERVER['DOCUMENT_ROOT'].'/model/search_db.php');
    require_once($_SERVER['DOCUMENT_ROOT'].'/model/db.php'); //including php file for database connection
?>

<!---------------GET DATA----------------->
<?php 
    $manufacturers  = get_all_makes();      // query unique make
    $models         = get_all_models();     // query unique model
    $colors         = get_all_colors();     // query unique colors
    $bodytypes      = get_all_bodytypes();  // query unique body type

    if (!isset($_GET['make']) || !isset($_GET['price']) || !isset($_GET['odo']) || !isset($_GET['year']) || !isset($_GET['body']) || !isset($_GET['color'])) {
        $all_results = get_all_cars(0,25); //get all cars sorted by id
    } else {
        if ($_GET['make'] == "all") {
            $make = "*";
        } else {
            $make = $_GET['make'];
        }

        if ($_GET['price'] == "all") {
            $price = "*";
        } else {
            $price = $_GET['price'];
        }

        if ($_GET['odo'] == "all") {
            $odo = "*";
        } else {
            $odo = $_GET['odo'];
        }

        if ($_GET['year'] == "all") {
            $year = "*";
        } else {
            $year = $_GET['year'];
        }

        if ($_GET['body'] == "all") {
            $body = "*";
        } else {
            $body = $_GET['body'];
        }

        if ($_GET['color'] == "all") {
            $color = "*";
        } else {
            $color = $_GET['color'];
        }
        $all_results = get_cars_by_query(0,25, $make, $price, $odo, $year, $body, $color);
    }

   //$test = get_car_by_color(0,25);

    
?>




<!--------------------------------------------------------------------------------HTML------------------------------------------------------------------------->

<html>  
    <body>
        <div id="wrapper"> 
            
                <header class="search_header">
                    <p id="usedcars">USED CARS</p>

                   <div class = "search_container">
                   <form action="index.php?" method="get">
                       <!--------------------Search Dropdown: MAKE--------------->
                        <select id="model_search" name="make" style="width:15%">
                            <option value="all" hidden>Make</option>
                            <?php foreach ($manufacturers as $row): ?>
                                <option value ="<?php echo $row["manufacturer"] ?>"><?php echo (ucfirst($row["manufacturer"])) ?></option>
                            <?php endforeach;   ?>
                        </select>
                        <!---------Search Dropdown: PRICE :: Search by Range------->
                        <select id="price_search" name="price" style="width:15%">
                            <option value="all" hidden>Price</option>
                            <option value="BETWEEN 0 AND 4999 AND "> > $40,000 </option>
                            <option value="BETWEEN 30000 AND 40000 AND "> $30,000 - $40,000 </option>
                            <option value="BETWEEN 20000 AND 30000 AND "> $20,000 - $30,000 </option>
                            <option value="BETWEEN 10000 AND 20000 AND "> $10,000 - $20,000 </option>
                            <option value="BETWEEN 0 AND 10000 AND "> < $10,000 </option>
                        </select>

                        <!---------Search Dropdown: ODO :: Search by Range------->
                        <select id="odo_search" name="odo" style="width:15%">
                            <option value="all" hidden>Mileage</option>
                            <option value="BETWEEN 0 AND 4999 AND "> < 5,000 miles</option>
                            <option value="BETWEEN 5000 AND 9999 AND "> 5,000 - 10,000 miles </option>
                            <option value="BETWEEN 10000 AND 49999 AND "> 10,000 - 50,000 miles</option>
                            <option value="BETWEEN 50000 AND 99999 AND "> 50,000 - 100,000 miles</option>
                            <option value="BETWEEN 100000 AND 300000 AND "> > 100,000 miles</option>
                        </select>

                        <!---------Search Dropdown: YEAR :: Search by Range------->
                        <select id="year_search" name="year" style="width:15%">
                            <option value="all" hidden>Year</option>
                            <option value="BETWEEN 2020 AND 2050 AND ">2020 and newer</option>
                            <option value="BETWEEN 2010 AND 2020 AND ">2010 to 2020</option>
                            <option value="BETWEEN 2005 AND 2010 AND ">2005 and 2010</option>
                            <option value="BETWEEN 2000 AND 2005 AND ">2000 and 2005</option>
                            <option value="BETWEEN 1900 AND 2000 AND ">2000 and older</option>
                        </select>

                        <!-----------------Search Dropdown: BODY-------------------->
                        <select id="body_search" name="body" style="width:15%">
                            <option value="all" hidden>Body Type</option>
                            <?php 
                                foreach ($bodytypes as $row):
                            ?>
                                <option value ="<?php echo $row["body"] ?>"><?php echo (ucfirst($row["body"])) ?></option>
                            <?php endforeach;   ?>
                        </select>

                        <!------------------Search Dropdown: COLOR------------------->
                        <select id="color_search" name="color" style="width:15%">
                            <option value="all" hidden>Color</option>
                            <?php 
                                foreach ($colors as $row):
                            ?>
                                <option onclick = "select_color(this.value)" value ="<?php echo $row['color'] ?>"><?php echo (ucfirst($row["color"])) ?></option>
                            <?php endforeach;   ?>
                        </select>
                        <button class="btn btn-outline-dark" type="submit">Search</button>
                    </form>
                   </div>
                </header>
            <main>
                <!----------------DEFAULT CARDS--------------->

                <div class="row">
                    <?php
                        foreach($all_results as $row): ?>
                    <div class="column">
                        
                        
                        <a href="<?php echo('index.php?a=view&id=' . $row['id'])?>">
                            <div class="card text-right" id="result_card">
                                <img class="card-img-top" src=<?php echo('"'.$row['image_url'].'"');?> alt="Vehicle Image">
                                <div class="card-body">
                                    <p class="card-text" style="text-transform:uppercase;" id="results_yearmakemodel_text"><?php echo(''.$row['year'].'  '.$row['manufacturer'].' '.$row['model']);?> </p> <!--year and make and model-->
                                    <p class="card-text">Mileage: <?php echo(''.$row['odo']);?></p></p> <!--mileage-->
                                    <p class="card-text">ID: <?php echo(''.$row['id']);?> </p>
                                        
                                </div>     
                            </div>
                        </a>
                    
                    </div>
                    <?php endforeach; ?> 
                </div>
                
            </main>
        </div>
    </body>
    

</html>

<script>

function select_color(str) {
  if (str == "") {
    document.getElementById("color_search").innerHTML = "");
    return;
  } else {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        document.getElementById("color_search").innerHTML = this.responseText;
      }
    };
    xmlhttp.open("GET", "results.php?q="+str,true);
    xmlhttp.send();
  }
}
    ////display search results from drop-down list : COLOR*/ 
    function select_color_bad(){
        var x = document.getElementById("color_search").value;

       
        //if (x === "black")
       /* {
            <div class="row">
                    <?php
                        foreach($test as $row): ?>
                    <div class="column">
                        
                        
                        <a href="#">
                            <div class="card text-right" id="result_card">
                                <img class="card-img-top" src=<?php echo('"'.$row['image_url'].'"');?> alt="Vehicle Image">
                                <div class="card-body">
                                    <p class="card-text" style="text-transform:uppercase;" id="results_yearmakemodel_text"><?php echo(''.$row['year'].'  '.$row['manufacturer'].' '.$row['model']);?> </p> <!--year and make and model-->
                                    <p class="card-text">Mileage: <?php echo(''.$row['odo']);?></p></p> <!--mileage-->
                                    <p class="card-text">ID: <?php echo(''.$row['id']);?> </p>
                                        
                                </div>     
                            </div>
                        </a>
                    
                    </div>
                    <?php endforeach; ?> 
                </div>
        }
        else{
            alert ("not yet");
        }
        /*$.ajax({
            url:"search.php", //where the data will go
            method: "POST", //posting data
            data: {
                id : x // value obtained in color_search 
            },
            success: function(data) {
                $("").html(data);
            }
        })*/
     

}
        
  ////display search results from drop-down list : PRICE*/
    function select_price(){
        var x = document.getElementById("price_search").value;

  alert (x);
    }

    ////display search results from drop-down list : YEAR*/
    function select_year(){
        var x = document.getElementById("year_search").value;

  alert (x);
    }

    ////display search results from drop-down list : MODEL*/
    function select_model(){
        var x = document.getElementById("model_search").value;

  alert (x);
    }

    ////display search results from drop-down list : MILE*/
    function select_mileage(){
        var x = document.getElementById("odo_search").value;

  alert (x);
    }
    ////display search results from drop-down list : BODY*/
    function select_body(){
        var x = document.getElementById("body_search").value;

  alert (x);
    }




    
</script> 
