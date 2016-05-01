<!doctype html>
<html>
    <head>
        <?php 
            $pagename = "search";
            $pagetitle = "LSUTV - Search";
            require_once("config.php");
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
       <main class="container" id="main-content">
            <div class="row">
               <div class="column s12">
                   <nav id="search-container" class="red lighten-1">
                   <form action="" method="GET">
                       <div class="input-field">
                        <input id="search-bar" name="term" type="search" required value="<?= $term ?>" placeholder="Search">
                        <label for="search"><i class="material-icons">search</i></label>
                   </form>
                   </nav>
               </div>
            </div>
               
            <div class="row" id="search-results">
                <?php
                
                if(strlen($term) > 0){
                    $api_url_s = $config['publicphp'] . '?action=plugin_vod&tag=' . $term;
                    $results = json_decode(file_get_contents($api_url_s),1);

                    foreach($results as $index => $result){
                        ?>
                    <div class="col s12 m6 l3">
                        <div class="card small hoverable pointer">
                            <a href="./video?play=<?= $result['id'] ?>">
                            <div class="card-image">
                                <div class="video-container" style="background-image:url('<?= $result['poster'] ?>');"></div>
                            </div>
                            <div class="card-content">
                                <div class="search-result-title black-text"><?= $result['title'] ?></div>
                            </div>
                            <!-- <div class="card-title"><?= $result['title'] ?></div> -->
                            </a>
                        </div>
                    </div>
                    <?php
                    }
                }

                ?>
            </div>
        </main>
        
        <?php require("components/footer.php"); ?>
           
    </body>
</html>