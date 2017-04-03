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
    <title>Acme</title>
    <link rel="stylesheet" type="text/css" href="/acmeproject/styles.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body>

<section class="main">

    <?php
    include 'header.php';
    ?>

    <section class="prod-main">
        <?php echo $prodInfoDisplay; ?>
        <?php echo $thumbDisplay; ?>
        <?php echo $reviewInfo; ?>





        <form method="post" action="/acmeproject/reviews/index.php">
            <?php
            if (isset($message)) {
                echo $message;
            }
            ?>
            <h1>Write a Review</h1>
            <span> Review:</span>
            <input type="text" value="<?php echo $screenName?>" disabled="disabled"> </br></br>
            <textarea name="reviewText" id="reviewText" required> <?php if(isset($reviewText)){echo "hi";} ?> </textarea>
        </br>
            <input type="submit" name="submit" id="regbtn" value="Register Review">
            <input type="hidden" name="prodId" id="prodId" value=<?php echo $product ?>>
            <input type="hidden" name="clientId" value="<?php if(isset($_SESSION['clientData']['clientId'])){ echo $_SESSION['clientData']['clientId'];} ?>">
            <input type="hidden" name="action" value="new">

        </form>





    </section>
    <hr>
    <?php
    include 'footer.php';
    ?>

</section>


</body>

</html>
