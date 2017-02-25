<?php
if ( $_SESSION['loggedin'] == false){
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
    include 'header.php'
    ?>

    <section class="content">


        <h1>
            <?php if(isset($cookieFirstname)){
                echo "<span>Welcome $cookieFirstname</span>";
            } ?>
        </h1>
        <p>This is the super awesome admin page yas.</p>

        <ul>
            <ol><strong>Name:</strong> <?php echo $_SESSION['clientData']['clientFirstname']; ?></ol>
            <ol><strong>Last Name:</strong> <?php echo $_SESSION['clientData']['clientLastname']; ?></ol>
            <ol><strong>Email:</strong> <?php echo $_SESSION['clientData']['clientEmail']; ?></ol>
            <ol><strong>Level:</strong> <?php echo $_SESSION['clientData']['clientLevel']; ?></ol>

        </ul>

        <?php
        if ( $_SESSION['clientData']['clientLevel'] >= 2){
            echo '<a href="/acmeproject/index.php?action=products"> Register Products </a>';
        }

        ?>



    </section>

    <hr>
    <?php
    include 'footer.php'
    ?>

</section>


</body>

</html>

