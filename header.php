<!-- %%%%%%%%%%%%%%%%%%%%%%     Page header   %%%%%%%%%%%%%%%%%%%%%%%%%%%%%% -->
<header>
    <h1>Animal Sound Quiz</h1>
        <nav>
    <ol>
        <?php
        // This sets the current page to not be a link. Repeat this if block for
        //  each menu item 
        if (basename($_SERVER['PHP_SELF']) == "index.php") {
            print '<li class="activePage">Welcome</li>';
        } else {
            print '<li><a href="index.php">Welcome</a></li>';
        }  
        if (basename($_SERVER['PHP_SELF']) == "er.php") {
            print '<li class="activePage">ER Diagram</li>';
        } else {
            print '<li><a href="er.php">ER Diagram</a></li>';
        }
        ?>
    </ol>
</nav>
</header>
<!-- %%%%%%%%%%%%%%%%%%%%% Ends Page header   %%%%%%%%%%%%%%%%%%%%%%%%%%%%%% -->