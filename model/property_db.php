<?php

function getProperties()
{
    //returns an array of people
    global $db;
    $statement = $db->prepare('select * '
        . ' from property, property_status, property_type, state '
        . 'where property.propstat_id = property_status.propstat_id
                and property.type_id = property_type.propertytype_id
                and property.state_id = state.state_id');
    $statement->execute();
    $result = $statement->fetchAll(PDO::FETCH_ASSOC);
    $statement->closeCursor();
    if (empty($result)) {
        $result = false;
    }
    return $result;
}

function getPropertyById($id)
{
    //returns an array of people
    global $db;
    $statement = $db->prepare('select * '
        . ' from property, property_status, property_type, state '
        . 'where property.propstat_id = property_status.propstat_id
                and property.type_id = property_type.propertytype_id
                and property.state_id = state.state_id
                and property_id = :property_id');
    $statement->bindValue(':property_id', $id);
    $statement->execute();
    $result = $statement->fetch(PDO::FETCH_ASSOC);
    $statement->closeCursor();
    if (empty($result)) {
        $result = false;
    }
    return $result;
}

function getPropertiesByLandlordId($id)
{
    //returns an array of people
    global $db;
    $statement = $db->prepare('select * '
        . ' from property, landlord_property WHERE landlord_property.property_id=property.property_id'
        . ' and landlord_property.landlord_id = :landlord_id' );
    $statement->bindValue(':landlord_id', $id);
    $statement->execute();
    $result = $statement->fetchAll(PDO::FETCH_ASSOC);
    $statement->closeCursor();
    if (empty($result)) {
        $result = false;
    }
    return $result;
}

function getLandlordsByPropertyId($id)
{
    //returns an array of people
    global $db;
    $statement = $db->prepare('select * '
        . ' from people, landlord_property WHERE landlord_property.landlord_id=people.people_id'
        . ' and landlord_property.property_id = :property_id' );
    $statement->bindValue(':property_id', $id);
    $statement->execute();
    $result = $statement->fetchAll(PDO::FETCH_ASSOC);
    $statement->closeCursor();
    if (empty($result)) {
        $result = false;
    }
    return $result;
}

function getPropertiesByState() {

}

function getPropertiesByType() {

}

function getPropertiesByStatus() {

}

function getPropertiesByFeature() {

}

function getPropertiesByFeatures(){

}

function getPropertiesByZipRange(){

}

function getPropertiesByBedRange(){

}

function getPropertiesByBathRange(){

}

function getPropertiesBySQFTRange(){

}

function getPropertiesByIncomeReqRange(){

}

function getPropertiesByCreditRange(){

}

function getPropertiesByRentalFee(){

}

function insertProperty(
    $street = null,
    $city = null,
    $state_id = null,
    $zip = null,
    $beds = null,
    $baths = null,
    $sqft = null,
    $type_id = null,
    $propstat_id = null,
    $income_requirement = null,
    $credit_requirement = null,
    $rental_fee = null,
    $description = null,
    $picture = null
) {
    global $db;
    $sql = "
    INSERT INTO `property`( 
        street,
        city,
        state_id,
        zip,
        beds,
        baths,
        sqft,
        type_id,
        propstat_id,
        income_requirement,
        credit_requirement,
        rental_fee,
        description,
        picture
        ) 
    VALUES ( 
        :street,
        :city,
        :state_id,
        :zip,
        :beds,
        :baths,
        :sqft,
        :type_id,
        :propstat_id,
        :income_requirement,
        :credit_requirement,
        :rental_fee,
        :description,
        :picture
        )  ";
    $statement = $db->prepare($sql);
    $statement->bindValue(':street', $street);
    $statement->bindValue(':city', $city);
    $statement->bindValue(':state_id', $state_id);
    $statement->bindValue(':zip', $zip);
    $statement->bindValue(':beds', $beds);
    $statement->bindValue(':baths', $baths);
    $statement->bindValue(':sqft', $sqft);
    $statement->bindValue(':type_id', $type_id);
    $statement->bindValue(':propstat_id', $propstat_id);
    $statement->bindValue(':income_requirement', $income_requirement);
    $statement->bindValue(':credit_requirement', $credit_requirement);
    $statement->bindValue(':rental_fee', $rental_fee);
    $statement->bindValue(':description', $description);
    $statement->bindValue(':picture', $picture);

    $result = $statement->execute();
    $id = $db->lastInsertId();
    $statement->closeCursor();
    return $id;
}

function updateProperty($id, $column, $value)
{
    global $db;
    $placeholder = ':' . $column;
    $sql = 'UPDATE property SET ' . $column . ' = ' . $placeholder . ' WHERE property_id=:property_id';
    $statement = $db->prepare($sql);
    $statement->bindValue('property_id', $id);
    $statement->bindValue($placeholder, $value);
    $result = $statement->execute();
    $statement->closeCursor();
    if (empty($result)) {
        $result = false;
    } else {
        return getPropertyById($id);
    }
}

function deletePropertyById($id)
{
    global $db;
    $placeholder = ':' . $column;
    $sql = 'DELETE FROM property WHERE property_id=:property_id';
    $statement = $db->prepare($sql);
    $statement->bindValue('property_id', $id);
    $result = $statement->execute();
    $statement->closeCursor();
    return $result;
}
?>