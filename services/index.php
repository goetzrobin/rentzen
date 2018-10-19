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
        } else {
            echo 'No Property Id provided.';
            exit();
        }

    }

    if ($_GET['type'] === 'get_session_data') {
        echo json_encode($_SESSION);
        exit();
    }

    if ($_GET['type'] === 'get_states') {
        echo json_encode(getStates());
        exit();
    }
    
    if ($_GET['type'] === 'get_property_type') {
        echo json_encode(getPropertyTypes());
        exit();
    }

    if ($_GET['type'] === 'get_property_status') {
        echo json_encode(getPropertyStatus());
        exit();
    }

    if ($_GET['type'] === 'get_application_data') {
        $id = $_SESSION['PEOPLE_ID'];
        if($id){
            echo json_encode(getRentalAppsByLandlordId($id));
            exit();
        } else {
            echo 'No id set.';
            exit();
        }
        
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
        if(empty($renter_id)) {
            echo json_encode(["result" => false, "message" => "No renter id provided."]);
            exit();
        }
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

        
         $app_status = $_POST["app_status"];
         $app_move_in_date = $_POST["app_move_in_date"];
         $app_move_out_date = $_POST["app_move_out_date"];
         $app_message = $_POST["app_message"];
         $renter_id = $_SESSION["PEOPLE_ID"];
         $app_prop_id = $_POST["app_prop_id"];

        if( !isset($app_status) || !isset($app_move_in_date) || !isset($renter_id) || !isset($app_prop_id) ||
            empty($app_status) || empty($app_move_in_date) || empty($renter_id) || empty($app_prop_id)) {
                echo 'Not all necessary data provided. Check inputs';
                exit();
        }
        
        $renterpoperty_data =  getPropertyRelationshipByRenterIdByPropertyID($renter_id,$app_prop_id);

        $renterproperty_id = $renterpoperty_data['renterproperty_id'];

        if (!isset($renterproperty_id) || empty($renterproperty_id)) {
            echo 'Cannot find Relationship.';
            exit();
        }

        $inserted_id = insertRentalApp(
            $renterpoperty_data['renterproperty_id'], 
            $_POST["app_status"],
            $_POST["app_move_in_date"], 
            $_POST["app_move_out_date"], 
            $_POST["app_message"] 
            );
    
        if($inserted_id){
            echo 'Application submitted! Come back soon for updates.';
            exit();
        } else {
            http_response_code(401);
            echo 'Cannot submit application. Please try again!';
            exit();
        }
    }

    if( $_GET['type'] === 'post_new_prop_form' && !empty($_POST)){
        $inputAddress = filter_input(INPUT_POST,"inputAddress");
        $inputCity = filter_input(INPUT_POST,"inputCity");
        $inputState = filter_input(INPUT_POST,"inputState",FILTER_VALIDATE_INT);
        $inputZip = filter_input(INPUT_POST,"inputZip",FILTER_VALIDATE_INT);
        $beds = filter_input(INPUT_POST,"beds",FILTER_VALIDATE_INT);
        $baths = filter_input(INPUT_POST,"baths",FILTER_VALIDATE_FLOAT);
        $sqft = filter_input(INPUT_POST,"sqft",FILTER_VALIDATE_INT);
        $type = filter_input(INPUT_POST,"type",FILTER_VALIDATE_INT);
        $status = filter_input(INPUT_POST,"status",FILTER_VALIDATE_INT);
        $income_req = filter_input(INPUT_POST,"income_req",FILTER_VALIDATE_FLOAT);
        $credit_score = filter_input(INPUT_POST,"credit_score",FILTER_VALIDATE_INT);
        $rental_fee = filter_input(INPUT_POST,"rental_fee",FILTER_VALIDATE_FLOAT);
        $description = filter_input(INPUT_POST,"description");
        $picture = null;

        $landlord_id = $_SESSION['PEOPLE_ID'];

        if( !isset($inputAddress) || empty($inputAddress) ||
            !isset($inputCity) || empty($inputCity) ||
            !isset($inputState) || empty($inputState) ||
            !isset($inputZip) || empty($inputZip) ||
            !isset($beds) || empty($beds) ||
            !isset($baths) || empty($baths) ||
            !isset($sqft) || empty($sqft) ||
            !isset($type) || empty($type) ||
            !isset($status) || empty($status) ||
            !isset($income_req) || empty($income_req) ||
            !isset($credit_score) || empty($credit_score) ||
            !isset($rental_fee) || empty($rental_fee) ||
            !isset($description) || empty($description) ||
            !isset($landlord_id) || empty($landlord_id) ) {
                echo "Not all data provided.";
                exit();
            }
        
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
        $baths = filter_input(INPUT_POST,"baths",FILTER_VALIDATE_FLOAT);
        $sqft = filter_input(INPUT_POST,"sqft",FILTER_VALIDATE_INT);
        $type = filter_input(INPUT_POST,"type",FILTER_VALIDATE_INT);
        $status = filter_input(INPUT_POST,"status",FILTER_VALIDATE_INT);
        $income_req = filter_input(INPUT_POST,"income_req",FILTER_VALIDATE_FLOAT);
        $credit_score = filter_input(INPUT_POST,"credit_score",FILTER_VALIDATE_INT);
        $rental_fee = filter_input(INPUT_POST,"rental_fee",FILTER_VALIDATE_INT);
        $description = filter_input(INPUT_POST,"description");

        if(!isset($property_id)) {
            echo "No id provided. Cannot update.";
            exit();
        }
        
        if( !isset($inputAddress) || empty($inputAddress) ||
            !isset($inputCity) || empty($inputCity) ||
            !isset($inputState) || empty($inputState) ||
            !isset($inputZip) || empty($inputZip) ||
            !isset($beds) || empty($beds) ||
            !isset($baths) || empty($baths) ||
            !isset($sqft) || empty($sqft) ||
            !isset($type) || empty($type) ||
            !isset($status) || empty($status) ||
            !isset($income_req) || empty($income_req) ||
            !isset($credit_score) || empty($credit_score) ||
            !isset($rental_fee) || empty($rental_fee) ||
            !isset($description) || empty($description) ) {
                echo "Not all data provided.";
                exit();
            }
        
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
            echo "Sucessfully updated Property with id: ".$result['property_id'];
        } else {
            echo "Error when updating.";
        }
        //ENTER VALIDATION HERE
    }

?>