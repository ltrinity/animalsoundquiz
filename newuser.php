<?php

//initialize database connection
include "top.php";
//include navigation page
include "nav.php";
#########################MAKE SURE THE FORM IS CORRECT####################################
$firstName = "";
$lastName = "";
$email = "";
//if the form is submitted post the values
if (isset($_POST["register"])) {
    //get the username
    $firstName = htmlentities($_POST["firstName"], ENT_QUOTES, "UTF-8");
    //get the username
    $lastName = htmlentities($_POST["lastName"], ENT_QUOTES, "UTF-8");
    //test if username is already in database
    $email = htmlentities($_POST["email"], ENT_QUOTES, "UTF-8");
    //test if user exists
    $userQuery = 'SELECT pmkUserId FROM tblUsers WHERE fldFirstName LIKE ? AND fldLastName LIKE ? AND fldEmail LIKE ?';
    $userAttributes = array($firstName, $lastName, $email);
    $exists = $thisDatabaseReader->select($userQuery, $userAttributes, 1, 2);
    if ($exists[0][0] == "") {
        print 'nope';
    } else {
        print 'exists';
    }
    //show a button that sends user to quiz page passing along their pmk
    //print '<form action="quiz.php" method = "post">'
}
################################FORM TO CREATE NEW USER###############################
print '<form method = "post" action="index.php">';
print '<p>Enter your first name</p>';
print '<input id="firstName" maxlength="45" name="firstName" onfocus=this.select() type="text" value="' . $firstName . '">';
print '<p>Enter your last name</p>';
print '<input id="lastName" maxlength="45" name="lastName" onfocus=this.select() type="text" value="' . $lastName . '">';
print '<p>Enter your email</p>';
print '<input id="email" maxlength="45" name="email" onfocus=this.select() type="text" value="' . $email . '">';
//print submit button
print '<input type="submit" id="register" name="register" value="Register" tabindex="900" class = "button">';
print '</form>';
###############################################################################################
//include footer
include "footer.php";
?>