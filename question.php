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

//this code displays an animals photo
//print '<img src="photos/';
//print $animal[0];
//print '.jpg"  class="animal"  alt="';
//print $animal[0];
//print '"/>';}
//include footer
include "footer.php";
?>