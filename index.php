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
                <div class="col s12">
                    <div class="card-panel red white-text">
                        <p>This site does not use cookies! Please find your confectionary elsewhere.</p>
                    </div>
                </div>
            </div>
        </main>
        
        <?php require("components/footer.php"); ?>
        
    </body>
</html>