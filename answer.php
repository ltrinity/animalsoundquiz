<?php
//include top
include "top.php";
//includ nav
include "nav.php";
//if the form is submitted post the values
if (isset($_POST["questionSubmitButton"])) {
    //get the correct Answer
    $correctAnswer = htmlentities($_POST["hiddenCorrectAnimal"], ENT_QUOTES, "UTF-8");
    //get the user answer
    $chosenAnswer = htmlentities($_POST["animalSelection"], ENT_QUOTES, "UTF-8");
    //get question Id
    $priorQuestionId = htmlentities($_POST["questionIdPrior"], ENT_QUOTES, "UTF-8");
    //get user Id
    $userPrimaryKey = htmlentities($_POST["userPrimaryKey"], ENT_QUOTES, "UTF-8");
    //get quiz Id
    $quizPrimaryKey = htmlentities($_POST["quizPrimaryKey"], ENT_QUOTES, "UTF-8");
    //show what was selected and what the correct answer should be
    print 'Correct answer: ' . $correctAnswer . " Chosen Answer: " . $chosenAnswer;
    //form data array for quiz question query
    $userSelection = array($quizPrimaryKey, $priorQuestionId, $chosenAnswer);
    //insert into tblQuizzesQuestions what the user chose
    $storeUserSelectionQuery2 = "INSERT INTO tblQuizzesQuestions (`fnkQuizId`, `fnkQuestionId`, `fnkUserChoseAnimalName`, `fldTimeToAnswer`) VALUES (?, ?, ?, NULL)";
    $thisDatabaseWriter->insert($storeUserSelectionQuery2, $userSelection, 0);
    #################CALCULATE HOW MANY QUESTIONS HAVE BEEN ASKED IN THE CURRENT QUIZ
}
//begin form to start new question
print '<form  method = "post" action = "question.php">';
//store the user pmk in a hidden input
print '<input type="hidden" name="userPrimaryKey" value="' . $userPrimaryKey . '">';
//store the quiz id in a hidden input
print '<input type="hidden" name="quizPrimaryKey" value="' . $quizPrimaryKey . '">';
//print submit button
print '<input type="submit" id="newquestion" name="newquestion" value="Next Question" tabindex="900" class = "button">';
//end form
print '</form>';
//include footer
include "footer.php";
?>