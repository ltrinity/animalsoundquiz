<?php
//Update schema and link on sitemap
//css on question page, questionsanimals page, and answer page
//background image of animals use transparency
//Button to show details about question
// Not letting a question get asked more than once
//tblBadges and earn badges for certain achievements
//Only show level up one time
//Add more birds
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
