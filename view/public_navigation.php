<script src='<?php echo $base_path;?>/view/js/public_navigation.js'></script>
<nav class="navbar navbar-expand-md navbar-light bg-light">
      <a class="navbar-brand nav_logo" href="<?php echo $base_path . '/index.php'; ?>"><img alt="RentZen Logo" src="<?php echo $base_path; ?>/images/rentzen_logo.svg"></a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample04" aria-controls="navbarsExample04" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
<div class="collapse navbar-collapse justify-content-end" id="navbarsExample04">
        <ul class="navbar-nav">
          <li class="nav-item active">
            <a onclick="scrollToSection('home')" class="nav-link" href="#">Home</a>
          </li>
          <li class="nav-item">
            <a onclick="scrollToSection('philosophy')" class="nav-link" href="#">Philosophy</a>
          </li>
          <li class="nav-item">
            <a onclick="scrollToSection('app')" class="nav-link" href="#">App</a>
          </li>
          <li class="nav-item">
            <a onclick="scrollToSection('pricing')" class="nav-link" href="#">Pricing</a>
          </li>
          <li class="nav-item">
            <a onclick="scrollToSection('about')" class="nav-link" href="#">About</a>
          </li>
          <li class="nav-item">
          <?php
          if( isset($_SESSION['LOGGED_IN']) && $_SESSION['LOGGED_IN']=='OK') {
            echo '<a class="icon" href="'. $base_path . '/public/index.php?sign_out"><i class="fas fa-sign-in-alt"></i></a>';
          } else {
            echo '<a class="icon" href="'. $base_path . '/public/index.php?sign_in"><i class="fas fa-sign-in-alt"></i></a>';
          } ?>
             </li>
        </ul>
      </div>
    </nav>