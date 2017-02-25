<?php
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


                <form method="post" action="/acmeproject/categories/index.php">
                    <?php
                    if (isset($message)) {
                        echo $message;
                    }
                    ?>
                    <h1> Add Category </h1>
                    <input type="text" name="catname" id="catname" <?php if(isset($catname)){echo "value='$catname'";} ?> required>

                    <input type="submit" name="submit" id="regbtn" value="Register">
                    <!-- Add the action key - value pair -->
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
