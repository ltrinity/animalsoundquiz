<?php
//include top
include "top.php";
//if the form is submitted post the values
if (isset($_POST["questionsanimals"])) {
    //get the user pmk
    $userPrimaryKey = htmlentities($_POST["userPrimaryKey"], ENT_QUOTES, "UTF-8");
    //get the quiz pmk
    $quizPrimaryKey = htmlentities($_POST["quizPrimaryKey"], ENT_QUOTES, "UTF-8");
    //get right answer
    $correctKey = htmlentities($_POST["rightAnswer"], ENT_QUOTES, "UTF-8");
    //get wrong answer
    $incorrectKey = htmlentities($_POST["userAnswer"], ENT_QUOTES, "UTF-8");
}
//inform user how to hear sound
print '<p>Click the play button to hear the sound </p>';
//display the sound for the correct animal
print '<audio controls autoplay>';
print'<source src="sounds/';
print $correctKey;
print '.mp3" type="audio/mpeg">';
print'Your browser does not support the audio element.';
print '</audio>';
//display photo
    print '<img src="photos/' . $correctKey . '.jpg" class = "animal">';
    //inform user how to hear sound
print '<p>Click the play button to hear the sound </p>';
//display the sound for the correct animal
print '<audio controls autoplay>';
print'<source src="sounds/';
print $incorrectKey;
print '.mp3" type="audio/mpeg">';
print'Your browser does not support the audio element.';
print '</audio>';
//display photo
    print '<img src="photos/' . $incorrectKey . '.jpg" class = "animal">';
print '<form  method = "post" action = "quizquestions.php">';
        //store the user pmk in a hidden input
        print '<input type="hidden" name="userPrimaryKey" value="' . $userPrimaryKey . '">';
        //store the user pmk in a hidden input
        print '<input type="hidden" name="quizPrimaryKey" value="' . $quizPrimaryKey . '">';
        //print submit button
        print '<input type="submit" id="quizquestions" name="quizquestions" value="Back" tabindex="900" class = "button">';
        //end form
        print '</form>';