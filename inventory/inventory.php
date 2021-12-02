<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    require_once($_SERVER['DOCUMENT_ROOT'].'/model/db.php');
    require_once($_SERVER['DOCUMENT_ROOT'].'/model/account_db.php');
    require_once($_SERVER['DOCUMENT_ROOT'].'/model/search_db.php');
    
    if (get_perms_by_hash($_SESSION['login']) < 1) {
        header("Location: /index.php");
    }

    if (!isset($_SESSION['login'])) {
        header("Location: /index.php");
    }
    $cars = get_all_cars(0, get_all_cars_count());
?>
<div id="wrapper">
    <main>
        <!-- to do: password change? -->
        <!-- to do: account deactivation? -->
        <?php 
    if (array_key_exists('errors', $_POST)) {
        $errors = $_POST['errors'];
    }
?>


        <script src="https://cdnjs.cloudflare.com/ajax/libs/zxcvbn/4.2.0/zxcvbn.js"></script>
        <section style="height: 100%">
            <table class="table" style="width: 98%; margin: 0px auto;" id="sortTable">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">VIN</th>
                        <th scope="col">Year</th>
                        <th scope="col">Make</th>
                        <th scope="col">Model</th>
                        <th scope="col">Series</th>
                        <th scope="col">Price</th>
                        <th scope="col">Mileage</th>
                        <th scope="col">Body</th>
                        <th scope="col">Color</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <?php foreach ($cars as $car): ?>
                <form action="index.php?a=editcar&id=<?php echo $car["id"]?>" method="post">
                    <tr>
                        <td>
                            <?php echo $car["id"]; ?>
                        </td>
                        <td>
                            <?php echo $car["vin"]; ?>
                        </td>
                        <td>
                            <?php echo $car["year"]; ?>
                        </td>
                        <td>
                            <?php echo $car["manufacturer"]; ?>
                        </td>
                        <td>
                            <?php echo $car["model"]; ?>
                        </td>
                        <td>
                            <?php echo $car["series"]; ?>
                        </td>
                        <td>
                            <?php echo $car["price"]; ?>
                        </td>
                        <td>
                            <?php echo $car["odo"]; ?>
                        </td>
                        <td>
                            <?php echo $car["body"]; ?>
                        </td>
                        <td>
                            <?php echo $car["color"]; ?>
                        </td>
                        <td>
                            <input type="submit" value="Edit">
                        </td>
                </form>

                </tr>
                <?php endforeach; ?>
            </table>
            <button onclick="sortingTable()">Sort</button>
        </section>
    </main>
</div>

<script>
    function sortTable() {
        var tables, sort, i, x, y, tableSort;
        tables = document.getElementById("SortmyTable");
        sort = true;
        while (sort) {
            sort = false;
            tblrow = tables.rows;
            for (i = 1; i < (tblrow.length - 1); i++) {
                tableSort = false;
                x = tblrow[i].getElementsByTagName("td")[n];
                y = tblrow[i + 1].getElementsByTagName("td")[n];
                if (x.innerHTML.toUpperCase() > y.innerHTML.toUpperCase()) {
                    tableSort = true;
                    break;
                }
            }
            if (tableSort) {
                tblrow[i].parentNode.insertBefore(tblrow[i + 1], tblrow[i]);
                sort = true;
            }
        }
    }
</script>