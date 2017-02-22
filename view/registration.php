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
            <h1> Registration </h1>
            <?php
                if (isset($message)) {
                echo $message;
                    }
            ?>
            <form method="post" action="/acmeproject/accounts/index.php">
                <p> First Name:</p>
                <input name="firstname" id="firstname" <?php if(isset($firstname)){echo "value='$firstname'";} ?> required>
                <p>Last Name:</p>
                <input type="text" name="lastname" id="lastname"  <?php if(isset($lastname)){echo "value='$lastname'";} ?> required>
                <p>Email Address:</p>
            <input type="email" name="email" id="email"  <?php if(isset($email)){echo "value='$email'";} ?> required>
            
            <p>Password:</p>
                <label for="password">Password:</label>
                <span>Passwords must be at least 8 characters and contain at least 1 number, 1 capital letter and 1 special character</span>
                <br /><input type="password" name="password" id="password" pattern="(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$" required>
                <br />
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
