<?php
//initialize database connection
include "top.php";
?>
<!--show button and hide prompt to select image when user selects an animal-->
<script>
    function changer() {
        document.getElementById("selectAnswer").hidden = "";
        document.getElementById("hideOnClick").hidden = "hidden";
    }
</script>
<?php
//include navigation page
include "nav.php";
//get the values on form submit
if (isset($_POST["selectAnswer"])) {
    //get the values from the form
    $correctAnswer = htmlentities($_POST["hiddenCorrectAnimal"], ENT_QUOTES, "UTF-8");
    //get the user answer
    $chosenAnswer = htmlentities($_POST["animalSelection"], ENT_QUOTES, "UTF-8");
    //show what was selected and what the correct answer should be
    print 'Correct answer: ' . $correctAnswer . " Chosen Answer: " . $chosenAnswer;
}
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
//inform user how to hear sound again
print '<p>Click the play button to hear the sound again </p>';
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
//begin form
print '<form  method = "post" action = "question.php">';
//inform user to select an animal
print '<p id = "hideOnClick">Select an animal</p>';
//display each animals photo
foreach ($animalsToDisplay as $animal) {
    print '<label>';
    print '<input type="radio" name="animalSelection" onclick="changer()" class="none" value = "' . $animal . '"/>';
    print '<img src="photos/' . $animal . '.jpg" class = "animal" id = "hide">';
    print '</label>';
}
//print submit button
print '
    <fieldset class="buttons">
        <legend></legend>
        <input type="submit" id="selectAnswer" name="selectAnswer" hidden = "hidden" value="Check" tabindex="900" class = "button">
    </fieldset>';
//store the correct animal in a hidden input
print '<input type="hidden" name="hiddenCorrectAnimal" value="' . $correctAnimal[0][0] . '">';
//end form
print '</form>';
//include footer
include "footer.php";
?>