
<header>



<img src="/acmeproject/images/logo.gif" alt="Logo" class="logo">
            <div class="toplinks">
                <?php if(isset($_SESSION['clientData']['clientFirstname'])){
                    echo "<a href='/acmeproject/accounts/index.php?action=admin'><span>Welcome " .  $_SESSION['clientData']['clientFirstname'] . "</span></a> ";
                }

                 if(isset($_SESSION['loggedin'])){
                    echo '<a href="/acmeproject/accounts/index.php?action=logout">Logout</a>';
                }

                else{
                    echo '<a href="/acmeproject/accounts/index.php?action=login">Login</a>';
                }

                //if(isset($_SESSION['loggedin'])) {
                    echo $accLog;
                //}

                 ?>
                <a href=""><img src="/acmeproject/images/help.gif" alt="help icon">Help</a>
            </div>
        </header>
        <nav>
           <?php echo $buildNav; ?>
        </nav>
