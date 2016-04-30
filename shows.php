<!doctype html>
<html>
    <head>
        <?php 
            $pagename = "shows";
            $pagetitle = "LSUTV - Shows";
            require("components/header.php"); 
        ?>
    </head>
    <body>
        <!-- Navigation section -->
        <?php require("components/nav.php"); ?>
        
        <?php
        $term = $_GET['term'];
        ?>
        
        <!-- Content section -->
       <div class="container" id="main-content">
           <h4>Shows</h4>
        </div>
        
        <script>
            $(document).ready(function(){
                $(".dropdown-button").dropdown();
            });
        </script>
    </body>
</html>