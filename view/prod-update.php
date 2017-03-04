<?php

// Build the categories option list
$catList = '<select name="invcat" id="invcat">';
$catList .= "<option>Choose a Category</option>";
foreach ($categories as $category) {
    $catList .= "<option value='$category[categoryId]'";
    if(isset($invcat)){
        if($category['categoryId'] === $invcat){
            $catList .= ' selected ';
        }
    } elseif(isset($prodInfo['categoryId'])){
        if($category['categoryId'] === $prodInfo['categoryId']){
            $catList .= ' selected ';
        }
    }
    $catList .= ">$category[categoryName]</option>";
}
$catList .= '</select>';


if ( $_SESSION['clientData']['clientLevel'] < 2){
    header('location: /acmeproject');
}

?>

<!DOCTYPE html>
<html>

<head>
    <title><?php if(isset($prodInfo['invName'])){ echo "Modify $prodInfo[invName] ";} elseif(isset($prodName)) { echo $prodName; }?> | Acme, Inc</title>
    <link rel="stylesheet" type="text/css" href="/acmeproject/styles.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body>

<section class="main">
    <?php
    include 'header.php';
    ?>

    <h1><?php if(isset($prodInfo['invName'])){ echo "Modify $prodInfo[invName] ";} elseif(isset($prodName)) { echo $prodName; }?></h1>

    <form method="post" action="/acmeproject/products/index.php">
        <?php
        if (isset($message)) {
            echo $message;
        }
        ?>
        <h1> Modify Product </h1>

        Name of product:
<!--        <input type="text" name="invname" id="invname" --><?php //if(isset($invname)){echo "value='$invname'";} ?><!-- required>-->
        <input type="text" name="invname" id="invname" required <?php if(isset($prodName)){ echo "value='$prodName'"; } elseif(isset($prodInfo['invName'])) {echo "value='$prodInfo[invName]'"; }?>>
        <br>
        Description:
        <textarea type="text" name="invdesc" id="invdesc" required> <?php if(isset($prodDesc)){ echo "$prodDesc"; } elseif(isset($prodInfo['invDescription'])) {echo "$prodInfo[invDescription]"; }?> </textarea>
        <br>
        Price:
         <input type="number" name="invprice" id="invprice" required <?php if(isset($prodPrice)){ echo "value='$prodPrice'"; } elseif(isset($prodInfo['invPrice'])) {echo "value='$prodInfo[invPrice]'"; }?>>
        <br>
        Stock:
        <input type="number" name="invstock" id="invstock" required <?php if(isset($prodStock)){ echo "value='$prodStock'"; } elseif(isset($prodInfo['invStock'])) {echo "value='$prodInfo[invStock]'"; }?>>
        <br>
        Inventory Size:
            <input type="number" name="invsize" id="invsize" required <?php if(isset($prodSize)){ echo "value='$prodSize'"; } elseif(isset($prodInfo['invSize'])) {echo "value='$prodInfo[invSize]'"; }?>>
        <br>
        Location
        <input type="text" name="invloc" id="invloc" required <?php if(isset($prodLocation)){ echo "value='$prodLocation'"; } elseif(isset($prodInfo['invLocation'])) {echo "value='$prodInfo[invLocation]'"; }?>>
        <br>
        Category
        <?php echo $catList; ?>
        <br>
        Vendor
        <input type="text" name="invvendor" id="invvendor" <?php if(isset($prodVendor)){ echo "value='$prodVendor'"; } elseif(isset($prodInfo['invVendor'])) {echo "value='$prodInfo[invVendor]'"; }?> required>
        <br>
        Weight
        <input type="number" name="invweight" id="invweight" <?php if(isset($prodWeight)){ echo "value='$prodWeight'"; } elseif(isset($prodInfo['invWeight'])) {echo "value='$prodInfo[invWeight]'"; }?> required>
        <br>
        Style
        <input type="text" name="invstyle" id="invstyle" <?php if(isset($prodStyle)){ echo "value='$prodStyle'"; } elseif(isset($prodInfo['invStyle'])) {echo "value='$prodInfo[invStyle]'"; }?> required>

        <input type="submit" name="submit" id="regbtn" value="Update Product">
        <input type="hidden" name="action" value="updateProd">
        <input type="hidden" name="prodId" value="<?php if(isset($prodInfo['invId'])){ echo $prodInfo['invId'];} elseif(isset($prodId)){ echo $prodId; } ?>">

    </form>






    <hr>
    <?php
    include 'footer.php';
    ?>


</section>


</body>

</html>
