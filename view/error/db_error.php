<?php include($_SERVER['DOCUMENT_ROOT'].'/view/header1.php'); ?>
<?php include($_SERVER['DOCUMENT_ROOT'].'/view/header2.php'); ?>
<section>
    <h1>Database Error</h1>
    <p> An error occurred, please see below.</p>
    <p class="last_paragraph">Error: <?php echo $err; ?></p>
</section>
<?php include($_SERVER['DOCUMENT_ROOT'].'/view/footer.php'); ?>