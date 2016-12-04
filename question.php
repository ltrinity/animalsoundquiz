<?php
//initialize database connection
include "top.php";
?>
<!--script to show button when an animal is selected
prompt user to select an animal if they have not-->
<script>
    function showhide(element) {
        document.getElementById("questionSubmitButton").hidden = "";
        document.getElementById("promptToPickAnimal").hidden = "hidden";
        var id = element.id
        var label = "label";
        var labelId = id.concat(label);
        var textarray = document.getElementsByClassName("textunder");
        textarray[0].style.fontSize = "large";
        textarray[1].style.fontSize = "large";
        textarray[2].style.fontSize = "large";
        document.getElementById(labelId).style.fontSize = "xx-large" ;
    }
</script>
<?php
//include navigation
include "nav.php";
############################QUESTION CREATION######################
//first create a new question
//select a random animal and insert it into tblQuestions as a foreign key
$getRightAnswerAnimalIdQuery = "INSERT INTO tblQuestions (fnkRightAnswerAnimalId) SELECT pmkAnimalName FROM tblAnimals ORDER BY RAND() LIMIT 1";
$thisDatabaseWriter->insert($getRightAnswerAnimalIdQuery, "", 0, 1);
//get the last ID created
$getLastInsertionIdQuery = "SELECT LAST_INSERT_ID() FROM tblQuestions LIMIT 1";
$lastIdArray = $thisDatabaseWriter->select($getLastInsertionIdQuery, "", 0);
$lastId = array($lastIdArray[0][0]);
//get the sound for the current question based on the animal name of the last inserted id
$getCorrectAnswerAnimalNameQuery = "SELECT fnkRightAnswerAnimalId from tblQuestions WHERE pmkQuestionId = ?";
$correctAnimal = $thisDatabaseReader->select($getCorrectAnswerAnimalNameQuery, $lastId, 1);
########################AUDIO#####################################
//inform user how to hear sound again
print '<p>Click the play button to hear the sound again </p>';
//display the sound for the correct animal
print '<audio controls autoplay>';
print'<source src="sounds/';
print $correctAnimal[0][0];
print '.mp3" type="audio/mpeg">';
print'Your browser does not support the audio element.';
print '</audio>';
##########################INCORRECT OPTION DISPLAY#######################################
//this query will get two animals that are not the correct animal
$getIncorrectAnimalsQuery = "SELECT pmkAnimalName FROM tblAnimals WHERE pmkAnimalName != ? ORDER BY RAND() LIMIT 2";
$IncorrectAnimalsQueryData = array($correctAnimal[0][0]);
$incorrectAnimals = $thisDatabaseReader->select($getIncorrectAnimalsQuery, $IncorrectAnimalsQueryData, 1, 2);
##############################COMBINE ALL THREE ANIMALS IN ARRAY###########################
//create an array of the correct and incorrect animals
$animalsToDisplay = array($correctAnimal[0][0], $incorrectAnimals[0][0], $incorrectAnimals[1][0]);
//randomize the array
shuffle($animalsToDisplay);
###########################BEGIN FORM############################################
print '<form  method = "post" action = "answer.php">';
//inform user to select an animal
print '<p id = "promptToPickAnimal">Select an animal by clicking on a picture</p>';
//display each animals photo
foreach ($animalsToDisplay as $animal) {
    print '<div class="imagetext">';
    print '<label>';
    //create a hidden radio button
    print '<input type="radio" name="animalSelection" onclick="showhide(this)" class="none" value = "' . $animal . '" id = "' . $animal . '"/>';
    //display photo
    print '<img src="photos/' . $animal . '.jpg" class = "animal">';
    print '<span class = "textunder" id = "'. $animal . 'label">' . $animal . '</span>';
    print '</label>';
    print '</div>';
}
//print submit button
print '
    <fieldset class="buttons">
        <legend></legend>
        <input type="submit" id="questionSubmitButton" name="questionSubmitButton" hidden = "hidden" value="Check" tabindex="900" class = "button">
    </fieldset>';
//store the prev question id
print '<input type="text" name="questionIdPrior" hidden = "hidden" value="' . $lastId[0] . '">';
//store the correct animal in a hidden input
print '<input type="hidden" name="hiddenCorrectAnimal" value="' . $correctAnimal[0][0] . '">';
//end form
print '</form>';
//include footer
include "footer.php";
?>