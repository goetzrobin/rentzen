<?php


if(!defined("VACANT_ID")) define("VACANT_ID",401);
if(!defined("OCCUPIED_ID")) define("OCCUPIED_ID",402);
if(!defined("LISTED")) define("LISTED",403);


function getRenterPropertyRelationships(){
    //returns an array of Renter_Property
    global $db;
    $statement = $db->prepare('select * '
            . ' from renter_property '
            . '');
    $statement->execute();
    $result = $statement->fetchAll(PDO::FETCH_ASSOC);
    $statement->closeCursor();
    return $result;
}

function getRenterPropertyById($id){
    //returns an array of renter_property
    global $db;
    $statement = $db->prepare('select * '
            . ' from renter_property ' 
            . 'where renterproperty_id=:id'
            . '');
    $statement->bindValue(':id', $id);
    $statement->execute();
    $result = $statement->fetch(PDO::FETCH_ASSOC);
    $statement->closeCursor();
    if (empty($result)){
        $result = false;
    } 
    return $result;
}

function getRentersByPropertyId($prop_id) {
    //returns an array of renter_property
    global $db;
    $statement = $db->prepare('select * '
            . ' from renter_property,people ' 
            . 'where renter_property.renter_id=people.people_id '
            . 'and renter_property.property_id=:id');
    $statement->bindValue(':id', $prop_id);
    $statement->execute();
    $result = $statement->fetchAll(PDO::FETCH_ASSOC);
    $statement->closeCursor();
    if (empty($result)){
        $result = false;
    } 
    return $result;
}

function getPropertiesByRenterId($renter_id) {
    //returns an array of renter_property
    global $db;
    $statement = $db->prepare('select * '
            . ' from renter_property,property ' 
            . 'where renter_property.property_id=property.property_id '
            . 'and renter_property.renter_id=:id');
    $statement->bindValue(':id', $renter_id);
    $statement->execute();
    $result = $statement->fetchAll(PDO::FETCH_ASSOC);
    $statement->closeCursor();
    if (empty($result)){
        $result = false;
    } 
    return $result;
}

function getOccupiedPropertiesByRenterId($renter_id) {
    //returns an array of renter_property
    global $db;
    $statement = $db->prepare('select * '
            . ' from renter_property,property ' 
            . 'where renter_property.property_id=property.property_id '
            . 'and property.propstat_id = '.OCCUPIED_ID
            . 'and renter_property.renter_id=:id');
    $statement->bindValue(':id', $renter_id);
    $statement->execute();
    $result = $statement->fetchAll(PDO::FETCH_ASSOC);
    $statement->closeCursor();
    if (empty($result)){
        $result = false;
    } 
    return $result;
}

function getListedPropertiesByRenterId($renter_id) {
    //returns an array of renter_property
    global $db;
    $statement = $db->prepare('select * '
            . ' from renter_property,property ' 
            . 'where renter_property.property_id=property.property_id '
            . 'and property.propstat_id = '.LISTED
            . 'and renter_property.renter_id=:id');
    $statement->bindValue(':id', $renter_id);
    $statement->execute();
    $result = $statement->fetchAll(PDO::FETCH_ASSOC);
    $statement->closeCursor();
    if (empty($result)){
        $result = false;
    } 
    return $result;
}

function getVacantPropertiesByRenterId($renter_id) {
    //returns an array of renter_property
    global $db;
    $statement = $db->prepare('select * '
            . ' from renter_property,property ' 
            . 'where renter_property.property_id=property.property_id '
            . 'and property.propstat_id = '.VACANT_ID
            . 'and renter_property.renter_id=:id');
    $statement->bindValue(':id', $renter_id);
    $statement->execute();
    $result = $statement->fetchAll(PDO::FETCH_ASSOC);
    $statement->closeCursor();
    if (empty($result)){
        $result = false;
    } 
    return $result;
}

function getPropertyRelationshipByRenterIdByPropertyID($renter_id, $property_id) {
    //returns an array of renter_property
    global $db;
    $statement = $db->prepare('select renterproperty_id, renter_id, property_id, renter_match_score '
            . ' from renter_property '
            . 'where renter_property.renter_id=:id '
            . 'and renter_property.property_id=:property_id'
        );
    $statement->bindValue(':id', $renter_id);
    $statement->bindValue(':property_id', $property_id);
    $statement->execute();
    $result = $statement->fetch(PDO::FETCH_ASSOC);
    $statement->closeCursor();
    if (empty($result)){
        $result = false;
    } 
    return $result;
}


function insertRenterProperty(
    $renter_id,
    $property_id,
    $renter_match_score
) {
    global $db;
    $sql = "
    INSERT INTO renter_property( 
        renter_id,
        property_id,
        renter_match_score
        ) 
    VALUES ( 
        :renter_id,
        :property_id,
        :renter_match_score
        )  ";
    $statement = $db->prepare($sql);

    $statement->bindValue(':renter_id', $renter_id);
    $statement->bindValue(':property_id', $property_id);
    $statement->bindValue(':renter_match_score', $renter_match_score);

    $result = $statement->execute();
    $statement->closeCursor();
    return $result;
}

function updateRenterProperty($id, $column, $value)
{
    global $db;
    $placeholder = ':' . $column;
    $sql = 'UPDATE renter_property SET ' . $column . ' = ' . $placeholder . ' WHERE renterproperty_id=:renterproperty_id';
    $statement = $db->prepare($sql);
    $statement->bindValue('renterproperty_id', $id);
    $statement->bindValue($placeholder, $value);
    $result = $statement->execute();
    $statement->closeCursor();
    if (empty($result)) {
        $result = false;
    } else {
        return getRenterPropertyById($id);
    }
}

function deleteRenterPropertyById($id)
{
    global $db;
    $sql = 'DELETE FROM renter_property WHERE renterproperty_id=:renterproperty_id';
    $statement = $db->prepare($sql);
    $statement->bindValue('renterproperty_id', $id);
    $result = $statement->execute();
    $statement->closeCursor();
    return $result;
}

function getState() {
    //returns states
    global $db;
    $sql= "select * from state ";
    $statement = $db->prepare($sql);
    $statement->execute();
    $result = $statement->fetchAll();
    $statement->closeCursor();
    if (empty($result)){
        $result = false;
    } 
    return $result;
}
?>