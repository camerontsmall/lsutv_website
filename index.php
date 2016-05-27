<!doctype html>
<html>
    <head>
       <?php 
            //Page path name
            $pagename = "index";
            //Include config page
            require_once("config.php");
            //Include header
            require("components/header.php"); 
        ?>
        
        <meta property="og:description" content="<?= htmlspecialchars($config['site_description']) ?>" />
        <meta property="og:image" content="<?= $config['filler_image'] ?>" />
        
        <link rel="stylesheet" href="css/style_home.css" />
    </head>
    <body>
        <!-- Navigation section -->
        <?php require("components/nav.php"); ?>
        
        <div id="nav-bg" class="z-depth-2"></div>
        
        <div class="slide-container">
                    <!-- Slider Section -->
<div class="slider fullscreen">
    <ul class="slides z-depth-1">
      <?php
      //API url for featured videos
      $api_url_f = $config['publicphp'] . '?action=plugin_vod&tag=featured&limit=7';
      //Get array of featured videos
      $featured = json_decode(file_get_contents($api_url_f), true);
      //Load featured videos into slider
      foreach($featured as $result){
          ?>
      <li>
        <img src="<?= $result['poster'] ?>"> <!-- random image -->
        <div class="caption center-align">
            <a href="./video?play=<?= $result['id'] ?>">
                <h3 class="readable"><?= $result['title'] ?></h3>
                <div class="btn waves-effect red white-text">WATCH NOW</div>
                <!-- <h5 class="light grey-text text-lighten-3">Here's our small slogan.</h5> -->
            </a>
        </div>
      </li>
      <?php
          
          
      }
      ?>
    </ul>
  </div>
<!--End Slider section -->
    </div>
        
        <!-- Content section -->
        <main class="container" id="main-content-home">
            
            <div class="row">
                <div class="col s12">
                    <!-- Short site description panel -->
                    <h4><?= $config['site_welcome'] ?></h4>
                    <p><?= $config['site_description'] ?></p>
                </div>
                </div>
            </div>
            <!-- Video List Section -->
            
            <!-- Live List -->
            
            <?php
            //API url for finding active channels
            //TODO - move to client side
            $api_url_l = $config['publicphp'] . '?action=plugin_videomanager&list';
            //Get array of active channels
            $channels = json_decode(file_get_contents($api_url_l),true);
            
            if(count($channels) > 0){
            ?>
            
            <div class="row">
                <div class="col s12">
                    <h4>Live Now</h4>
                </div>
            </div>
            
             <div class="row" id="live-channels">
                 <div id="channel_pane_1" class="col s12 m6 l3 channel-pane" style="display:none"></div>
                 <div id="channel_pane_2" class="col s12 m6 l3 channel-pane" style="display:none"></div>
                 <div id="channel_pane_3" class="col s12 m6 l3 channel-pane" style="display:none"></div>
            </div>
                <?php
            }
                ?>
            
            <!-- End Live List -->
            <!-- Recent List -->
            
            <?php
            //Limit of recent videos to pull
            $limit = 8;
            //API url for recent videos
            $api_url_r = $config['publicphp'] . "?action=plugin_vod&list&limit=$limit";
            //Get array of recent videos
            $recent = json_decode(file_get_contents($api_url_r),true);

            ?>
            
            <div class="row">
                <div class="col s12">
                        <h4>Recent videos</h4>
                </div>
            </div>
            
             <div class="row" id="search-results">
                <?php
                    //Print each video cell
                    foreach($recent as $index => $result){
                       
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
            
            <!-- End Recent List -->
            
        </main>
        
        <script>
            //Run JS to display channel panes
            updateChannelPanes();
            var channel_timer = setInterval(function(){ updateChannelPanes(); }, 10000);
        </script>
        
        <?php require("components/footer.php"); ?>
        
    </body>
</html>