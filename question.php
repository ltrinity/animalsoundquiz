<?php
//initialize database connection
include "top.php";
//include navigation page
include "nav.php";
//select a random animal and insert it into tblQuestions as a foreign key
$getRightAnswerAnimalIdQuery = "INSERT INTO tblQuestions (fnkRightAnswerAnimalId) SELECT pmkAnimalName FROM tblAnimals ORDER BY RAND() LIMIT 1";
$thisDatabaseWriter->insert($getRightAnswerAnimalIdQuery,"",0,1);
//get the last ID created
$getLastInsertionIdQuery = "SELECT LAST_INSERT_ID() FROM tblQuestions LIMIT 1";
$lastIdArray = $thisDatabaseWriter->select($getLastInsertionIdQuery,"",0);
$lastId = array($lastIdArray[0][0]);
//get the sound for the current question based on the animal name of the last inserted id
$getCorrectAnswerAnimalNameQuery = "SELECT fnkRightAnswerAnimalId from tblQuestions WHERE pmkQuestionId = ?";
$correctAnimal = $thisDatabaseReader->select($getCorrectAnswerAnimalNameQuery,$lastId,1);
//display the sound for the correct animal
print '<audio controls>';
print'<source src="sounds/';
print $correctAnimal[0][0];
print '.mp3" type="audio/mpeg">';
print'Your browser does not support the audio element.';
print '</audio>';
//this query will get two animals that are not the correct animal
$getIncorrectAnimalsQuery = "SELECT pmkAnimalName FROM tblAnimals WHERE pmkAnimalName != ? ORDER BY RAND() LIMIT 2";
$IncorrectAnimalsQueryData = array($correctAnimal[0][0]);
$incorrectAnimals = $thisDatabaseReader->select($getIncorrectAnimalsQuery,$IncorrectAnimalsQueryData,1,2);
//create an array of the correct and incorrect animals
$animalsToDisplay = array($correctAnimal[0][0],$incorrectAnimals[0][0],$incorrectAnimals[1][0]);
//randomize the array
shuffle($animalsToDisplay);
//display each animals photo
foreach($animalsToDisplay as $animal){
print '<img src="photos/';
print $animal;
print '.jpg"  class="animal"  alt="';
print $animal;
print '"/>';}
//include footer
include "footer.php";
?>