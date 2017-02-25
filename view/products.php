<?php

$getCategories = getCategories();
$catList = '<select name="invcat" id="invcat">';
$catList .= "<option>Choose a Category</option>";
    foreach ($categories as $category) {
    $catList .= "<option value='$category[categoryId]'";
        if(isset($invcat)){
        if($category['categoryId'] === $invcat){
            $catList .= ' selected ';
        }
        }
        $catList .="> $category[categoryName] </option>";
    }
$catList .= "</select>";





if ( $_SESSION['clientData']['clientLevel'] < 2){
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

            <section class="content">


                <form method="post" action="/acmeproject/products/index.php">
                    <?php
                    if (isset($message)) {
                        echo $message;
                    }
                    ?>
                    <h1> Add to Inventory </h1>
                    
                    Name of product:
                    <input type="text" name="invname" id="invname" <?php if(isset($invname)){echo "value='$invname'";} ?> required>
                    <br>
                    Description:
                    <input type="text" name="invdesc" id="invdesc" size="45" <?php if(isset($invdesc)){echo "value='$invdesc'";} ?> required>
                    <br>
                    Price
                    <input type="number" name="invprice" id="invprice" <?php if(isset($invprice)){echo "value='$invprice'";} ?> required>
                    <br>
                    Stock
                    <input type="number" name="invstock" id="invstock" <?php if(isset($invstock)){echo "value='$invstock'";} ?> required>
                    <br>
                    Inventory Size
                    <input type="number" name="invsize" id="invsize" <?php if(isset($invsize)){echo "value='$invsize'";} ?> required>
                    <br>
                    Location
                    <input type="text" name="invloc" id="invloc" <?php if(isset($invloc)){echo "value='$invloc'";} ?> required>
                    <br>
                       Category
                       <?php echo $catList; ?>
                       <br>
                    Vendor
                    <input type="text" name="invvendor" id="invvendor" <?php if(isset($invvendor)){echo "value='$invvendor'";} ?> required>
                    <br>
                    Weight
                    <input type="number" name="invweight" id="invweight" <?php if(isset($invweight)){echo "value='$invweight'";} ?> required>
                    <br>
                    Style
                    <input type="text" name="invstyle" id="invstyle" <?php if(isset($invstyle)){echo "value='$invstyle'";} ?> required>

                    <input type="submit" name="submit" id="regbtn" value="Register">
                      
                    <input type="hidden" name="action" value="register">

                </form>

            </section>
            <hr>
            <?php
            include 'footer.php';
            ?>

        </section>


    </body>

</html>
