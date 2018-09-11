<?php include 'common/configuration.php'?>
<?php include 'view/header.php'?>
   <div class='container '>
       <div class='row d-flex justify-content-center'>
           <img class='index__logo' src='<?php echo $base_path;?>/images/rentzen_logo.svg'>
       </div>
       <div class='row d-flex justify-content-center'>
       Development Mode
       </div>
       <div class='row d-flex justify-content-center'>
        <a href='<?php  echo $base_path;?>/model/model_test.php'>Click here to test the model functions</a>
        <a href='<?php  echo $base_path;?>/public/index.php'>Public One Page</a>
       </div>
   </div>
<?php include 'view/footer.php'?>