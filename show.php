<!doctype html>
<html>
    <head>
        <?php 
            $pagename = "show";
            $pagetitle = "LSUTV - Show";
            require_once("config.php");
            require("components/header.php"); 
        ?>
    </head>
    <body>
        <!-- Navigation section -->
        <?php require("components/nav.php"); ?>
        
        <?php
        $show_id = $_GET['id'];
        $api_url = $config['publicphp'] . '?action=shows&r=show&id=' . $show_id;
        $show = json_decode(file_get_contents($api_url),true);
        
        $current_episode = $show['episodes'][0];
        ?>
        
         <!-- Content section -->
        <main class="container" id="main-content">
            
            <!-- Player & playlist -->
            <div class="row">
                
                <div class="col s12 l4">
                    
                    <div id="show-description" class="card">
                        <div class="card-image">
                            <img src="<?= $show['poster_url'] ?>" />
                        </div>
                        <div class="card-content">
                            <div id="player-title" class="card-title"><?= $show['title'] ?></div>
                            <p><?= $show['description'] ?></p>
                        </div>
                    </div>
                </div>
                
                <?php
                if($current_episode){
                    ?>
                <div class="col s12 l8">
                    <div class="video-container z-depth-1">
                        <iframe src="<?= $config['publicphp'] . '?action=plugin_vod&iframe=' . $current_episode['id'] ?>">
                        Your browser doesn't support iframes. We feel very sorry for you.
                        </iframe>
                </div>
                    <?php
                }
                ?>
               
            </div>
            <?php if(count($show['episodes']) > 0){ ?>
            <div class="row">
                <div class="col"><h4>Episodes</h4></div>
            </div>
            <?php } ?>
            <div class="row">
                <div class="col s12">
                    <?php
                    foreach($show['episodes'] as $result){
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

                    ?>
                </div>
            </div>
        </main>
        
        <?php require("components/footer.php"); ?>
        
    </body>
</html>