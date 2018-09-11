<?php
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


function insertRenterProperty(
    $renter_id,
    $property_id,
    $renter_match_score
) {
    global $db;
    $sql = "
    INSERT INTO `renter_property`( 
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
    $id = $db->lastInsertId();
    $statement->closeCursor();
    return $id;
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
?>