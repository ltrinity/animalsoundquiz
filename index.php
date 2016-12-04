<?php
//initialize database connection
include "top.php";
//include navigation page
include "nav.php";
#################################FORMS FOR CURRENT OR EXISTING USER#########################
print '<form action ="newuser.php">';
//print submit button
print '<input type="submit" id="newuser" name="newuser"  value="New User" tabindex="900" class = "button">';
print '</form>';
print '<form action ="existinguser.php">';
//print submit button
print '<input type="submit" id="existinguser" name="existinguser"  value="Existing User" tabindex="900" class = "button">';
print '</form>';
//include footer
include "footer.php";
?>
