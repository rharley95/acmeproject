<?php
if ( $_SESSION['loggedin'] == false){
    header('location: /acmeproject');
}

?>
<!DOCTYPE html>
<html>

<head>
    <title>Acme</title>
    <link rel="stylesheet" type="text/css" href="/acmeproject/styles.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body>

<section class="main">

    <?php
    include 'header.php';
    ?>

    <section class="form">
        <?php echo $prodInfoDisplay; ?>


    </section>
    <hr>
    <?php
    include 'footer.php';
    ?>

</section>


</body>

</html>