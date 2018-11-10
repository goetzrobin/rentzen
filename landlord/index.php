<?php require_once '../common/configuration.php';?>
<?php require_once "../model/database.php"; ?>
<?php require_once "../model/property_db.php";?>
<?php require_once "../model/rental_app_db.php";?>
<?php
    session_start();
    if( (int) $_SESSION['ROLE_ID'] !== ROLE_ID_LANDLORD) {
        header("Location: ".$base_path."/public");
    }
    $user_id = $_SESSION['PEOPLE_ID'];
    $properties = getPropertiesByLandlordId($user_id);
    $listed_properties = getListedPropertiesByLandlordId($user_id);
    $vacant_properties = getVacantPropertiesByLandlordId($user_id);
    $occupied_properties = getOccupiedPropertiesByLandlordId($user_id);
    $applications = getRentalAppsByLandlordId($user_id);
    $submitted_applications = getSubmittedRentalAppsByLandlordId($user_id);
    $rejected_applications = getRejectedRentalAppsByLandlordId($user_id);
    $approved_applications = getApprovedRentalAppsByLandlordId($user_id);
    include 'landlord_dashboard.php';
?>
