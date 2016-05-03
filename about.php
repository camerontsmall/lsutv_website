<!doctype html>
<html>
    <head>
       <?php 
            $pagename = "index";
            require_once("config.php");
            $pagetitle = "LSUTV - About";
            require("components/header.php"); 
        ?>
    </head>
    <body>
        <!-- Navigation section -->
        <?php require("components/nav.php"); ?>
        
        <!-- Content section -->
        <main class="container" id="main-content">
            <h4>About LSUTV</h4>
        </main>
        
        <?php require("components/footer.php"); ?>
        
    </body>
</html>