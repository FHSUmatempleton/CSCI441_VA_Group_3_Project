
<?php 
    require_once($_SERVER['DOCUMENT_ROOT'].'/model/search_db.php');
    require_once($_SERVER['DOCUMENT_ROOT'].'/model/db.php'); //including php file for database connection
?>

<!---------------GET DATA----------------->
<?php 
    $manufacturers  = get_all_makes();      // query unique make
    $models         = get_all_models();     // query unique model
    $colors         = get_all_colors();     // query unique colors
    $bodytypes      = get_all_bodytypes();  // query unique body type

    $all_results    = get_all_cars(0,25); //get all cars sorted by id

   //$test = get_car_by_color(0,25);

    
?>

<!-- ajax file reference-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<!-- search js file reference-->
<script type="text/javascrip" src="../js/search/search.js"></script>


<!--------------------------------------------------------------------------------HTML------------------------------------------------------------------------->

<html>  
    <body>
        <div id="wrapper"> 
            
                <header class="search_header">
                    <p id="usedcars">USED CARS</p>

                   <div class = "search_container"> 
                       <!--------------------Search Dropdown: MODEL--------------->
                        <select id="model_search" style="width:16%" onchange="select_model()">
                            <option hidden>Make & Model</option>
                            <?php 
                                foreach ($manufacturers as $row):
                            ?>
                                <option value ="<?php echo $row["manufacturer"] ?>"><?php echo (ucfirst($row["manufacturer"])) ?></option>
                            <?php endforeach;   ?>

                        </select>
                        <!---------Search Dropdown: PRICE :: Search by Range------->
                        <select id="price_search" style="width:16%" onchange="select_price()">
                            <option hidden>Price</option>
                            <option value=" BETWEEN 0 AND 4999 "> > $40,000 </option>
                            <option value=" BETWEEN 30000 AND 40000 "> $30,000 - $40,000 </option>
                            <option value=" BETWEEN 20000 AND 30000 "> $20,000 - $30,000 </option>
                            <option value=" BETWEEN 10000 AND 20000 "> $10,000 - $20,000 </option>
                            <option value=" BETWEEN 0 AND 10000 "> < $10,000 </option>
                        </select>

                        <!---------Search Dropdown: ODO :: Search by Range------->
                        <select id="odo_search" style="width:16%" onchange="select_mileage()">
                            <option hidden>Mileage</option>
                            <option value=" BETWEEN 0 AND 4999 "> < 5,000 miles</option>
                            <option value=" BETWEEN 5000 AND 9999 "> 5,000 - 10,000 miles </option>
                            <option value=" BETWEEN 10000 AND 49999 "> 10,000 - 50,000 miles</option>
                            <option value=" BETWEEN 50000 AND 99999 "> 50,000 - 100,000 miles</option>
                            <option value=" BETWEEN 100000 AND 300000 "> > 100,000 miles</option>
                        </select>

                        <!---------Search Dropdown: YEAR :: Search by Range------->
                        <select id="year_search" style="width:16%" onchange="select_year()">
                            <option hidden>Year</option>
                            <option value=" BETWEEN 2020 AND 2050 ">2020 and newer</option>
                            <option value=" BETWEEN 2010 AND 2020 ">2010 to 2020</option>
                            <option value=" BETWEEN 2005 AND 2010 ">2005 and 2010</option>
                            <option value=" BETWEEN 2000 AND 2005 ">2000 and 2005</option>
                            <option value=" BETWEEN 1900 AND 2000 ">2000 and older</option>
                        </select>

                        <!-----------------Search Dropdown: BODY-------------------->
                        <select id="body_search"style="width:16%" onchange="select_body()">
                            <option hidden>Body Type</option>
                            <?php 
                                foreach ($bodytypes as $row):
                            ?>
                                <option value ="<?php echo $row["body"] ?>"><?php echo (ucfirst($row["body"])) ?></option>
                            <?php endforeach;   ?>
                        </select>

                        <!------------------Search Dropdown: COLOR------------------->
                        <select id="color_search"  style="width:16%">
                            <option hidden>Color</option>
                            <?php 
                                foreach ($colors as $row):
                            ?>
                                <option onclick = "select_color(this.value)" value ="<?php echo $row['color'] ?>"><?php echo (ucfirst($row["color"])) ?></option>
                            <?php endforeach;   ?>
                        </select>
                   </div>
                </header>
            <main>
                <!----------------DEFAULT CARDS--------------->

                <div class="row">
                    <?php
                        foreach($all_results as $row): ?>
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
