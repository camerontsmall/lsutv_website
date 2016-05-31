<?php
 if(isset($_GET['play'])){
                $play = intval($_GET['play']);
}else{
    header('location:error.php');
}

$pagename = "index";
require_once("config.php");

if($play > 0){
    //Play video
    $api_url = $config['publicphp'] . '?action=plugin_vod&id=' . $play;
    $iframe_url = $config['publicphp'] . '?action=plugin_vod&iframe=' . $play . '&autoplay=1';
    $is_vod = true;
}else{
    //Play channel
    $api_url = $config['publicphp'] . '?action=plugin_videomanager&id=' . abs($play);
    $iframe_url = $config['publicphp'] . '?action=plugin_videomanager&iframe=' . abs($play)  . '&autoplay=1';
    $is_live = true;
}

$content = json_decode(file_get_contents($api_url),true);

if($content == null){
    header('location:error.php');
}

$tags = explode(' ', $content['tags']);

$playing = $play;

$relatedtag = strtolower(end($tags));

$pagetitle = "LSUTV - " . $content['title'];

?>
<!doctype html>
<html>
    <head>        
        <?php require_once("components/header.php"); ?>
        
        <meta property="og:type" content="video.tv_show" />
        <meta property="video:release_date" content="<?= $content['date'] ?>" />
        
        <meta property="og:description" content="<?= htmlspecialchars($content['description']) ?>" />
        <meta property="og:image" content="<?= ($content['poster'])? $content['poster'] : $content['poster_url'] ?>" />
        <meta property="og:video" />
        <meta property="og:video:type" content="application/x-shockwave-flash" />
        <meta property="og:video:url" content="<?= $iframe_url ?>" />
        <meta property="og:video:secure_url" content="<?= $iframe_url ?>" />
        
        
    </head>
    <body>
        <!-- Navigation section -->
        <?php require("components/nav.php"); ?>
        
        <!-- Content section -->
       <main class="container" id="main-content">
            
            <!-- Player & playlist -->
            <div class="row">
                <div class="col s12 l8">
                    <div id="player-container" class="z-depth-1 player-container <?= $content['type'] ?>-container">
                        <iframe class="player-inner <?= $content['type'] ?>" allowfullscreen src="<?= $iframe_url ?>"></iframe>
                    </div>
                    <div id="player-info" class="card z-depth-1">
                        <div id="player-important" class="card-content">
                            <div id="player-channel-title"><?= $content['channel_name'] ?></div>
                            <div id="player-title" class="card-title"><?= $content['title'] ?></div>
                            <div id="player-subtitle" class="italic truncate"><?= $content['nowplaying'] ?></div>
                            <?php
                            if($is_vod){
                                ?>
                            <p id="player-date" class="">Posted on <?= $content['date'] ?></p>
                                <?php
                            }
                            ?>
                            <div id="player-tags">
                                <?php
                                foreach($tags as $tag){
                                    if(strlen($tag) > 0){
                                        ?>
                                <div class="chip"><a href="./search?term=<?= strtolower($tag) ?>"><?= strtolower($tag) ?></a></div>
                                    <?php
                                    }
                                }
                                ?>
                            </div>
                            
                            <div id="player-description"><?= $content['description'] ?></div>
                        </div>
                       </div>
                </div>
                
                <!-- Related/live videos section -->
                <div class="col s12 l4">
                    <?php
                        $api_url_c = $config['publicphp'] . '?action=plugin_videomanager&list';
                        $channels = json_decode(file_get_contents($api_url_c),true);
                    ?>
                    <div id="player-playlist">
                        <?php if($channels){ ?><h5 id="live-indicator">Live Now</h5><?php } ?>
                        <div id="channel-list">
                            
                        </div>
                    <?php
                    
                    $related = json_decode(file_get_contents($config['publicphp'] . '?action=plugin_vod&limit=7&tag=' . $relatedtag),true);
                    
                    if(count($related) > 1 && strlen($relatedtag) > 0){
                        $rtitle = "Related videos";
                    }else{
                        $related = json_decode(file_get_contents($config['publicphp'] . '?action=plugin_vod&limit=7&list'),true);
                        $rtitle = "Recent videos";
                    }
                    
                    ?>
                         <h5><?= $rtitle ?></h5>
                       
                        <?php
                        $counter = 0;
                        foreach($related as $result){
                            if($counter < 6 && $result['id'] != $playing){
                        ?>
                        <div class="hoverable z-depth-0 playlist-item" >
                            <a href="./video?play=<?= $result['id'] ?>">
                            <div class="row">
                                <div class="col s4 responsive-video">
                                    <img src="<?= $result['poster'] ?>" alt="" class="responsive-img left z-depth-1" />
                                </div>
                                <div class="col s8">
                                    <span class="black-text card-title">
                                      <?= $result['title'] ?>
                                    </span>
                                    <span class="grey-text truncate"><?= $result['date'] ?></span>
                                </div>
                              
                            </div>
                            </a>
                        </div>
                        <?php 
                            $counter++;
                            }
                            
                        } 
                        ?>
                        
                    </div>
                </div>
               
            </div>

        </main>
        
        <?php require("components/footer.php"); ?>
        
        <?php if(true){ ?>
        <script>
            var json_url = "<?= $api_url ?>";
            updateVideoInformation(json_url);
            var infotimer = setInterval(function(){ updateVideoInformation(json_url); }, 10000);
            
            //Run JS to display channel panes
            updateChannelList();
            var channel_timer = setInterval(function(){ updateChannelList(); }, 10000);
            
        </script>
        <?php } ?>
    </body>
</html>