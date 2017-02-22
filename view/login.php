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

        <h1>Acme Login</h1>
            <?php
                if (isset($message)) {
                echo $message;
                }
            ?>
        <form action="/acme/accounts/index.php?action=login" method="post">
             <p>Email Address:</p>
            <input type="email" name="email" id="email"  <?php if(isset($email)){echo "value='$email'";} ?> required>
            <br />
            <label for="password">Password:</label>
            <br>
            <p>Passwords must be at least 8 characters and contain at least 1 number, 1 capital letter and 1 special character</p>
            <input type="password" name="password" id="password" required pattern="(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$">
            <br />
            <input type="submit" name="submit">
            <!-- Add the action key - value pair -->

            <input type="hidden" name="action" value="Login">

            <?php echo $accReg; ?>
           
            </form> 

       
        <hr>

         <?php
         include 'footer.php';
         ?>
        

    </section>


</body>

</html>
