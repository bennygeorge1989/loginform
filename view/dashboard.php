<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel = "stylesheet" type = 'text/css' href = 'css/style.css'/>
    </head>
    <body>
        <h2>Dashboard</h2>
        <div class="container">
        <?php
            echo 'Login successfully';
        ?>
        </div>
        <div class="container">
        <?php
            echo 'Welcome '. $_SESSION['first_name'] . ' '.$_SESSION['last_name'];
        ?>
        </div>
    </body>
</html>