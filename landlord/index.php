<?php require_once '../common/configuration.php';?>
<?php require_once "../model/database.php"; ?>
<?php require_once "../model/property_db.php";?>
<?php
    session_start();
    if( (int) $_SESSION['ROLE_ID'] !== ROLE_ID_LANDLORD) {
        header("Location: ".$base_path."/public");
    }
    $properties = getPropertiesByLandlordId($_SESSION['PEOPLE_ID']);
    include 'landlord_dashboard.php';
?>
