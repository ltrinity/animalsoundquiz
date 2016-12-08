<!-- %%%%%%%%%%%%%%%%%%%%%%     Page header   %%%%%%%%%%%%%%%%%%%%%%%%%%%%%% -->
<header>
    <h1>Animal Sound Quiz</h1>
        <nav>
    <ol>
        <?php
        // This sets the current page to not be a link. Repeat this if block for
        //  each menu item 
        if (basename($_SERVER['PHP_SELF']) == "sitemap.php") {
            print '<li class="activePage">Sitemap</li>';
        } else {
            print '<li><a href="sitemap.php">Sitemap</a></li>';
        }  
        if (basename($_SERVER['PHP_SELF']) == "login.php") {
            print '<li class="activePage">Login</li>';
        } else {
            print '<li><a href="login.php">Login</a></li>';
        }
        if (basename($_SERVER['PHP_SELF']) == "practice.php") {
            print '<li class="activePage">Practice</li>';
        } else {
            print '<li><a href="practice.php">Practice</a></li>';
        }
        ?>
    </ol>
</nav>
</header>
<!-- %%%%%%%%%%%%%%%%%%%%% Ends Page header   %%%%%%%%%%%%%%%%%%%%%%%%%%%%%% -->