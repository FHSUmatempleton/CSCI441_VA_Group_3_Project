<div class="sidenav" style="margin-top: 90px; min-height: 700px; max-height: 850px;">
            <a href="" style="color:white;" id="carDetails">
                <img>
                <p><?php echo($car['year'] . " " .$car['manufacturer'] . " " . $car['model']);?></p>

                <p><?php echo('List Price: $'.$car['price']);?></p>

            </a>
            </br>
            <?php $action = $_GET['a'];?>
            <a href="index.php?a=purchase" <?php if ($action == "purchase") {echo ('style="color: black;"');}?> >Personal Information</a> </br>
            <a href="index.php?a=transport" <?php if ($action == "transport") {echo ('style="color: black;"');}?> >Delivery or Pick Up</a> </br>
            <a href="index.php?a=review" <?php if ($action == "review") {echo ('style="color: black;"');}?> >Review Order</a> </br>
            <a href="index.php?a=payment" <?php if ($action == "payment") {echo ('style="color: black;"');}?> >Payment</a> </br>
            <a href="index.php?a=finalize" <?php if ($action == "finalize") {echo ('style="color: black;"');}?> >FINALIZE PURCHASE</a> </br>
        </div>