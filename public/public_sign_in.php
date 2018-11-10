<?php include '../common/configuration.php' ?>
<?php include '../view/header.php' ?>

<link href="./css/public_sign_in.css" rel="stylesheet">

 <div class="overlay">
  <div class="test text-center">
    <form class="form-signin" action="<?php echo $base_path; ?>/public/index.php" method="post">
    <a href='<?php echo $base_path; ?>/public/index.php'><img class="mb-4" src="<?php echo $base_path; ?>/images/rentzen_logo.svg" alt="RentZen Logo" width="72" height="72"></a>
       <h1 class="h3 mb-3 font-weight-normal">Please sign in</h1>
       <?php if (!empty($message)) {
        echo '<div class="error form-control"><small>' . $message . '</small></div>';
      } ?>
      <label for="inputEmail" class="sr-only">Email address</label>
      <input name='email' type="email" id="inputEmail" class="form-control" placeholder="Email address" required autofocus>
      <label for="inputPassword" class="sr-only">Password</label>
      <input name='password' type="password" id="inputPassword" class="form-control" placeholder="Password" required>
      <button class="btn btn-lg btn-block red" type="submit" value='Go' name="go_button">Sign in</button>
      <p class="mt-1 mb-3 text-muted"><small><a href='<?php echo $base_path; ?>/public/index.php?sign_up'>No Account? Register here</a></small></p>
      <p class="mt-5 mb-3 text-muted">
        <a class='back' href='<?php echo $base_path; ?>/public/index.php'>Home</a>
        <br>
        &copy; 2017-2018
    </p>
    </form>
    </div>
  </div>

<?php include '../view/footer.php'; ?>