<!doctype html>
<html>
    <head>
       <?php 
            $pagetitle = "index";
            require("components/header.php"); 
        ?>
    </head>
    <body>
        <!-- Navigation section -->
        <?php require("components/nav.php"); ?>
        
        <!-- Content section -->
       <div class="container" id="main-content">
            
            <!-- Player & playlist -->
            <div class="row">
                <div class="col s12 l8">
                    <div id="player-container" class="video-container  z-depth-1">
                        <iframe src="http://smalldisasters.co.uk/live/admin/public.php?action=plugin_videomanager&iframe=11"></iframe>
                    </div>
                    <div id="player-info" class="card">
                        <div id="player-important" class="card-content">
                            <div id="player-title" class="card-title activator">Bubble Debate Live<i class="material-icons right">more_vert</i></div>
                            <div id="player-tags">
                                <div class="chip">Live</div>
                                <div class="chip">EE2016</div>
                            </div>
                        </div>
                        <div class="card-reveal">
                            <span class="card-title grey-text text-darken-4">Card Title<i class="material-icons right">close</i></span>
                            <p>Here is some more information about this product that is only revealed once clicked on.</p>
                        </div>
                       </div>
                </div>
                <div class="col s12 l4">
                    <div id="player-playlist">
                        <div class="card-panel hoverable red lighten-1 white-text z-depth-1 playlist-item">
                            <div class="row valign-wrapper">
                              <div class="col s2">
                                <img src="res/lsutv_white.png" alt="" class="responsive-img" />
                              </div>
                              <div class="col s10">
                                <span class=card-title">Bubble Debate</span>
                              </div>
                            </div>
                        </div>
                        <div class="card-panel hoverable grey lighten-5 z-depth-1 playlist-item">
                            <div class="row valign-wrapper">
                              <div class="col s2">
                                <img src="res/lsutv_master.png" alt="" class="responsive-img" />
                              </div>
                              <div class="col s10">
                                <span class="black-text card-title">
                                  Totty TV Episode 23
                                </span>
                              </div>
                            </div>
                        </div>
                        
                    </div>
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