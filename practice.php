<?php
//include top
include "top.php";

//query to select distinct animal names from tblAnimals
$distinctAnimalQuery = 'SELECT DISTINCT pmkAnimalName FROM tblAnimals';
$animals = $thisDatabaseReader->select($distinctAnimalQuery, "", 0);
foreach($animals as $animal){
    print '<fieldset class = "reviewquestions">';
print '<div class = "imagetext">';
print '<label>';
//display photo
print '<img src="photos/' . $animal[0] . '.jpg" class = "animal">';
//this text will display the animal name under its photo
print '<fieldset class = "questionsFieldsets">';
print '<span class = "textunder" id = "' . $animal[0] . 'label"><strong>' . $animal[0] . '</strong></span>';
print '</fieldset>';
print '</label>';
print '</div>';
//inform user how to hear sound
print '<p class = "moderate">Click the play button to hear the sound </p>';
//display the sound for the correct animal
print '<audio controls>';
print'<source src="sounds/';
print $animal[0];
print '.mp3" type="audio/mpeg">';
print'Your browser does not support the audio element.';
print '</audio>';
print '</fieldset>';
}

//include footer
include "footer.php";
?>