<?php

//initialize database connection
include "top.php";
//include navigation page
include "nav.php";
//include mail message function
include "mailmessage.php";
// define security variable
$yourURL = DOMAIN . PHP_SELF;
//initialize variables
$firstName = "";
$lastName = "";
$email = "";
$mailed = false;
$messageA = "";
$messageB = "";
$messageC = "";
//create error message boolean variables and array to hold error messages
$emailERROR = false;
$errorMsg = array();
//when a user submits the form to register
if (isset($_POST["register"])) {
    //get the first name
    $firstName = htmlentities($_POST["firstName"], ENT_QUOTES, "UTF-8");
    //get the last name
    $lastName = htmlentities($_POST["lastName"], ENT_QUOTES, "UTF-8");
    //get the email
    $email = htmlentities($_POST["email"], ENT_QUOTES, "UTF-8");
    //if they do not enter an email
    if ($email == "") {
        $errorMsg[] = "Please enter your email address";
        $emailERROR = true;
    }
    //if there is no error
    if (!$errorMsg) {
        //test if user exists
        $userQuery = 'SELECT pmkUserId FROM tblUsers WHERE fldFirstName LIKE ? AND fldLastName LIKE ? AND fldEmail LIKE ?';
        $userAttributes = array($firstName, $lastName, $email);
        $exists = $thisDatabaseReader->select($userQuery, $userAttributes, 1, 2);
        //if they exist print a link to the existing user login page
        if (!($exists[0][0] == "")) {
            print '<a href="existinguser.php">You have already registered click here to login</a>';
            return;
        }
        //default primary key value
        $userPrimaryKey = "";
        //insert the user into the table
        $createUserQuery = 'INSERT INTO tblUsers SET fldEmail = ?, fldFirstName = ?, fldLastName = ?';
        $userAttributes = array($email, $firstName, $lastName);
        $results = $thisDatabaseWriter->insert($createUserQuery, $userAttributes);
        //get their primary key
        $userPrimaryKey = $thisDatabaseWriter->lastInsert();
        // create a key value for confirmation
        $getDateJoinedQuery = "SELECT fldDateJoined FROM tblUsers WHERE pmkUserId = ? ";
        $userId = array($userPrimaryKey);
        $dateArray = $thisDatabaseReader->select($getDateJoinedQuery, $userId);
        $dateSubmitted = $dateArray[0]["fldDateJoined"];
        $key1 = sha1($dateSubmitted);
        $key2 = $userPrimaryKey;
        //generate messages
        $messageA = '<h2>Thank you for registering.</h2>';
        $messageA .= '<p>Please check your mail for instructions.</p>';

        $messageB = "<p>Click this link to confirm your registration: ";
        $messageB .= '<a href="http:' . DOMAIN . $PATH_PARTS["dirname"] . '/confirmation.php?q=' . $key1 . '&amp;w=' . $key2 . '">Confirm Registration</a></p>';
        $messageB .= "<p>or copy and paste this url into a web browser: ";
        $messageB .= 'http:' . DOMAIN . $PATH_PARTS["dirname"] . '/confirmation.php?q=' . $key1 . '&amp;w=' . $key2 . "</p>";

        $messageC .= "<p><b>Email Address:</b><i>   " . $email . "</i></p>";


        // email the form's information
        $to = $email; // the person who filled out the form
        $cc = "";
        $bcc = "";
        $from = "Animal Sound Quiz<animalsoundquiz@gmail.com>";
        $subject = "Thank you for registering";
        $message = $messageB;
        $mailed = sendMail($to, $cc, $bcc, $from, $subject, $message);

        // remove click to confirm
        $message = $messageA . $messageC;
        //inform the user
        print '<p>' . $message . '</p>';
        
        //begin form that sends user primary key to quiz page
        print '<form method = "post" action="quiz.php">';
        //store the user pmk in a hidden input
        print '<input type="text" name="userPrimaryKey" hidden = "hidden" value="' . $userPrimaryKey . '">';
        //print submit button
        print '<input type="submit" id="quiz" name="quiz" value="Quiz" tabindex="900" class = "button">';
        //end form
        print '</form>';
    } 
}
//here is the main form to register
print '<form method = "post" action="newuser.php">';
//user enter their first name, last name, and email
print '<p>Enter your first name</p>';
print '<input id="firstName" maxlength="45" name="firstName" onfocus=this.select() type="text" value="' . $firstName . '">';
print '<p>Enter your last name</p>';
print '<input id="lastName" maxlength="45" name="lastName" onfocus=this.select() type="text" value="' . $lastName . '">';
print '<p>Enter your email</p>';
print '<input id="email" maxlength="45" name="email" onfocus=this.select() type="text" value="' . $email . '">';
//print submit button
print '<input type="submit" id="register" name="register" value="Register" tabindex="900" class = "button">';
//end the form
print '</form>';
//include footer
include "footer.php";
?>