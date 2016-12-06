<?php
//initialize database connection
include "top.php";
//welcome user to the site
print '<p class = "indexp">Welcome to animal sound quiz, a site to test your knowledge of wildlife.</p>';
print '<p class = "indexp">Please sign in or register to take a quiz.</p>';
//begin form for new user
print '<form action ="newuser.php">';
//print submit button
print '<input type="submit" id="newuser" name="newuser"  value="Register" tabindex="900" class = "button">';
//end form
print '</form>';
//begin form for existing user
print '<form action ="existinguser.php">';
//print submit button
print '<input type="submit" id="existinguser" name="existinguser"  value="Sign In" tabindex="900" class = "button">';
//end form
print '</form>';
//include footer
include "footer.php";
?>
