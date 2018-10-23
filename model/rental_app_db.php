<?php

if(!defined("SUBMITTED_ID")) define("SUBMITTED_ID",1);
if(!defined("REJECTED_ID")) define("REJECTED_ID",2);
if(!defined("DRAFT_ID")) define("DRAFT_ID",1);
if(!defined("APPROVED_ID")) define("APPROVED_ID",4);



function getRentalApp(){
    //returns an array of rental_application
    global $db;
    $statement = $db->prepare('select * '
            . ' from rental_application,rental_app_status '
            . 'WHERE last_status_id = app_status_id ORDER BY move_in_date DESC');
    $statement->execute();
    $result = $statement->fetchAll(PDO::FETCH_ASSOC);
    $statement->closeCursor();
    return $result;
}

function getRentalAppById($id){
    //returns an array of rental_application
    global $db;
    $statement = $db->prepare('select * '
            . ' from rental_application ' 
            . 'where rental_application_id=:id'
           );
    $statement->bindValue(':id', $id);
    $statement->execute();
    $result = $statement->fetch(PDO::FETCH_ASSOC);
    $statement->closeCursor();
    if (empty($result)){
        $result = false;
    } 
    return $result;
}

function getRentalAppsByLandlordId($landlord_id){
    //returns an array of rental_application
    global $db;
    $sql = "SELECT
    property.`property_id`, property.`street`, property.`city`, property.`state_id`, property.`zip`, property.`beds`, property.`baths`, property.`sqft`, property.`type_id`, property.`propstat_id`, property.`income_requirement`, property.`credit_requirement`, property.`rental_fee`, property.`description`, property.`picture`, 
    rental_app_status.`app_status_id`, rental_app_status.`app_status_name`,
    renter_property.`renterproperty_id`, renter_property.`renter_id`, renter_property.`property_id`, renter_property.`renter_match_score`
    `people_id`, renters.`firstname`, renters.`lastname`, `renter_match_score`,
    `rental_application_id`, `last_status_id`, `move_in_date`, `move_out_date`, `renter_message`
    FROM rental_application, renter_property, property, landlord_property, rental_app_status, people, people as renters
         WHERE rental_application.renterproperty_id = renter_property.renterproperty_id 
         AND last_status_id = app_status_id
         AND renter_property.property_id = property.property_id 
         AND property.property_id = landlord_property.property_id 
         AND people.people_id = landlord_property.landlord_id  
        AND renters.people_id = renter_property.renter_id 
    AND people.people_id = :landlord_id
    ORDER BY app_status_id ASC";
    $statement = $db->prepare($sql);
    $statement->bindValue(':landlord_id', $landlord_id);
    $statement->execute();
    $result = $statement->fetchAll(PDO::FETCH_ASSOC);
    $statement->closeCursor();
    if (empty($result)){
        $result = false;
    } 
    return $result;
}

function getSubmittedRentalAppsByLandlordId($landlord_id){
    //returns an array of rental_application
    global $db;
    $sql = "SELECT
    property.`property_id`, property.`street`, property.`city`, property.`state_id`, property.`zip`, property.`beds`, property.`baths`, property.`sqft`, property.`type_id`, property.`propstat_id`, property.`income_requirement`, property.`credit_requirement`, property.`rental_fee`, property.`description`, property.`picture`, 
    rental_app_status.`app_status_id`, rental_app_status.`app_status_name`,
    renter_property.`renterproperty_id`, renter_property.`renter_id`, renter_property.`property_id`, renter_property.`renter_match_score`
    `people_id`, renters.`firstname`, renters.`lastname`, `renter_match_score`,
    `rental_application_id`, `last_status_id`, `move_in_date`, `move_out_date`, `renter_message`
    FROM rental_application, renter_property, property, landlord_property, rental_app_status, people, people as renters
         WHERE rental_application.renterproperty_id = renter_property.renterproperty_id 
         AND last_status_id = app_status_id
         AND renter_property.property_id = property.property_id 
         AND property.property_id = landlord_property.property_id 
         AND people.people_id = landlord_property.landlord_id  
        AND renters.people_id = renter_property.renter_id ".
    "AND last_status_id=" . SUBMITTED_ID
    ." AND people.people_id = :landlord_id
    ORDER BY app_status_id ASC";
    $statement = $db->prepare($sql);
    $statement->bindValue(':landlord_id', $landlord_id);
    $statement->execute();
    $result = $statement->fetchAll(PDO::FETCH_ASSOC);
    $statement->closeCursor();
    if (empty($result)){
        $result = false;
    } 
    return $result;
}

function getRejectedRentalAppsByLandlordId($landlord_id){
    //returns an array of rental_application
    global $db;
    $sql = "SELECT
    property.`property_id`, property.`street`, property.`city`, property.`state_id`, property.`zip`, property.`beds`, property.`baths`, property.`sqft`, property.`type_id`, property.`propstat_id`, property.`income_requirement`, property.`credit_requirement`, property.`rental_fee`, property.`description`, property.`picture`, 
    rental_app_status.`app_status_id`, rental_app_status.`app_status_name`,
    renter_property.`renterproperty_id`, renter_property.`renter_id`, renter_property.`property_id`, renter_property.`renter_match_score`
    `people_id`, renters.`firstname`, renters.`lastname`, `renter_match_score`,
    `rental_application_id`, `last_status_id`, `move_in_date`, `move_out_date`, `renter_message`
    FROM rental_application, renter_property, property, landlord_property, rental_app_status, people, people as renters
         WHERE rental_application.renterproperty_id = renter_property.renterproperty_id 
         AND last_status_id = app_status_id
         AND renter_property.property_id = property.property_id 
         AND property.property_id = landlord_property.property_id 
         AND people.people_id = landlord_property.landlord_id  
        AND renters.people_id = renter_property.renter_id ".
    " AND last_status_id=" . REJECTED_ID
    ." AND people.people_id = :landlord_id
    ORDER BY app_status_id ASC";
    $statement = $db->prepare($sql);
    $statement->bindValue(':landlord_id', $landlord_id);
    $statement->execute();
    $result = $statement->fetchAll(PDO::FETCH_ASSOC);
    $statement->closeCursor();
    if (empty($result)){
        $result = false;
    } 
    return $result;
}

function getApprovedRentalAppsByLandlordId($landlord_id){
    //returns an array of rental_application
    global $db;
    $sql = "SELECT
    property.`property_id`, property.`street`, property.`city`, property.`state_id`, property.`zip`, property.`beds`, property.`baths`, property.`sqft`, property.`type_id`, property.`propstat_id`, property.`income_requirement`, property.`credit_requirement`, property.`rental_fee`, property.`description`, property.`picture`, 
    rental_app_status.`app_status_id`, rental_app_status.`app_status_name`,
    renter_property.`renterproperty_id`, renter_property.`renter_id`, renter_property.`property_id`, renter_property.`renter_match_score`
    `people_id`, renters.`firstname`, renters.`lastname`, `renter_match_score`,
    `rental_application_id`, `last_status_id`, `move_in_date`, `move_out_date`, `renter_message`
    FROM rental_application, renter_property, property, landlord_property, rental_app_status, people, people as renters
         WHERE rental_application.renterproperty_id = renter_property.renterproperty_id 
         AND last_status_id = app_status_id
         AND renter_property.property_id = property.property_id 
         AND property.property_id = landlord_property.property_id 
         AND people.people_id = landlord_property.landlord_id  
        AND renters.people_id = renter_property.renter_id 
    AND people.people_id = :landlord_id ".
    " AND last_status_id=" . APPROVED_ID
    ." ORDER BY app_status_id ASC";
    $statement = $db->prepare($sql);
    $statement->bindValue(':landlord_id', $landlord_id);
    $statement->execute();
    $result = $statement->fetchAll(PDO::FETCH_ASSOC);
    $statement->closeCursor();
    if (empty($result)){
        $result = false;
    } 
    return $result;
}


function getRentalAppByStatusId($status_id){
    //returns an array of rental_application
    global $db;
    $statement = $db->prepare('select * '
            . ' from rental_application ' 
            . 'where last_status_id=:id'
            . '');
    $statement->bindValue(':id', $status_id);
    $statement->execute();
    $result = $statement->fetchAll(PDO::FETCH_ASSOC);
    $statement->closeCursor();
    if (empty($result)){
        $result = false;
    } 
    return $result;
}


function insertRentalApp(
    $renter_property_id,
    $last_status_id,
    $move_in_date,
    $move_out_date,
    $renter_message
) {
    global $db;
    $sql = "
    INSERT INTO `rental_application`(
        renterproperty_id,
        last_status_id,
        move_in_date,
        move_out_date,
        renter_message
        ) 
    VALUES ( 
        :renterproperty_id,
        :last_status_id,
        :move_in_date,
        :move_out_date,
        :renter_message
        )  ";
    $statement = $db->prepare($sql);

    $statement->bindValue(":renterproperty_id", $renter_property_id);
    $statement->bindValue(":last_status_id", $last_status_id);
    $statement->bindValue(":move_in_date", $move_in_date);
    $statement->bindValue(":move_out_date", $move_out_date);
    $statement->bindValue(":renter_message", $renter_message);

    $result = $statement->execute();
    $id = $db->lastInsertId();
    $statement->closeCursor();
    return $id;
}

function updateRentalApp($id, $column, $value)
{
    global $db;
    $placeholder = ':' . $column;
    $sql = 'UPDATE rental_application SET ' . $column . ' = ' . $placeholder . ' WHERE rental_application_id=:rental_application_id';
    $statement = $db->prepare($sql);
    $statement->bindValue('rental_application_id', $id);
    $statement->bindValue($placeholder, $value);
    $result = $statement->execute();
    $statement->closeCursor();
    if (empty($result)) {
        $result = false;
    } else {
        return getRentalAppById($id);
    }
}

function deleteRentalApp($id)
{
    global $db;
    $sql = 'DELETE FROM rental_application WHERE rental_application_id=:id';
    $statement = $db->prepare($sql);
    $statement->bindValue('id', $id);
    $result = $statement->execute();
    $statement->closeCursor();
    return $result;
}
?>