<?php
  include_once('view/header.php');
?>
    <div class="imgcontainer">
        <img src="images/person.png" class="avatar">
    </div>

    <div class="container">
        <label for="email">
            <b> <?php echo 'Welcome '. $_SESSION['first_name'] . ' '.$_SESSION['last_name'];?>:</b>
        </label>            
    </div>
<?php
	include_once('view/footer.php');
?>