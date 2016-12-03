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
    //show what was selected and what the correct answer should be
    print 'Correct answer: ' . $correctAnswer . " Chosen Answer: " . $chosenAnswer;
    //insert into tblQuizze new quiz
    $storeUserSelectionQuery = 'INSERT INTO tblQuizzes SET fldQuizName = "test"';
    $thisDatabaseWriter->insert($storeUserSelectionQuery, "", 0, 0, 2);
    //get the last ID created
    $getLastInsertionIdQuery = "SELECT LAST_INSERT_ID() FROM tblQuizzes LIMIT 1";
    $lastIdArray = $thisDatabaseWriter->select($getLastInsertionIdQuery, "", 0);
    $lastQuizId = $lastIdArray[0][0];
    //form data array for quiz question query
    $userSelection = array($lastQuizId, $priorQuestionId, $chosenAnswer);
    //insert into tblQuizzesQuestions what the user chose
    $storeUserSelectionQuery2 = "INSERT INTO tblQuizzesQuestions (`fnkQuizId`, `fnkQuestionId`, `fnkUserChoseAnimalName`, `fldTimeToAnswer`) VALUES (?, ?, ?, NULL)";
    $thisDatabaseWriter->insert($storeUserSelectionQuery2, $userSelection, 0);
}
include "footer.php";
?>