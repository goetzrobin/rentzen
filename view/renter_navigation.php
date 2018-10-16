<nav class="navbar navbar-expand-md navbar-light bg-light">
      <a class="navbar-brand nav_logo" href="<?php echo $base_path . '/index.php'; ?>"><img alt="RentZen Logo" src="<?php echo $base_path; ?>/images/rentzen_logo.svg"></a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample04" aria-controls="navbarsExample04" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
<div class="collapse navbar-collapse justify-content-end" id="navbarsExample04">
        <ul class="navbar-nav">
          <li class="nav-item active">
            <a class="nav-link" href="#">Properties<span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Viewings</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Applications</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Profile</a>
          </li>
          <li class="nav-item">
          <?php
          if( isset($_SESSION['LOGGED_IN']) && $_SESSION['LOGGED_IN']=='OK') {
            echo '<a href="'. $base_path . '/public/index.php?sign_out"><button class="btn btn-outline-primary red">Sign Out</button></a>';
          } else {
            echo '<a href="'. $base_path . '/public/index.php?sign_in"><button class="btn btn-outline-primary red">Sign In</button></a>';
          } ?>
          </li>
        </ul>
      </div>
    </nav>