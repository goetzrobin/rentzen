<?php require_once '../common/configuration.php';?>
<?php require_once "../model/database.php"; ?>
<?php require_once "../model/renter_property_db.php"; ?>
<?php require_once "../model/rental_app_db.php"; ?>
<?php
    session_start();

    if ($_GET['type'] === 'get_renter_prop') {

        if(isset($_GET['renter_id']) && isset($_GET['property_id']) ){
            echo json_encode(getPropertyRelationshipByRenterIdByPropertyID($_GET['renter_id'],$_GET['property_id']));
        }

    }

    if ($_GET['type'] === 'get_session_data') {
        echo json_encode($_SESSION);
    }

    if( $_GET['type'] === 'post_app_form' && !empty($_POST)){

        //ENTER VALIDATION HERE

        $renterpoperty_data =  getPropertyRelationshipByRenterIdByPropertyID($_POST["app_renter_id"], $_POST["app_prop_id"]);
        $inserted_id = insertRentalApp(
            $renterpoperty_data['renterproperty_id'], 
            $_POST["app_status"],
            $_POST["app_move_in_date"], 
            $_POST["app_move_out_date"], 
            $_POST["app_message"] 
            );
    
        if($inserted_id){
            echo 'Application submitted! Come back soon for updates.';
        } else {
            http_response_code(401);
            echo 'Cannot submit application. Please try again!';
        }
    }
?>