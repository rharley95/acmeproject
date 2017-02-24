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
            <?php if(isset($cookieFirstname)){
                echo "<span>Welcome $cookieFirstname</span>";
            } ?>

            <h1>Welcome to Acme!</h1>
            <section class="banner">

                <div class="intro">
                    <h3>Get Dinner Rocket</h3>
                    <ul class="list">
                        <li>Quick lighting fuse</li>
                        <li>NHTSA approved seat belts.</li>
                        <li>Mobile launch stand included.</li>
                    </ul>
                    <img src="images/iwantit.gif" class="logo" alt="button">
                </div>

            </section>
            <section class="second">
                <section class="recipes">
                    <h3>Featured Recipes</h3>
                    <section class="wrapper">
                        <section class="sep">
                            <div>
                                <img src="images/recipes/bbqsand.jpg" alt="BBQ Recipe">
                                <a href="#">Pulled Roadrunner BBQ</a>
                            </div>
                            <div>
                                <img src="images/recipes/potpie.jpg" alt="Potpie Recipe">
                                <a href="#">Roadrunner Pot Pie</a>
                            </div>
                        </section>
                        <section class="sep">
                            <div>
                                <img src="images/recipes/soup.jpg" alt="Soup Recipe">
                                <a href="#">Roadrunner soup</a>
                            </div>
                            <div>
                                <img src="images/recipes/taco.jpg" alt="Taco Recipe">
                                <a href="#">Roadrunner tacos</a>
                            </div>
                        </section>
                    </section>

                </section>



                <section class="reviews">
                    <h3>Get Dinner Rocket Reviews</h3>
                    <ul>
                        <li>"I don't know how I ever caught roadrunners before this..."(9/10)</li>
                        <li>"That thing was fast!" (8/10)</li>
                        <li>"Talk about fast delivery."(10/10)</li>
                        <li>"I didn't even have to pull the meat apart." (9/10)</li>
                        <li>I'm on my thirtieth one. I love these things!(10/10)</li>

                    </ul>

                </section>
            </section>
        </section>
        <hr>
         <?php
         include 'footer.php'
         ?>

    </section>


</body>

</html>
