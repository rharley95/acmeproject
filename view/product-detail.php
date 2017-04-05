<?php

$firstname = $_SESSION['clientData']['clientFirstname'];
$lastname = $_SESSION['clientData']['clientLastname'];
$clientId = $_SESSION['clientData']['clientId'];
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

        <form method="post" action="/acmeproject/reviews/index.php">
            <?php
            if (isset($_SESSION['message'])) {
                echo $_SESSION['message'];
            }
            ?>
            <h1>Write a Review</h1>
            <span> Review:</span>
            <input type="text" value="<?php echo $screenName?>" disabled="disabled"> <br/><br/>
            <textarea name="reviewText" id="reviewText" required></textarea>
        <br/>

            <input type="submit" name="submit" id="regbtn" value="Register Review">
            <input type="hidden" name="prodId" id="prodId" value=<?php echo $product ?>>
            <input type="hidden" name="clientId" value="<?php if(isset($_SESSION['clientData']['clientId'])){ echo $_SESSION['clientData']['clientId'];} ?>">
            <input type="hidden" name="action" value="new">

        </form>
        <hr>
        <h1>Product's Reviews:</h1>

        <?php echo $reviewInfo; ?>





    </section>
    <hr>

    <?php
    include 'footer.php';
    ?>

</section>


</body>

</html>
<?php unset($_SESSION['message']); ?>