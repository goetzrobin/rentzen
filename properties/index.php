<?php require_once '../common/configuration.php';?>
<?php require_once "../model/database.php"; ?>
<?php require_once "../model/property_db.php"; ?>
<?php require_once "../model/people_db.php"; ?>
<?php require_once "../model/feature_db.php"; ?>
<?php
$property_id = $_GET['id'];
  if(isset($property_id)){
    session_start();
    $property = getPropertyById($property_id);
    $features = getFeaturesByPropertyId($property_id);
    include 'property_view.php';
    exit;
  }
  header("Location: " . $base_path);
?>
