

<!DOCTYPE html>
<html>

<head>
    <title><?php echo $type; ?> Products | Acme, Inc.</title>
    <link rel="stylesheet" type="text/css" href="/acmeproject/styles.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body>

<section class="main">

    <?php
    include 'header.php'
    ?>

    <section class="content">
        <h1><?php echo $type; ?> Products</h1>
        <?php if(isset($message)){ echo $message; } ?>

        <?php if(isset($prodDisplay)){ echo $prodDisplay; } ?>


    </section>

    <hr>
    <?php
    include 'footer.php'
    ?>

</section>


</body>

</html>

