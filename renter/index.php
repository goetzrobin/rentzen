<?php require_once '../common/configuration.php';?>
<?php require_once "../model/database.php"; ?>
<?php require_once "../model/property_db.php"; ?>
<?php
  $properties = getProperties();
  include 'renter_map.php'
?>
