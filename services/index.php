<?php require_once '../common/configuration.php';?>
<?php require_once "../model/database.php"; ?>
<?php require_once "../model/renter_property_db.php"; ?>
<?php require_once "../model/rental_app_db.php"; ?>
<?php require_once "../model/util_db.php"; ?>
<?php require_once "../model/property_db.php"; ?>
<?php require_once "../model/renter_property_db.php"; ?>
<?php require_once "../model/rental_app_db.php"; ?>
<?php
    session_start();

    if ($_GET['type'] === 'get_prop_data') {

        if(isset($_GET['prop_id']) ){
            $data = getPropertyById($_GET['prop_id']);
            if(!empty($data)) {
                $landlord_state = getStateById($data['landlord_state_id']);
                $data['landlord_state_text'] = $landlord_state['state_name'];
            }
            echo json_encode($data);
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

    if ($_GET['type'] === 'get_application_data') {
        // print_r($_SESSION);
        echo json_encode(getRentalAppsByLandlordId($_SESSION['PEOPLE_ID']));
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

    if ($_GET['type'] === 'set_application_status_approved' && isset($_GET['app_id'])) {
        $id = $_GET['app_id'];
        $updated_application = updateRentalApp($id,"last_status_id",APPROVED_ID);
        if($updated_application){
            echo json_encode($updated_application);
        } else {
            echo 'Error while updating. Please try again.';
        }
    }

    if ($_GET['type'] === 'set_application_status_rejected' && isset($_GET['app_id'])) {
        $id = $_GET['app_id'];
        $updated_application = updateRentalApp($id,"last_status_id",REJECTED_ID);
        if($updated_application){
            echo json_encode($updated_application);
        } else {
            echo 'Error while updating. Please try again.';
        }
    }

    if ($_GET['type'] === 'set_property_renter_relationship' && isset($_GET['prop_id'])) {
        $prop_id = $_GET['prop_id'];
        $renter_id = $_SESSION['PEOPLE_ID'];
        $renter_match_score = rand(5,10) + rand(0,10)/10; // needs to be calculated

        $rel_data = getPropertyRelationshipByRenterIdByPropertyID($renter_id, $prop_id);

        if(empty($rel_data)){
            $result = insertRenterProperty($renter_id,$prop_id, $renter_match_score);
            $data = [$renter_id,$prop_id,$renter_match_score];
            if($result){
                echo json_encode(["result" => true, "message" => "Sucessfully established relationship", "data" => ($data)]);
            } else {
                echo json_encode(["result" => false, "message" => "Error. Could not establish relationship"]);
                }
        } else {
            echo json_encode(["result" => true, "message" => "Relationship already exists! You can apply", "data" => ($rel_data)]);
        }
        
    }

    if( $_GET['type'] === 'post_app_form' && !empty($_POST)){

        //ENTER VALIDATION HERE

        $renterpoperty_data =  getPropertyRelationshipByRenterIdByPropertyID($_SESSION["PEOPLE_ID"], $_POST["app_prop_id"]);
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