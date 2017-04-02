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
        include 'header.php';

        ?>

        <section class="form">
            <h1>Update User</h1>
            <?php
                if (isset($message)) {
                echo $message;
                    }
            ?>
            <form method="post" action="/acmeproject/accounts/index.php?action=update">
                <h2>Account Update</h2>
                <p> First Name:</p>
                <input name="firstname" id="firstname" value="<?php if(isset($_SESSION['clientData']['clientFirstname'])){ echo $_SESSION['clientData']['clientFirstname'];}?>">
                <p>Last Name:</p>
                <input type="text" name="lastname" id="lastname"  value="<?php if( $_SESSION['clientData']['clientLastname']){ echo $_SESSION['clientData']['clientLastname'];} ?>">
                <p>Email Address:</p>
            <input type="email" name="email" id="email"  value="<?php if( $_SESSION['clientData']['clientEmail']){ echo $_SESSION['clientData']['clientEmail']; } ?>">
            <br />
                <input type="submit" name="submit" id="regbtn" value="update">
                <input type="hidden" name="action" value="update">
                <input type="hidden" name="clientId" value="<?php if(isset($_SESSION['clientData']['clientId'])){ echo $_SESSION['clientData']['clientId'];} ?>">

            </form>
            <form method="post" action="/acmeproject/accounts/index.php?action=updatePassword">

                <h2>Password Update</h2>
                <?php
                if (isset($message)) {
                    echo $message;
                }
                ?>
            <h4>Password:</h4>
                <label for="password">New password:</label>
                <span>Passwords must be at least 8 characters and contain at least 1 number, 1 capital letter and 1 special character</span>
                <br /><input type="password" name="password" id="password" required pattern="(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$">
                <br />
                <input type="hidden" name="clientId" value="<?php if(isset($_SESSION['clientData']['clientId'])){ echo $_SESSION['clientData']['clientId'];} ?>">
                <input type="submit" name="submit" id="regbtn" value="update">
                <input type="hidden" name="action" value="updatePassword">

            </form>
        </section>
        <hr>
         <?php
         include 'footer.php';
         ?>

    </section>


</body>

</html>
