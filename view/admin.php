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


        <?php
        if (isset($_SESSION['message'])) {
            echo $_SESSION['message'];
        }
        ?>
        <h1>Welcome to your admin page.</h1>

        <ul>
            <li><strong>Name:</strong> <?php echo $_SESSION['clientData']['clientFirstname']; ?></li>
            <li><strong>Last Name:</strong> <?php echo $_SESSION['clientData']['clientLastname']; ?></li>
            <li><strong>Email:</strong> <?php echo $_SESSION['clientData']['clientEmail']; ?></li>
            <li><strong>Level:</strong> <?php echo $_SESSION['clientData']['clientLevel']; ?></li>

        </ul>
        <?php


        echo '<br/>';
        echo '<a href="/acmeproject/accounts/index.php?action=update"> Update your account information. </a>';
        echo '<br/>';
?>
        <?php
        if ( $_SESSION['clientData']['clientLevel'] >= 2){
            echo '<a href="/acmeproject/products/index.php?action=prod-list"> Register Products </a>';

        }

        ?>
<hr>
        <?php if (isset($revList)) {
            echo $revList;
        }
        ?>
    <br/>





    </section>

    <hr>
    <?php
    include 'footer.php'
    ?>

</section>


</body>

</html>

<?php unset($_SESSION['message']); ?>