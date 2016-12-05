<?php
include "top.php";
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
    $userId = htmlentities($_POST["userPMK"], ENT_QUOTES, "UTF-8");
    //get quiz Id
    $lastQuizId = htmlentities($_POST["quizPMK"], ENT_QUOTES, "UTF-8");
    //show what was selected and what the correct answer should be
    print 'Correct answer: ' . $correctAnswer . " Chosen Answer: " . $chosenAnswer;
    ##########################NEED QUIZ ID HERE STORE IN LAST QUIZ ID#############################
    //form data array for quiz question query
    $userSelection = array($lastQuizId, $priorQuestionId, $chosenAnswer);
    //insert into tblQuizzesQuestions what the user chose
    $storeUserSelectionQuery2 = "INSERT INTO tblQuizzesQuestions (`fnkQuizId`, `fnkQuestionId`, `fnkUserChoseAnimalName`, `fldTimeToAnswer`) VALUES (?, ?, ?, NULL)";
    $thisDatabaseWriter->insert($storeUserSelectionQuery2, $userSelection, 0);
}
include "footer.php";
?>