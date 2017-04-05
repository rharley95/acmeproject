<?php
$firstname = $_SESSION['clientData']['clientFirstname'];
$lastname = $_SESSION['clientData']['clientLastname'];
$clientId = $_SESSION['clientData']['clientId'];
$screenName = $firstname . " " . $lastname;



//if ( $_SESSION['clientData']['clientLevel'] < 2){
//    header('location: /acmeproject');
//}

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



        <?php
        if (isset($message)) {
            echo $message;
        }
        ?>
        <h1> Modify Review </h1>

        <form method="post" action="/acmeproject/reviews/index.php">
            <?php
            if (isset($message)) {
                echo $message;
            }
            ?>
            <h1>Modify a Review</h1>
            <span> Review:</span>
            <input type="text" value="<?php echo $screenName?>" disabled="disabled"> <br/><br/>
            <textarea name="reviewText" id="reviewText" required> <?php echo $review['reviewText']; ?></textarea>
        <br/>
            <input type="submit" name="submit" id="regbtn" value="Update Review">
        <br/>
            <input type="hidden" name="reviewId" id="reviewId" value=<?php echo $review['reviewId'] ?>>
            <input type="hidden" name="action" value="updateRev">

        </form>






    <hr>
    <?php
    include 'footer.php';
    ?>


</section>


</body>

</html>
