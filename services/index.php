<?php require_once '../common/configuration.php';?>
<?php require_once "../model/database.php"; ?>
<?php require_once "../model/renter_property_db.php"; ?>
<?php require_once "../model/rental_app_db.php"; ?>
<?php require_once "../model/util_db.php"; ?>
<?php require_once "../model/property_db.php"; ?>
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

    if ($_GET['type'] === 'get_states') {
        echo json_encode(getStates());
    }
    
    if ($_GET['type'] === 'get_property_type') {
        echo json_encode(getPropertyTypes());
    }

    if ($_GET['type'] === 'get_property_status') {
        echo json_encode(getPropertyStatus());
    }

    if ($_GET['type'] === 'set_property_status_occupied' && isset($_GET['prop_id'])) {
        $id = $_GET['prop_id'];
        $updated_property = updateProperty($id,"propstat_id",OCCUPIED_ID);
        if($updated_property){
            echo json_encode($updated_property);
        } else {
            echo 'Error while updating. Please try again.';
        }
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

    if( $_GET['type'] === 'post_new_prop_form' && !empty($_POST)){
        $inputAddress = filter_input(INPUT_POST,"inputAddress");
        $inputCity = filter_input(INPUT_POST,"inputCity",FILTER_VALIDATE_INT);
        $inputState = filter_input(INPUT_POST,"inputState",FILTER_VALIDATE_INT);
        $inputZip = filter_input(INPUT_POST,"inputZip",FILTER_VALIDATE_INT);
        $beds = filter_input(INPUT_POST,"beds",FILTER_VALIDATE_INT);
        $baths = filter_input(INPUT_POST,"baths",FILTER_VALIDATE_INT);
        $sqft = filter_input(INPUT_POST,"sqft",FILTER_VALIDATE_INT);
        $type = filter_input(INPUT_POST,"type",FILTER_VALIDATE_INT);
        $status = filter_input(INPUT_POST,"status",FILTER_VALIDATE_INT);
        $income_req = filter_input(INPUT_POST,"income_req",FILTER_VALIDATE_INT);
        $credit_score = filter_input(INPUT_POST,"credit_score",FILTER_VALIDATE_INT);
        $rental_fee = filter_input(INPUT_POST,"rental_fee",FILTER_VALIDATE_INT);
        $description = filter_input(INPUT_POST,"description");
        $picture = null;

        $landlord_id = $_SESSION['PEOPLE_ID'];
        
        $result = insertProperty(
            $inputAddress,
            $inputCity,
            $inputState,
            $inputZip,
            $beds,
            $baths,
            $sqft,
            $type,
            $status,
            $income_req,
            $credit_score,
            $rental_fee,
            $description,
            $picture,
            $landlord_id
        );

        if($result) {
            echo "Sucessfully inserted Property with id: ".$result;
        } else {
            echo "Error when inserting.";
        }
        //ENTER VALIDATION HERE
    }

    if( $_GET['type'] === 'post_edit_prop_form' && !empty($_POST)){
        $property_id = filter_input(INPUT_POST, "property_id", FILTER_VALIDATE_INT);
        $inputAddress = filter_input(INPUT_POST,"inputAddress");
        $inputCity = filter_input(INPUT_POST,"inputCity");
        $inputState = filter_input(INPUT_POST,"inputState",FILTER_VALIDATE_INT);
        $inputZip = filter_input(INPUT_POST,"inputZip",FILTER_VALIDATE_INT);
        $beds = filter_input(INPUT_POST,"beds",FILTER_VALIDATE_INT);
        $baths = filter_input(INPUT_POST,"baths",FILTER_VALIDATE_INT);
        $sqft = filter_input(INPUT_POST,"sqft",FILTER_VALIDATE_INT);
        $type = filter_input(INPUT_POST,"type",FILTER_VALIDATE_INT);
        $status = filter_input(INPUT_POST,"status",FILTER_VALIDATE_INT);
        $income_req = filter_input(INPUT_POST,"income_req",FILTER_VALIDATE_INT);
        $credit_score = filter_input(INPUT_POST,"credit_score",FILTER_VALIDATE_INT);
        $rental_fee = filter_input(INPUT_POST,"rental_fee",FILTER_VALIDATE_INT);
        $description = filter_input(INPUT_POST,"description");

        
        $result = updatePropertyComplete(
            $property_id,
            $inputAddress,
            $inputCity,
            $inputState,
            $inputZip,
            $beds,
            $baths,
            $sqft,
            $type,
            $status,
            $income_req,
            $credit_score,
            $rental_fee,
            $description
        );

        if($result) {
            echo "Sucessfully inserted Property with id: ".$result;
        } else {
            echo "Error when inserting.";
        }
        //ENTER VALIDATION HERE
    }

?>