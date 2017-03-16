<?php
/**
 * Created by PhpStorm.
 * User: rominapainter
 * Date: 3/16/17
 * Time: 8:48 AM
 */

if (isset($_SESSION['message'])) {
    $message = $_SESSION['message'];
}

?>
<!DOCTYPE html>
<html>

<head>
    <title>Acme | Image Management</title>
    <link rel="stylesheet" type="text/css" href="/acmeproject/styles.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body>

<section class="main">

    <?php
    include 'header.php'
    ?>

    <section class="content">

        <h1>Image Management</h1>
        <h2>Add New Product Image</h2>
        <?php
        if (isset($message)) {
            echo $message;
        }
        ?>
        <form action="/acmeproject/uploads/" method="post" enctype="multipart/form-data">
            <label for="invItem">Product</label><br>
            <?php echo $prodSelect; ?><br><br>
            <label>Upload Image:</label><br>
            <input type="file" name="file1"><br>
            <input type="submit" class="regbtn" value="Upload">
            <input type="hidden" name="action" value="upload">
        </form>

        <hr>
        <h2>Existing Images</h2>
        <p class="notice">If deleting an image, delete the thumbnail too and vice versa.</p>
        <?php
        if (isset($imageDisplay)) {
            echo $imageDisplay;
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

<?php unset($_SESSION['message']); ?>


