<?php include('view/header1.php'); ?>
<?php include('view/header2.php'); ?>
<section>
    <h1>Database Connection Error</h1>
    <p> An error occurred while connecting to the database.</p>
    <p class="last_paragraph">Error: <?php echo $err; ?></p>
</section>
<?php include 'view/footer.php'; ?>