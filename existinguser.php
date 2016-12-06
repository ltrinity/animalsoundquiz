<?php
//initialize database connection
include "top.php";
//initialize variables
$firstName = "";
$lastName = "";
$email = "";
//begin form
print '<form method = "post" action="quiz.php">';
print '<p>Enter your first name</p>';
print '<input id="firstName" maxlength="45" name="firstName" onfocus=this.select() type="text" value="' . $firstName . '">';
print '<p>Enter your last name</p>';
print '<input id="lastName" maxlength="45" name="lastName" onfocus=this.select() type="text" value="' . $lastName . '">';
print '<p>Enter your email</p>';
print '<input id="email" maxlength="45" name="email" onfocus=this.select() type="text" value="' . $email . '">';
//print submit button
print '<input type="submit" id="existinglogin" name="existinglogin" value="Login" tabindex="900" class = "button">';
print '</form>';
###############################################################################################
//include footer
include "footer.php";
?>
