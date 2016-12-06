<?php
include "top.php";
include "nav.php";
//error from existing user page if they dont exist
$existsError = false;
//if the form is submitted on the new user page post the value
if (isset($_POST["quiz"])) {
    //get the user id for a new user
    $userPrimaryKey = htmlentities($_POST["userPrimaryKey"], ENT_QUOTES, "UTF-8");
}
//if a user ended a quiz
if (isset($_POST["endquiz"])) {
    //get the user id for a new user
    $userPrimaryKey = htmlentities($_POST["userPrimaryKey"], ENT_QUOTES, "UTF-8");
}
//if the form is submitted on the existing user page get the pmk
if (isset($_POST["existinglogin"])) {
    //get the first name
    $firstName = htmlentities($_POST["firstName"], ENT_QUOTES, "UTF-8");
    //get the last name
    $lastName = htmlentities($_POST["lastName"], ENT_QUOTES, "UTF-8");
    //get the email
    $email = htmlentities($_POST["email"], ENT_QUOTES, "UTF-8");
    //get the primary key of this user
    $getuserIdQuery = 'SELECT pmkUserId from tblUsers WHERE fldFirstName = ? AND fldLastName = ? AND fldEmail = ?';
    $userAttributes = array($firstName, $lastName, $email);
    $pmkUserId = $thisDatabaseReader->select($getuserIdQuery, $userAttributes, 1, 2);
    $userPrimaryKey = $pmkUserId[0][0];
    if($userPrimaryKey==""){
        $existsError = true;
        print '<p><a href="newuser.php">A user does not exist with this information. Click here to register.</a></p>';
        print '<p><a href="existinguser.php">Click here to retry login.</a></p>';
    }
}
if(!$existsError){
//we are going to display the information available about the current user
$userAttributesQuery = 'SELECT fldFirstName,fldLastName,fnkFavoriteAnimalName,fldEmail, fldDateJoined, fldLevel FROM tblUsers WHERE pmkUserId = ?';
//store the primary key in an array
$pmkArray = array($userPrimaryKey);
$userAttributes = $thisDatabaseReader->select($userAttributesQuery, $pmkArray, 1);
//display their information
print '<p>First Name: ' . $userAttributes[0]['fldFirstName'] . '</p>';
print '<p>Last Name: ' . $userAttributes[0]['fldLastName'] . '</p>';
print '<p>Email: ' . $userAttributes[0]['fldEmail'] . '</p>';
print '<p>Account Created: ' . $userAttributes[0]['fldDateJoined'] . '</p>';
print '<p>Level: ' . $userAttributes[0]['fldLevel'] . '</p>';
//display photo
print '<img src="photos/' . $userAttributes[0]['fnkFavoriteAnimalName'] . '.jpg" class = "animal">';
//get the quizzes the current user has taken
$quizInformationQuery = 'SELECT fldNumberCorrect,fldTotalQuestions,fldQuizName,fldDateCreated,pmkQuizId FROM tblUsersQuizzes JOIN tblQuizzes ON pmkQuizId = fnkQuizId WHERE fnkUserId = ?';
$quizzes = $thisDatabaseReader->select($quizInformationQuery, $pmkArray, 1);
//if they have taken a quiz display the information we have about it
if (is_array($quizzes)) {
    $counter = 0;
    foreach ($quizzes as $quiz) {
        print '<p id="' . $counter . '" >Quiz Name: ' . $quiz['fldQuizName'] . ' Date: ' . $quiz['fldDateCreated'] .
                ' Total Questions: ' . $quiz['fldTotalQuestions'] . ' Number Correct: ' . $quiz['fldNumberCorrect'] . '</p>';
        //we will now create a form that goes to a page with more information about the quiz
        //begin form
        print '<form  method = "post" action = "quizquestions.php">';
        //store the user pmk in a hidden input
        print '<input type="hidden" name="userPrimaryKey" value="' . $userPrimaryKey . '">';
        //store the quiz pmk in a hidden input
        print '<input type="hidden" name="quizPrimaryKey" value="' . $quiz['pmkQuizId'] . '">';
        //print submit button
        print '<input type="submit" id="quizquestions" name="quizquestions" value="Review this quiz" tabindex="900" class = "button">';
        //end form
        print '</form>';
        //use a counter to show alternating rows in different colors
        if ($counter == 0) {
            $counter++;
        } else {
            $counter--;
        }
    }
}
//begin form
print '<form  method = "post" action = "question.php">';
//let user choose name of quiz
print '<p>Enter your quiz name</p>';
print '<input id="quizName" maxlength="45" name="quizName" onfocus=this.select() type="text">';
//store the user pmk in a hidden input
print '<input type="hidden" name="userPrimaryKey" value="' . $userPrimaryKey . '">';
//print submit button
print '<input type="submit" id="quizSubmit" name="quizSubmit" value="Start a Quiz" tabindex="900" class = "button">';
//end form
print '</form>';}
//footer
include "footer.php";
?>