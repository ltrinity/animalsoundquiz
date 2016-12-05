<?php
//initialize database connection
include "top.php";
//include navigation page
include "nav.php";
//begin form for new user
print '<form action ="newuser.php">';
//print submit button
print '<input type="submit" id="newuser" name="newuser"  value="New User" tabindex="900" class = "button">';
//end form
print '</form>';
//begin form for existing user
print '<form action ="existinguser.php">';
//print submit button
print '<input type="submit" id="existinguser" name="existinguser"  value="Existing User" tabindex="900" class = "button">';
//end form
print '</form>';
//include footer
include "footer.php";
?>
