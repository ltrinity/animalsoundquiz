<?php
//include top
include "top.php";
//if the form is submitted post the values
if (isset($_POST["quizquestions"])) {
    //get the user pmk
    $userPrimaryKey = htmlentities($_POST["userPrimaryKey"], ENT_QUOTES, "UTF-8");
    //get the quiz pmk
    $quizPrimaryKey = htmlentities($_POST["quizPrimaryKey"], ENT_QUOTES, "UTF-8");
}
$quizQuestionsQuery = 'SELECT fnkRightAnswerAnimalId,fnkUserChoseAnimalName FROM tblQuizzesQuestions JOIN tblQuestions ON pmkQuestionId = fnkQuestionId WHERE fnkQuizId = ?';
$data = array($quizPrimaryKey);
$questions = $thisDatabaseReader->select($quizQuestionsQuery, $data, 1);
if(is_array($questions)){
    $counter = 0;
    $numQuestions = 1;
    foreach($questions as $question){
        print '<p id ="' . $counterQuestion . '">Question '. $numQuestions . ': You chose ' . $question['fnkUserChoseAnimalName'];
        if($question['fnkRightAnswerAnimalId']==$question['fnkUserChoseAnimalName']){
            print ' which was correct.</p>';
        } else {
            print ' but the correct answer was ' . $question['fnkRightAnswerAnimalId'] . '.</p>' ;
        }
        $numQuestions++;
        //use a counter to show alternating rows in different colors
        if ($counter == 0) {
            $counter++;
        } else {
            $counter--;
        }
    }
}
//begin form
        print '<form  method = "post" action = "quiz.php">';
        //store the user pmk in a hidden input
        print '<input type="hidden" name="userPrimaryKey" value="' . $userPrimaryKey . '">';
        //print submit button
        print '<input type="submit" id="quiz" name="quiz" value="Return to the user profile page" tabindex="900" class = "button">';
        //end form
        print '</form>';