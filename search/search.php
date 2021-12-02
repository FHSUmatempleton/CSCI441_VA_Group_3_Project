<?php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
    require_once($_SERVER['DOCUMENT_ROOT'].'/model/search_db.php');
    require_once($_SERVER['DOCUMENT_ROOT'].'/model/db.php'); //including php file for database connection
    $carsPerPage = 25;
?>

<!---------------GET DATA----------------->
<?php 
    $manufacturers  = get_all_makes();      // query unique make
    $models         = get_all_models();     // query unique model
    $colors         = get_all_colors();     // query unique colors
    $bodytypes      = get_all_bodytypes();  // query unique body type

    if (!isset($_GET['make']) || $_GET['make'] == "all") {
        $make = "all";
        $makeSQL = "*";
    } else {
        $make = $_GET['make'];
        $makeSQL = $make;
    }

    if (!isset($_GET['priceMin']) || $_GET['priceMin'] == "") {
        $priceMin = "0";
    } else {
        $priceMin = $_GET['priceMin'];
    }

    if (!isset($_GET['priceMax']) || $_GET['priceMax'] == "") {
        $priceMax = "1000000";
    } else {
        $priceMax = $_GET['priceMax'];
    }

    if (!isset($_GET['odoMin']) || $_GET['odoMin'] == "") {
        $odoMin = "0";
    } else {
        $odoMin = $_GET['odoMin'];
    }

    if (!isset($_GET['odoMax']) || $_GET['odoMax'] == "") {
        $odoMax = "1000000";
    } else {
        $odoMax = $_GET['odoMax'];
    }

    if (!isset($_GET['yearMin']) || $_GET['yearMin'] == "") {
        $yearMin = "1985";
    } else {
        $yearMin = $_GET['yearMin'];
    }

    if (!isset($_GET['yearMax']) || $_GET['yearMax'] == "") {
        $yearMax = "2030";
    } else {
        $yearMax = $_GET['yearMax'];
    }

    if (!isset($_GET['body']) || $_GET['body'] == "all") {
        $body = "all";
        $bodySQL = "*";
    } else {
        $body = $_GET['body'];
        $bodySQL = $body;
    }

    if (!isset($_GET['color']) || $_GET['color'] == "all") {
        $color = "all";
        $colorSQL = "*";
    } else {
        $color = $_GET['color'];
        $colorSQL = $color;
    }

    if (isset($_GET['page'])) {
        $page = intval($_GET['page']);
    } else {
        $page = 1;
    }
    $start = ($page - 1) * $carsPerPage;
    $count = $carsPerPage;
    $all_results = get_cars_by_query($start, $count, $makeSQL, $priceMin, $priceMax, $odoMin, $odoMax, $yearMin, $yearMax, $bodySQL, $colorSQL);
    $queryCount = get_cars_count_by_query($makeSQL, $priceMin, $priceMax, $odoMin, $odoMax, $yearMin, $yearMax, $bodySQL, $colorSQL);
    $allCount = get_all_cars_count();

   //$test = get_car_by_color(0,25);

    
?>




<!--------------------------------------------------------------------------------HTML------------------------------------------------------------------------->

<html>

<body>
    <div id="wrapper">

        <header class="search_header">
            <p id="usedcars">USED CARS</p>

            <div class="search_container">
                <form action="index.php?a=search" method="get">
                    <div>
                        <!--------------------Search Dropdown: MAKE--------------->
                        <div style="float: left; margin-right: 1%; width: 15%">
                            <label class="above" for="model_search">Make</label>

                            <select class="above" id="model_search" name="make" style="width:100%">
                                <option value="all">Make</option>
                                <?php foreach ($manufacturers as $row): ?>
                                <option value="<?php echo $row["manufacturer"] ?>"
                                    <?php if ($row["manufacturer"] == $make) { echo "selected"; }?>>
                                    <?php echo (ucfirst($row["manufacturer"])) ?>
                                </option>
                                <?php endforeach;   ?>
                            </select>
                        </div>
                        <!-----------------Search Dropdown: BODY-------------------->
                        <div style="float: left; margin-right: 1%; width: 15%">
                            <label class="above" for="body_search">Body Type</label>

                            <select class="above" id="body_search" name="body" style="width:100%">
                                <option value="all" hidden>Body Type</option>
                                <?php foreach ($bodytypes as $row): ?>
                                <option value="<?php echo $row["body"] ?>"
                                    <?php if ($row["body"] == $body) { echo "selected"; }?>>
                                    <?php echo (ucfirst($row["body"])) ?>
                                </option>
                                <?php endforeach;   ?>
                            </select>
                        </div>

                        <!------------------Search Dropdown: COLOR------------------->
                        <div style="float: left; margin-right: 1%; width: 15%">
                            <label class="above" for="color_search">Color</label>
                            <select id="color_search" name="color" style="width:100%">
                                <option value="all" hidden>Color</option>
                                <?php 
                    foreach ($colors as $row):
                ?>
                                <option value="<?php echo $row['color'] ?>"
                                    <?php if ($row["color"] == $color) { echo "selected"; }?>>
                                    <?php echo (ucfirst($row["color"])) ?></option>
                                <?php endforeach;   ?>
                            </select>
                        </div>
                        <!---------Search Dropdown: PRICE :: Search by Range------->
                        <div style="float: left; margin-right: 0.25%; width: 10%">
                            <label for="priceMin">Min. Price</label>
                            <input type="text" name="priceMin" id="priceMin" style="width: 100%; float: right;"
                                default="0" placeholder="Min. Price" /></br>
                            <label for="priceMax">Max. Price</label>
                            <input type="text" name="priceMax" id="priceMax" style="width: 100%;" default="1000000"
                                placeholder="Max Price" />
                        </div>
                        <!---------Search Dropdown: ODO :: Search by Range------->
                        <div style="float: left; margin-right: 0.25%; width: 10%">
                            <label for="odoMin">Min. Mileage</label>
                            <input type="text" name="odoMin" id="odoMin" style="width: 100%" default="0"
                                placeholder="Min. Mileage" /></br>
                            <label for="odoMax">Max. Mileage</label>
                            <input type="text" name="odoMax" id="odoMax" style="width: 100%" default="1000000"
                                placeholder="Max Mileage" />
                        </div>
                        <!---------Search Dropdown: YEAR :: Search by Range------->
                        <div style="float: left; margin-right: 0.25%; width: 10%">
                            <label for="yearMin">Min. Year</label>
                            <input type="text" name="yearMin" id="yearMin" style="width: 100%" default="1985"
                                placeholder="Min. Year" /></br>
                            <label for="yearMax">Max. Year</label>
                            <input type="text" name="yearMax" id="yearMax" style="width: 100%" default="2030"
                                placeholder="Max Year" />
                        </div>

                        <div style="float: bottom; margin-right: 0.25%; width: 10%">
                            <button class="btn btn-outline-dark" type="submit">Search</button>
                        </div>
                    </div>
                    <br>
                </form>
            </div>
        </header>
        <main>
            <!----------------DEFAULT CARDS--------------->

            <div class="row" style="width: 100%">
                <?php
                        foreach($all_results as $row):
                            
                            $na = false;
                            if ($row['color'] == "black" || $row['color'] == "brown" || $row['color'] == "custom") {
                                $na = true;
                            } else if ($row['color'] == "silver") {
                                $rowColor = "grey";
                            } else {
                                $rowColor = $row['color'];
                            }
                    
                            switch ($row['body']) {
                                case "Pickup":
                                case "Truck":
                                    $rowBody = "truck";
                                    break;
                                case "Convertible/Cabriolet":
                                    $rowBody = "convertible";
                                    break;
                                case "Sport Utility Vehicle (SUV)/Multi-Purpose Vehicle (MPV)":
                                    $rowBody = "suv";
                                    break;
                                case "Coupe":
                                    $rowBody = "coupe";
                                    break;
                                case "Sedan/Saloon":
                                    $rowBody = "sedan";
                                    break;
                                case "Crossover Utility Vehicle (CUV)":
                                    $rowBody = "suv";
                                    break;
                                case "Hatchback/Liftback/Notchback":
                                    $rowBody = "hatchback";
                                    break;
                                case "Cargo Van":
                                    $rowBody = "van";
                                    break;
                                case "Minivan":
                                    $rowBody = "minivan";
                                    break;
                                default:
                                    $na = true;
                                    break;
                            }
                            if ($na) {
                                $imgPath = "na.jpg";
                            } else {
                                $imgPath = "$rowBody/$rowBody-$rowColor.jpg";
                            }
                    ?>

                <div class="column">


                    <a href="<?php echo('index.php?a=view&id=' . $row['id'])?>">
                        <div class="card text-right" id="result_card">
                            <img class="card-img-top" src="img/search/<?php echo $imgPath;?>" alt="Vehicle Image">
                            <div class="card-body">
                                <p class="card-text" style="text-transform:uppercase;" id="results_yearmakemodel_text">
                                    <?php echo(''.$row['year'].'  '.$row['manufacturer'].' '.$row['model']);?> </p>
                                <!--year and make and model-->
                                <p class="card-text">Price: <?php echo("$".number_format($row['price']));?></p>
                                </p>
                                <!--mileage-->
                                <p class="card-text">Mileage: <?php echo(''.number_format($row['odo']));?></p>
                                </p>
                                <p class="card-text">Color: <?php echo (''.ucfirst($row['color']));?></p>
                                <!--mileage-->

                            </div>
                        </div>
                    </a>

                </div>
                <?php endforeach; ?>

                <!-- Page Numbers -->
                <?php
                    $searchString = "make=$make&priceMin=$priceMin&priceMax=$priceMax&odoMin=$odoMin&odoMax=$odoMax&yearMin=$yearMin&yearMax=$yearMax&body=$body&color=$color";
                $range = array();
                $pageMax = intval(ceil($queryCount / 25));
                if ($page >= 1 && $page <= 3) {
                    $range = array(1, 2, 3, 4, 5);
                } else {
                    if ($page == $pageMax) {
                        $range = array($page - 2, $page - 1, $page);
                    } else if ($page == ($pageMax - 1)) {
                        $range = array($page - 2, $page - 1, $page, $page + 1);
                    } else {
                        $range = array($page - 2, $page - 1, $page, $page + 1, $page + 2);
                    }
                }
                ?>
                <div style="width: 100%; text-align: center;">
                    <a class="display: block" href="index.php?a=search&page=1&<?php echo $searchString?>">1</a>
                    ...
                    <?php foreach ($range as $pn):?>
                    <a class="display: block"
                        href="index.php?a=search&page=<?php echo "$pn&$searchString"?>"><?php if ($page == $pn) {echo "<b><u>$pn</u></b>";} else {echo $pn;}?></a>
                    <?php endforeach;?>
                    ...
                    <a class="display: block"
                        href="index.php?a=search&page=<?php echo "$pageMax&$searchString"?>"><?php echo $pageMax?></a>
                </div>



            </div>
        </main>
    </div>
</body>

</html>
<script>
    function select_color(str) {
        if (str == "") {
            document.getElementById("color_search").innerHTML = "";
            return;
        } else {
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("color_search").innerHTML = this.responseText;
                }
            };
            xmlhttp.open("GET", "results.php?q=" + str, true);
            xmlhttp.send();
        }
    }
    ////display search results from drop-down list : COLOR*/
    function select_color_bad() {
        var x = document.getElementById("color_search").value;


        //if (x === "black")
        /* {
        <div class="row">
            <?php
         foreach($test as $row): ?>
            <div class="column">


                <a href="#">
                    <div class="card text-right" id="result_card">
                        <img class="card-img-top" src=<?php echo('"'.$row['image_url'].'"');?>
                            alt="Vehicle Image">
                        <div class="card-body">
                            <p class="card-text" style="text-transform:uppercase;"
                                id="results_yearmakemodel_text">
                                <?php echo(''.$row['year'].'  '.$row['manufacturer'].' '.$row['model']);?>
                            </p>
                            <!--year and make and model-->
                            <p class="card-text">Mileage: <?php echo(''.$row['odo']);?></p>
                            </p>
                            <!--mileage-->
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
    function select_price() {
        var x = document.getElementById("price_search").value;

        alert(x);
    }

    ////display search results from drop-down list : YEAR*/
    function select_year() {
        var x = document.getElementById("year_search").value;

        alert(x);
    }

    ////display search results from drop-down list : MODEL*/
    function select_model() {
        var x = document.getElementById("model_search").value;

        alert(x);
    }

    ////display search results from drop-down list : MILE*/
    function select_mileage() {
        var x = document.getElementById("odo_search").value;

        alert(x);
    }
    ////display search results from drop-down list : BODY*/
    function select_body() {
        var x = document.getElementById("body_search").value;

        alert(x);
    }
</script>