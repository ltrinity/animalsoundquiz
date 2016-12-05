<?php
include "top.php";
include "nav.php";
//if the form is submitted post the values
if (isset($_POST["quiz"])) {
    $pmkUserId = htmlentities($_POST["pmkUserId"], ENT_QUOTES, "UTF-8");
    print $pmkUserId;
}
//if the form is submitted post the values
if (isset($_POST["existinglogin"])) {
    //get the first name
    $firstName = htmlentities($_POST["firstName"], ENT_QUOTES, "UTF-8");
    //get the last name
    $lastName = htmlentities($_POST["lastName"], ENT_QUOTES, "UTF-8");
    //get the email
    $email = htmlentities($_POST["email"], ENT_QUOTES, "UTF-8");
    $getuserIdQuery = 'SELECT pmkUserId from tblUsers WHERE fldFirstName = ? AND fldLastName = ? AND fldEmail = ?';
    $userAttributes = array($firstName,$lastName,$email);
    $pmkUserId = $thisDatabaseReader->select($getuserIdQuery, $userAttributes, 1,2);
    print $pmkUserId[0][0];
}
//show quizzes taken and results, start a new quiz and and redirect to question page
include "footer.php";
?>