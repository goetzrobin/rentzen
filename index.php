<?php include 'common/configuration.php'?>
<?php 
    session_start();
    if( isset($_SESSION['LOGGED_IN']) && $_SESSION['LOGGED_IN']=='OK' && $_SESSION['ROLE_ID'] == ROLE_ID_RENTER ){
        header("Location: ".$base_path."/renter");
    } 
    else if( isset($_SESSION['LOGGED_IN']) && $_SESSION['LOGGED_IN']=='OK' && $_SESSION['ROLE_ID'] == ROLE_ID_LANDLORD ){
        header("Location: ".$base_path."/landlord");
    } else {
        header("Location: ".$base_path."/public");
    }
?>
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