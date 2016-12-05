<?php
//initialize database connection
include "top.php";
?>
<!--script to show button when an animal is selected
prompt user to select an animal if they have not-->
<script>
    function showhide(element) {
        //show the submit button
        document.getElementById("questionSubmitButton").hidden = "";
        //hide the prompt to select an animal
        document.getElementById("promptToPickAnimal").hidden = "hidden";
        //get the id of the element passed in to the function
        //use this id to create the id of the label below the image
        var id = element.id
        var label = "label";
        var labelId = id.concat(label);
        //get all the text itmes
        var textarray = document.getElementsByClassName("textunder");
        //make sure the old selection returns to normal size
        for (var i = 0; i < textarray.length; i++) {
            textarray[i].style.fontSize = "large";
        }
        //make the selected animal larger
        document.getElementById(labelId).style.fontSize = "xx-large";
    }
</script>
<?php
//include navigation
include "nav.php";
//when the user is sent from the answer page to get a new question
if (isset($_POST["newquestion"])) {
    //get user Id
    $userPrimaryKey = htmlentities($_POST["userPrimaryKey"], ENT_QUOTES, "UTF-8");
    //get quiz Id
    $quizPrimaryKey = htmlentities($_POST["quizPrimaryKey"], ENT_QUOTES, "UTF-8");
}
//when the user starts a new quiz
if (isset($_POST["quizSubmit"])) {
    //get the pmk
    $userPrimaryKey = htmlentities($_POST["pmkUserId"], ENT_QUOTES, "UTF-8");
    //get the quiz name
    $quizName = htmlentities($_POST["quizName"], ENT_QUOTES, "UTF-8");
    $quizArray = array($quizName);
    //insert into tblQuizzes new quiz
    $storeUserSelectionQuery = 'INSERT INTO tblQuizzes SET fldQuizName = ?';
    $thisDatabaseWriter->insert($storeUserSelectionQuery, $quizArray);
    //get the last ID created
    $quizPrimaryKey = $thisDatabaseWriter->lastInsert();
    //insert the foreign keys of the user and the quiz into tblUsersQuizzes
    $userQuizInsertionQuery = "INSERT INTO tblUsersQuizzes SET fnkUserId = ?, fnkQuizId = ?";
    $userQuizAttributes = array($userPrimaryKey, $quizPrimaryKey);
    $thisDatabaseWriter->insert($userQuizInsertionQuery, $userQuizAttributes);
}
//We will now create a question
//select a random animal and insert it into tblQuestions as a foreign key
$getRightAnswerAnimalIdQuery = "INSERT INTO tblQuestions (fnkRightAnswerAnimalId) SELECT pmkAnimalName FROM tblAnimals ORDER BY RAND() LIMIT 1";
$thisDatabaseWriter->insert($getRightAnswerAnimalIdQuery, "", 0, 1);
//get the last ID created
$lastId = array($thisDatabaseWriter->lastInsert());
//get the sound for the current question based on the animal name of the last inserted id
$getCorrectAnswerAnimalNameQuery = "SELECT fnkRightAnswerAnimalId from tblQuestions WHERE pmkQuestionId = ?";
$correctAnimal = $thisDatabaseReader->select($getCorrectAnswerAnimalNameQuery, $lastId, 1);
//inform user how to hear sound
print '<p>Click the play button to hear the sound </p>';
//display the sound for the correct animal
print '<audio controls autoplay>';
print'<source src="sounds/';
print $correctAnimal[0][0];
print '.mp3" type="audio/mpeg">';
print'Your browser does not support the audio element.';
print '</audio>';
//this query will get two animals that are not the correct animal
$getIncorrectAnimalsQuery = "SELECT pmkAnimalName FROM tblAnimals WHERE pmkAnimalName != ? ORDER BY RAND() LIMIT 2";
$IncorrectAnimalsQueryData = array($correctAnimal[0][0]);
$incorrectAnimals = $thisDatabaseReader->select($getIncorrectAnimalsQuery, $IncorrectAnimalsQueryData, 1, 2);
//create an array of the correct and incorrect animals
$animalsToDisplay = array($correctAnimal[0][0], $incorrectAnimals[0][0], $incorrectAnimals[1][0]);
//randomize the array
shuffle($animalsToDisplay);
//begin the form
print '<form  method = "post" action = "answer.php">';
//inform user to select an animal
print '<p id = "promptToPickAnimal">Select an animal by clicking on a picture</p>';
//display each animals photo
foreach ($animalsToDisplay as $animal) {
    //wrap the image and text in a div
    print '<div class="imagetext">';
    print '<label>';
    //create a hidden radio button
    print '<input type="radio" name="animalSelection" onclick="showhide(this)" class="none" value = "' . $animal . '" id = "' . $animal . '"/>';
    //display photo
    print '<img src="photos/' . $animal . '.jpg" class = "animal">';
    //this text will display the animal name under its photo
    print '<span class = "textunder" id = "' . $animal . 'label">' . $animal . '</span>';
    print '</label>';
    print '</div>';
}
//print submit button
print '<input type="submit" id="questionSubmitButton" name="questionSubmitButton" hidden = "hidden" value="Check" tabindex="900" class = "button">';
//store the prev question id
print '<input type="text" name="questionIdPrior" hidden = "hidden" value="' . $lastId[0] . '">';
//store the correct animal in a hidden input
print '<input type="hidden" name="hiddenCorrectAnimal" value="' . $correctAnimal[0][0] . '">';
//store the user pmk in a hidden input
print '<input type="hidden" name="userPrimaryKey" value="' . $userPrimaryKey . '">';
//store the quiz pmk in a hidden input
print '<input type="hidden" name="quizPrimaryKey" value="' . $quizPrimaryKey . '">';
//end form
print '</form>';
//include footer
include "footer.php";
?>