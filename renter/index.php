<?php require_once '../common/configuration.php';?>
<?php require_once "../model/database.php"; ?>
<?php require_once "../model/property_db.php"; ?>
<?php require_once "../model/people_db.php"; ?>
<?php
  if(isset($_GET['profile'])){
    session_start();
    $profile_data = getPeopleById($_SESSION['PEOPLE_ID']);
    include 'renter_profile.php';
    exit;
  }
  $properties = getProperties();
  include 'renter_map.php'
?>
