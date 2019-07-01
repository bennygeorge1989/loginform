<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel = "stylesheet" type = 'text/css' href = 'css/style.css'/>
    </head>
<body>
<?php
    if(isset($_SESSION['error'])) {
        echo $_SESSION['error'] ;
        unset($_SESSION['error']);
    }
?>

