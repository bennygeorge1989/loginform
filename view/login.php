<?php
  include_once('view/header.php');
?>
<h2>Login</h2>

<form method = 'post' id = 'myForm' action = ''>
  <div class="imgcontainer">
    <img src="images/person.png" class="avatar">
  </div>
  <div class="container">
    <label for="uname"><b>Email:</b></label>
    <input type="email" placeholder="Enter Email" name="email" required>

    <label for="psw"><b>Password:</b></label>
    <input type="password" placeholder="Enter Password" name="pwd" required>
        
    <input type="submit" class="button" value = 'Login' name ='submit'>
    <a href = "signup.php" class = "button">Signup</a>
  </div>
  <div class="container" style="background-color:#f1f1f1">
  </div>
</form>
<?php
	include_once('view/footer.php');
?>
