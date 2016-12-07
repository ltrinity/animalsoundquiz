<?php
//Update schema and link on sitemap with data dictionary and specs, put in fieldset
//css on quizquestions page and questions animals page
//possibly use transparency
// Not letting a question get asked more than once
//Only show level up one time
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
