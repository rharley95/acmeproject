<?php
if ( $_SESSION['clientData']['clientLevel'] < 2){
    header('location: /acmeproject');

    if (isset($_SESSION['message'])) {
        $message = $_SESSION['message'];
    }
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
        <section class="prod-l">
        <h1>Product Management</h1>
        
        <a href="/acmeproject/categories/index.php?action=categories"> Add Categories </a>
        <br/>
        <a href="/acmeproject/products/index.php?action=register"> Add To Inventory </a>
    <br/>

            <?php
            if (isset($message)) {
                echo $message;
            } if (isset($prodList)) {
                echo $prodList;
            }
            ?>


        </section>


            
       
        <hr>
         <?php
         include 'footer.php';
         ?>
        

    </section>


</body>

</html>

<?php unset($_SESSION['message']); ?>
