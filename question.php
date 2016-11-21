<?php
//initialize database connection
include "top.php";
//include navigation page
include "nav.php";
//select a certain number of animals
$getAnimalsQuery = "SELECT pmkAnimalName FROM tblAnimals";
$animals = $thisDatabaseReader->select($getAnimalsQuery,"",0);
//for each animal display their photo and sound
foreach($animals as $animal){
print '<audio controls>';
print'<source src="sounds/';
print $animal[0];
print '.mp3" type="audio/mpeg">';
print'Your browser does not support the audio element.';
print '</audio>';
print '<img src="photos/';
print $animal[0];
print '.jpg"  class="animal"  alt="';
print $animal[0];
print '"/>';}
//include footer
include "footer.php";
?>