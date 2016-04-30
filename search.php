<!doctype html>
<html>
    <head>
        <?php 
            $pagetitle = "search";
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
           <div class="row">
               <div class="column s12">
                   <nav id="search-container" class="red lighten-1">
                   <form>
                       <div class="input-field">
                        <input id="search-bar" type="search" required value="<?= $term ?>">
                        <label for="search"><i class="material-icons">search</i></label>
                   </form>
                   </nav>
               </div>
           </div>
            
        </div>
        
        <script>
            $(document).ready(function(){
                $(".dropdown-button").dropdown();
            });
        </script>
    </body>
</html>