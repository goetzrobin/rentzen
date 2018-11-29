<nav class="navbar navbar-expand navbar-light bg-light justify-content-between">
      <a class="navbar-brand nav_logo" href="<?php echo $base_path . '/index.php'; ?>"><img alt="RentZen Logo" src="<?php echo $base_path; ?>/images/rentzen_logo.svg"></a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample04" aria-controls="navbarsExample04" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
<div class=" navbar-expand justify-content-end" id="navbarsExample04">
        <ul class="navbar-nav">
          <li class="nav-item active">
            <a class="nav-link icon" href="<?php echo $base_path; ?>/renter/index.php"><i class="fas fa-home"></i></a>
          </li>
          <li class="nav-item">
            <a class="nav-link icon" href="<?php echo $base_path; ?>/renter/index.php?profile"><i class="fas fa-user-circle"></i></a>
          </li>
          <li class="nav-item">
          <?php
          if( isset($_SESSION['LOGGED_IN']) && $_SESSION['LOGGED_IN']=='OK') {
            echo '<a class="icon" href="'. $base_path . '/public/index.php?sign_out"><i class="fas fa-power-off"></i></a>';
          } else {
            echo '<a class="icon" href="'. $base_path . '/public/index.php?sign_in"><i class="fas fa-power-off"></i></a>';
          } ?>
          </li>
        </ul>
      </div>
    </nav>