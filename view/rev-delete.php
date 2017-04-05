<?php
$firstname = $_SESSION['clientData']['clientFirstname'];
$lastname = $_SESSION['clientData']['clientLastname'];
$clientId = $_SESSION['clientData']['clientId'];
$firstname = substr($firstname, 0, 1);
$screenName = $firstname . " " . $lastname;


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


    <p>Confirm Product Deletion. The delete is permanent.</p>

    <?php
    if (isset($message)) {
        echo $message;
    }
    ?>
    <form method="post" action="/acmeproject/reviews/index.php">
    <h1>Delete a Review</h1>
    <span> Review:</span>
    <input type="text" value="<?php echo $screenName?>" >
    <br/><br/>
    <textarea name="reviewText" id="reviewText" required><?php
        echo $review['reviewText'];
        ?> </textarea>
    <br/>
    <input type="submit" name="submit" id="regbtn" value="Delete Review">
    <input type="hidden" name="reviewId" id="reviewId" value=<?php echo $review['reviewId'] ?>>
    <input type="hidden" name="action" value="deleteRev">

    </form>







    <hr>
    <?php
    include 'footer.php';
    ?>


</section>


</body>

</html>
