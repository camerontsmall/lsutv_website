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
                <div class="col s12 l8">
                    <!-- Slider Section -->
<div class="slider">
    <ul class="slides z-depth-1">
      <?php
      $api_url_f = $config['publicphp'] . '?action=plugin_vod&tag=featured&limit=7';
      $featured = json_decode(file_get_contents($api_url_f), true);
      
      foreach($featured as $result){
          ?>
      <li>
        <img src="<?= $result['poster'] ?>"> <!-- random image -->
        <div class="caption center-align">
            <a href="./video?play=<?= $result['id'] ?>">
                <h3 class="readable"><?= $result['title'] ?></h3>
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
                <div class="col s12 l4">
                    <div class="card-panel">
                        <?= $config['site_description'] ?>
                    </div>
                </div>
                </div>
            </div>
            
            <!-- Video List Section -->
            
            <!-- Live List -->
            
            <?php
            
            $api_url_l = $config['publicphp'] . '?action=plugin_videomanager&list';
            $channels = json_decode(file_get_contents($api_url_l),true);
            
            if(count($channels) > 0){
            ?>
            
            <div class="row">
                <div class="col s12">
                    <h4>Live Now</h4>
                </div>
            </div>
            
             <div class="row" id="search-results">
                <?php
                
                    foreach($channels as $index => $result){
                        /* TODO - THIS NEEDS TO BE ASYNCHRONOUS! */ 
                        $api_url_i = $config['publicphp'] . '?action=plugin_videomanager&id=' . $result['id'];
                        $channel = json_decode(file_get_contents($api_url_i),true);
                        ?>
                    <div class="col s12 m6 l3">
                        <div class="card small hoverable pointer">
                            <a href="./video?play=-<?= $result['id'] ?>">
                            <div class="card-image">
                                <div class="video-container" style="background-image:url('<?= $channel['poster'] ?>');"></div>
                            </div>
                            <div class="card-content">
                                <div class="search-result-title black-text"><?= $channel['title'] ?></div>
                            </div>
                            <!-- <div class="card-title"><?= $channel['title'] ?></div> -->
                            </a>
                        </div>
                    </div>
                    <?php
                    }
            }
                ?>
            </div>
            
            <!-- End Live List -->
            <!-- Recent List -->
            
            <?php
            $limit = 8;
            $api_url_r = $config['publicphp'] . "?action=plugin_vod&list&limit=$limit";
            $recent = json_decode(file_get_contents($api_url_r),true);
            
            if(count($channels) > 0){
            ?>
            
            <div class="row">
                <div class="col s12">
                        <h4>Recent videos</h4>
                </div>
            </div>
            
             <div class="row" id="search-results">
                <?php
                
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
            }
                ?>
            </div>
            
            <!-- End Recent List -->
            
        </main>
        
        <?php require("components/footer.php"); ?>
        
    </body>
</html>