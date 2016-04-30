<!-- Dropdown for More button -->
        <ul id="more-dropdown" class="dropdown-content">
          <li><a href="#!">About</a></li>
          <li><a href="#!">Contact</a></li>
          <li><a href="//media.lsu.co.uk">LSU Media</a></li>
        </ul>
        <!-- Dropdown for Shows button -->
        <ul id="cosec-dropdown" class="dropdown-content">
            <li><a href="./search?term=features">Features</a></li>
          <li><a href="./search?term=news">News</a></li>
          <li><a href="./search?term=music">Music</a></li>
          <li><a href="./search?term=sport">Sport</a></li>
        </ul>
        <nav>
            <!-- Desktop nav bar -->
            <div class="nav-wrapper fixed" id="main-nav">
               <div class="container">
                    <a href="." class="brand-logo">
                        <img src="res/lsutv_white.png" alt="LSUTV Logo" id="tv-logo"  />
                    </a>
                    <ul class="right hide-on-med-and-down">
                        <?php if($pagename != "search"){  ?>
                        <li><a href="./search"><i class="material-icons left">search</i>Search</a></li>   
                        <?php } ?>
                        <!-- <li><a href="#!">Live</a></li> -->
                        <li><a class="dropdown-button" href='#!' data-activates="cosec-dropdown">Categories</a></li>
                        <li><a href='#!'>Shows</a></li>
                        <!-- Dropdown Trigger -->
                        <li><a class="dropdown-button" href="#!" data-activates="more-dropdown">More<i class="material-icons right">arrow_drop_down</i></a></li>
                    </ul>
                   </div>
            </div>
            
        </nav>