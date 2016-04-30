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
        <div class="container" id="main-content">
            
            <!-- Player & playlist -->
            <div class="row">
                <div class="col s12 l6">
                    <div id="player-info" class="card">
                        <div class="card-image">
                            <img src="<?= $show['poster_url'] ?>" />
                        </div>
                        <div id="player-important" class="card-content">
                            <div id="player-title" class="card-title"><?= $show['title'] ?></div>
                            <p><?= $show['description'] ?></p>
                        </div>
                       </div>
                </div>
                <div class="col s12 l4">
                    <div id="player-playlist">
                        <?php
                        foreach($show['episodes'] as $episode){
                         
                            ?>
                         <div class="card-panel hoverable grey lighten-5 z-depth-1 playlist-item"
                              onclick="window.location.href='./video?play=<?= $episode['id'] ?>';">
                            <div class="row valign-wrapper">
                              <div class="col s2">
                                <img src="<?= $episode['poster'] ?>" alt="" class="responsive-img" />
                              </div>
                              <div class="col s10">
                                <span class="black-text card-title">
                                  <?= $episode['title'] ?>
                                </span>
                              </div>
                            </div>
                        </div>
                        <?php
                            
                            
                        }
                        ?>
                       
                        
                        
                    </div>
                </div>
               
            </div>

        </div>
        
        <?php require("components/footer.php"); ?>
        
    </body>
</html>