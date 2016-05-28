<?php
if(!isset($_GET['id'])){
    header('location:./shows');
}
?>
<!doctype html>
<html>
    <head>
        <?php 
            $pagename = "show";
            
            
            
            
            require_once("config.php");
            
             $show_id = $_GET['id'];
            $api_url = $config['publicphp'] . '?action=shows&r=show&id=' . $show_id;
            $show = json_decode(file_get_contents($api_url),true);
            $pagetitle = "LSUTV - " . $show['title'];
            
            require("components/header.php"); 
        ?>
        
        <meta property="og:description" content="<?= htmlspecialchars($show['description']) ?>" />
        <meta property="og:image" content="<?= $show['poster_url'] ?>" />
    </head>
    <body>
        <!--
        <style>
            body{
                background-color:<?= $show['theme_colour'] ?>;
                background-size:cover;
                background-position:center;
            }
        </style>
        -->
        <!-- Navigation section -->
        <?php require("components/nav.php"); ?>
        
        <div id="show-cover" class="parallax-container">
            <div class="section no-pad bot" id="show-title">
                <div class="container">
                    <h3><?= $show['title'] ?></h3>
                </div>
            </div>
            <div class="parallax">
                <img src="<?= $show['poster_url'] ?>">
            </div>
        </div>
        
         <!-- Content section -->
        <main class="container" id="main-content">
        
        <?php
       
        
        $current_episode = $show['episodes'][0];
        ?>
        
        
            
            <!-- Player & playlist -->
            <div class="row">
                
                
                
                <?php
                if($current_episode){
                    ?>
                <div class="col s12 l8 hide-on-med-and-down">
                    <div class="video-container z-depth-1">
                        <img src="<?= $current_episode['poster'] ?>" width="100%"/>
                    </div>
                </div>
                    <?php
                }else{
                    ?>
                <div class="col s12 l8 hide-on-med-and-down">
                    <div class="video-container z-depth-1">
                        <img src="<?= $show['poster_url'] ?>" width="100%"/>
                    </div>
                </div>
                <?php
                }
                ?>
               
                <div class="col s12 l4">
                    
                    <div id="show-description" class="card z-depth-0">
                        <!-- <div class="card-image">
                            <img src="<?= $show['poster_url'] ?>" />
                        </div> -->
                        <div class="card-content">
                            <!-- <div id="player-title" class="card-title"><?= $show['title'] ?></div> -->
                            <p><?= $show['description'] ?></p>
                        </div>
                    </div>
                </div>
                
            </div>
            <?php if(count($show['episodes']) > 0){ ?>
            <div class="row">
                <div class="col"><h4>Episodes</h4></div>
            </div>
            <?php } ?>
            <div class="row">
                <div class="col s12">
                    <?php
                    $api_url_e = $config['publicphp'] . '?action=plugin_vod&tag=' . $show['tag'];
                    $episodes = json_decode(file_get_contents($api_url_e),true);
                    foreach($episodes as $result){
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