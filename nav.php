<!-- ######################     Main Navigation   ########################## -->
<nav>
    <ol>
        <?php
        // This sets the current page to not be a link. Repeat this if block for
        //  each menu item 
        if ($PATH_PARTS['filename'] == "index") {
            print '<li class="activePage"><a href="index.php">Index</a></li>';
        } else {
            print '<li><a href="index.php">Index</a></li>';
        }     
        if ($PATH_PARTS['filename'] == "er") {
            print '<li class="activePage"><a href="er.php">ER Diagram</a></li>';
        } else {
            print '<li><a href="er.php">ER Diagram</a></li>';
        }
        if ($PATH_PARTS['filename'] == "question") {
            print '<li class="activePage"><a href="question.php">Quiz</a></li>';
        } else {
            print '<li><a href="question.php">Question</a></li>';
        }
        ?>
    </ol>
</nav>
<!-- #################### Ends Main Navigation    ########################## -->

