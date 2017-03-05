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
            <form method="post" action="/acmeproject/index.php?action=admin">
                <h2>Account Update</h2>
                <p> First Name:</p>
                <input name="firstname" id="firstname" value="<?php if( $_SESSION['loggedin']){ echo $_SESSION['clientData']['clientFirstname']; } ?>">
                <p>Last Name:</p>
                <input type="text" name="lastname" id="lastname"  value="<?php if( $_SESSION['loggedin']){ echo $_SESSION['clientData']['clientLastname'];} ?>" required>
                <p>Email Address:</p>
            <input type="email" name="email" id="email"  value="<?php if( $_SESSION['loggedin']){ echo $_SESSION['clientData']['clientEmail']; } ?>" required>
                <h2>Password Update</h2>
            <p>Password:</p>
                <label for="password">New password:</label>
                <span>Passwords must be at least 8 characters and contain at least 1 number, 1 capital letter and 1 special character</span>
                <br /><input type="password" name="password" id="password" pattern="(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$" value="">
                <br />
                <input type="submit" name="submit" id="regbtn" value="Update Client">
                <input type="hidden" name="action" value="updateClient">
                <input type="hidden" name="clId" value="<?php if(isset($clientInfo['clientId'])){ echo $clientInfo['clientId'];} elseif(isset($clId)){ echo $clId; } ?>">
           
            </form>
        </section>
        <hr>
         <?php
         include 'footer.php';
         ?>

    </section>


</body>

</html>
