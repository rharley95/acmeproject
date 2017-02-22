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
        <center>
        <h1>Product Management</h1>
        
        <a href="/acmeproject/index.php?action=categories"> Add Categories </a>
        <br/>
        <a href="/acmeproject/products/index.php"> Add To Inventory </a>
        </center>
            
       
        <hr>
         <?php
         include 'footer.php';
         ?>
        

    </section>


</body>

</html>
