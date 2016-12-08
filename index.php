<?php
//data dictionary and specs, and table data put in fieldset
//Add more birds and other animals
//initialize database connection
include "top.php";
//welcome user to the site
print '<p class = "moderate">Welcome to animal sound quiz, a site to test your knowledge of wildlife.</p>';
print '<p class = "moderate">Please sign in or register to take a quiz.</p>';
//begin form for new user
print '<form action ="login.php">';
//print submit button
print '<input type="submit" id="login" name="login"  value="Login" tabindex="900" class = "button">';
//end form
print '</form>';
//include footer
include "footer.php";
?>
