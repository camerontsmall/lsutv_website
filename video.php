<!doctype html>
<html>
    <head>
       <?php 
            $pagename = "index";
            require_once("config.php");
            
            if(isset($_GET['play'])){
                $play = intval($_GET['play']);
            }else{
                $play = -$config['featured_channel'];
            }
            
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
            
            $tags = explode(' ', $content['tags']);
            
            $playing = $play;
            
            $relatedtag = strtolower(end($tags));
            
            $pagetitle = "LSUTV - " . $content['title'];
            
            require("components/header.php"); 
        ?>
    </head>
    <body>
        <!-- Navigation section -->
        <?php require("components/nav.php"); ?>
        
        <!-- Content section -->
       <main class="container" id="main-content">
            
            <!-- Player & playlist -->
            <div class="row">
                <div class="col s12 l8">
                    <div id="player-container" class="z-depth-1 player-container">
                        <iframe class="player-inner" allowfullscreen src="<?= $iframe_url ?>"></iframe>
                    </div>
                    <div id="player-info" class="card">
                        <div id="player-important" class="card-content">
                            <div id="player-title" class="card-title activator"><?= $content['title'] ?></div>
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
                <div class="col s12 l4">
                    <div id="player-playlist">
                        
                    <?php
                    
                    $api_url_c = $config['publicphp'] . '?action=plugin_videomanager&list';
                    $channels = json_decode(file_get_contents($api_url_c),true);
                    
                    $printedLT = false;
                    
                    foreach($channels as $video){
                        if($video['type'] == "live"){
                            if(!$printedLT){
                                echo "<h5>Live Now</h5>";
                                $printedLT = true;
                            }
                        ?>
                        <div class="card-panel hoverable red lighten-1 white-text z-depth-1 playlist-item" 
                             onclick="window.location.href='./video?play=-<?= $video['id'] ?>';">
                               <div class="row valign-wrapper">
                                 <div class="col s2">
                                   <img src="<?= $video['thumbnail'] ?>" alt="" class="responsive-img" />
                                 </div>
                                 <div class="col s10">
                                   <span class=card-title"><?= $video['title']?></span>
                                 </div>
                               </div>
                           </div>
                    <?php
                        }
                    }
                    
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
                        <div class="card-panel hoverable grey lighten-5 z-depth-1 playlist-item" >
                            <a href="./video?play=<?= $result['id'] ?>">
                            <div class="row valign-wrapper">
                                <div class="col s3">
                                <img src="<?= $result['poster'] ?>" alt="" class="responsive-img left" />
                                </div>
                                <div class="col s9">
                                <span class="black-text card-title">
                                  <?= $result['title'] ?>
                                </span>
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
        </script>
        <?php } ?>
    </body>
</html>