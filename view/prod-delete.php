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
    <title><?php if(isset($prodInfo['invName'])){ echo "Delete $prodInfo[invName]";} ?> | Acme, Inc.</title>
    <link rel="stylesheet" type="text/css" href="/acmeproject/styles.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body>

<section class="main">
    <?php
    include 'header.php';
    ?>

    <h1><?php if(isset($prodInfo['invName'])){ echo "Delete $prodInfo[invName]";} ?></h1>
    <p>Confirm Product Deletion. The delete is permanent.</p>

    <form method="post" action="/acmeproject/index.php?action=products">
        <?php
        if (isset($message)) {
            echo $message;
        }
        ?>
        <h1> Delete Product </h1>

        Product:
<!--        <input type="text" name="invname" id="invname" --><?php //if(isset($invname)){echo "value='$invname'";} ?><!-- required>-->
        <input type="text" name="invname" id="invname" <?php if(isset($prodName)){ echo "value='$prodName'"; } elseif(isset($prodInfo['invName'])) {echo "value='$prodInfo[invName]'"; }?>>
        <br>
        Description:
        <textarea type="text" name="invdesc" id="invdesc"> <?php if(isset($prodDesc)){ echo "$prodDesc"; } elseif(isset($prodInfo['invDescription'])) {echo "$prodInfo[invDescription]"; }?> </textarea>
        <br>
        <input type="submit" name="submit" id="regbtn" value="Delete Product">
        <input type="hidden" name="action" value="deleteProd">
        <input type="hidden" name="prodId" value="<?php if(isset($prodInfo['invId'])){ echo $prodInfo['invId'];} elseif(isset($prodId)){ echo $prodId; } ?>">

    </form>






    <hr>
    <?php
    include 'footer.php';
    ?>


</section>


</body>

</html>
