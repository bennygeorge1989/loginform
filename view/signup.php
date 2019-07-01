<?php
  include_once('view/header.php');
?>
<h2>Signup</h2>

<form method = 'post' id = 'myForm' action = ''>
  <div class="imgcontainer">
    <img src="images/person.png" class="avatar">
  </div>

  <div class="container">
    <label for="email"><b>Email:</b></label>
    <input type="email" placeholder="Enter Username" name="email" required>

    <label for="fname"><b>Firstname:</b></label>
    <input type="text" placeholder="Enter Firstname" name="fname" required>

    <label for="lname"><b>Lastname:</b></label>
    <input type="text" placeholder="Enter Lastname" name="lname" required>

    <label for="psw"><b>Password:</b></label>
    <input type="password" placeholder="Enter Password" name="pwd" required>

    <label for="psw"><b>Confirm Password:</b></label>
    <input type="password" placeholder="Enter Password" name="cpwd" required>

    <label for="dob"><b>Date of birth:</b></label>
    <input type="date" placeholder="Enter Date of birth" name="dob" required>
    
    <input type="submit" class="button" name = 'submit' value = "Signup"> 
    <a href = "index.php?action=login" class = "button">Back to Login</a>
  </div>

  <div class="container" style="background-color:#f1f1f1">
  </div>
</form>
<?php
	include_once('view/footer.php');
?>
