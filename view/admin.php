
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
            <ol><?php echo $clientData['email']; ?></ol>

        </ul>



    </section>

    <hr>
    <?php
    include 'footer.php'
    ?>

</section>


</body>

</html>

