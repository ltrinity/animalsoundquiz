<?php
//initialize database connection
include "top.php";
//include navigation page
include "nav.php";
//include mail message
include "mailmessage.php";
############################SECURITY#############################
// define security variable
$yourURL = DOMAIN . PHP_SELF;
############################INITIALIZE VARIABLES##################
$firstName = "";
$lastName = "";
$email = "";
##############################ERRORS###################
$emailERROR = false;
$errorMsg = array();
############################USER INFORMATION###########################
$mailed = false;
$messageA = "";
$messageB = "";
$messageC = "";
###############################ON SUBMIT####################
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
        if (!($exists[0][0] == "")) {
            print 'You have already registered';
            return;
        } 
        //default primary key value
        $primaryKey = "";
        //insert the user into the table
        $createUserQuery = 'INSERT INTO tblUsers SET fldEmail = ?, fldFirstName = ?, fldLastName = ?';
        $userAttributes = array($email,$firstName,$lastName);
        $results = $thisDatabaseWriter->insert($createUserQuery, $userAttributes);
        //get their primary key
        $primaryKey = $thisDatabaseWriter->lastInsert();
        //#################################################################
        // create a key value for confirmation
        //$query = "SELECT fldDateJoined FROM tblUsers WHERE pmkUserId = ? ";
        //$data2 = array($primaryKey);
        //$results = $thisDatabaseReader->select($query, $data2);
        //$dateSubmitted = $results[0]["fldDateJoined"];
        $dateSubmitted = 126;
        $key1 = sha1($dateSubmitted);
        $key2 = $primaryKey;
        print $key1;
        //#################################################################
        //
            //Put forms information into a variable to print on the screen
        //

            $messageA = '<h2>Thank you for registering.</h2>';
        $messageA .= '<p>Please check your mail for instructions.</p>';

        $messageB = "<p>Click this link to confirm your registration: ";
        $messageB .= '<a href="http:' . DOMAIN . $PATH_PARTS["dirname"] . '/confirmation.php?q=' . $key1 . '&amp;w=' . $key2 . '">Confirm Registration</a></p>';
        $messageB .= "<p>or copy and paste this url into a web browser: ";
        $messageB .= 'http:' . DOMAIN . $PATH_PARTS["dirname"] . '/confirmation.php?q=' . $key1 . '&amp;w=' . $key2 . "</p>";

        $messageC .= "<p><b>Email Address:</b><i>   " . $email . "</i></p>";

        //##############################################################
        //
            // email the form's information
        //
            $to = $email; // the person who filled out the form
        $cc = "";
        $bcc = "";
        $from = "WRONG site <noreply@yoursite.com>";
        $subject = "CS 148 registration that i forgot to change text";
        $message = $messageA . $messageB . $messageC;
        $mailed = sendMail($to, $cc, $bcc, $from, $subject, $message);

        // remove click to confirm
        $message = $messageA . $messageC;
        print '<form method = "post" action="quiz.php">';
        //store the prev id
print '<input type="text" name="pmkUserId" hidden = "hidden" value="' . $primaryKey . '">';
        //print submit button
print '<input type="submit" id="quiz" name="quiz" value="Quiz" tabindex="900" class = "button">';
print '</form>';
    } //data entered  
    // end form is valid
    // ends if form was submitted.
    //show a button that sends user to quiz page passing along their pmk
    //print '<form action="quiz.php" method = "post">'
}
################################FORM TO CREATE NEW USER###############################
print '<form method = "post" action="newuser.php">';
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