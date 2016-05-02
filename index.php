<!doctype html>
<html>
    <head>
       <?php 
            $pagename = "index";
            require_once("config.php");
            
            require("components/header.php"); 
        ?>
    </head>
    <body>
        <!-- Navigation section -->
        <?php require("components/nav.php"); ?>
        
        <!-- Content section -->
        <main class="container" id="main-content">
            <div class="row">
                <div class="col s12 l7">
                    <div class="video-container">
                        <div class="responsive-video" style="background-color:black; height:500px;"></div>
                    </div>
                </div>
            </div>
        </main>
        
        <?php require("components/footer.php"); ?>
        
    </body>
</html>