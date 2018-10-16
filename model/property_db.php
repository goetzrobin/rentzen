<?php

define("PROPERTY_BASE_PATH","../user_data/properties");
define("VACANT_ID",401);
define("OCCUPIED_ID",402);
define("LISTED",403);

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
    $statement = $db->prepare(
        'select'
        .  ' property.property_id, property.street, property.city, property.state_id, property.zip, property.beds, property.baths, property.sqft, property.type_id, property.propstat_id, property.income_requirement, property.credit_requirement, property.rental_fee, property.description, property.picture,'
        .  ' property_type.typename, '
        .  ' property_status.propertystat, '
        .  ' state.state_id, state.state_name, '
        .  ' people.people_id as landlord_people_id, people.email as landlord_email, people.username as landlord_username, people.firstname as landlord_firstname, people.lastname as landlord_lastname, people.phone as landlord_phone, people.street as landlord_street, people.city as landlord_city, people.state_id as landlord_state_id, people.zip as landlord_zip, people.role_id as landlord_role_id, people.credit_rating as landlord_credit_rating, people.income as landlord_income, people.date_updated as landlord_date_updated'
        .  ' from property, property_status, property_type, state, landlord_property,people'
        .  ' where property.propstat_id = property_status.propstat_id 
                and property.type_id = property_type.propertytype_id 
                and property.state_id = state.state_id 
                and landlord_property.property_id = property.property_id 
                and landlord_property.landlord_id = people.people_id 
                and property.property_id = :property_id');
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
    . ' from property, property_status, property_type, state, landlord_property '
    .  ' WHERE landlord_property.property_id=property.property_id'
    .  ' and property.propstat_id = property_status.propstat_id'
    .  ' and property.type_id = property_type.propertytype_id'
    .  ' and property.state_id = state.state_id'
    . '  and landlord_property.landlord_id = :landlord_id');
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
        . ' and landlord_property.property_id = :property_id');
    $statement->bindValue(':property_id', $id);
    $statement->execute();
    $result = $statement->fetchAll(PDO::FETCH_ASSOC);
    $statement->closeCursor();
    if (empty($result)) {
        $result = false;
    }
    return $result;
}

/** 
 * Connects to DB and Filters Properties by Specificed Parameters
 * 
 * Possible parameters:
 * 
 * state_id
 * 
 * type_id
 * 
 * status_id
 * 
 * feature_id
 * 
 * feature_ids
 * 
 * zip
 * 
 * bed_low
 * 
 * bed_high
 * 
 * bath_low
 * 
 * bath_high
 * 
 * sqft_low
 * 
 * sqft_high
 * 
 * income_requirement_low
 * 
 * income_requirement_high
 * 
 * credit_requirement_low
 * 
 * credit_requirement_high
 * 
 * rental_fee_low
 * 
 * rental_fee_high
 * 
 */
function getPropertiesBySearchParams($search_params)
{

    $state_id = isset($search_params['state_id']) ? $search_params['state_id'] : null;
    $type_id = isset($search_params['type_id']) ? $search_params['type_id'] : null;
    $status_id = isset($search_params['status_id']) ? $search_params['status_id'] : null;
    $feature_id = isset($search_params['feature_id']) ? $search_params['feature_id'] : null;
    $feature_ids = isset($search_params['feature_ids']) ? $search_params['feature_ids'] : null;
    $zip = isset($search_params['zip']) ? $search_params['zip'] : null;
    $bed_low = isset($search_params['bed_low']) ? $search_params['bed_low'] : null;
    $bed_high = isset($search_params['bed_high']) ? $search_params['bed_high'] : null;
    $bath_low = isset($search_params['bath_low']) ? $search_params['bath_low'] : null;
    $bath_high = isset($search_params['bath_high']) ? $search_params['bath_high'] : null;
    $sqft_low = isset($search_params['sqft_low']) ? $search_params['sqft_low'] : null;
    $sqft_high = isset($search_params['sqft_high']) ? $search_params['sqft_high'] : null;
    $income_requirement_low = isset($search_params['income_requirement_low']) ? $search_params['income_requirement_low'] : null;
    $income_requirement_high = isset($search_params['income_requirement_high']) ? $search_params['income_requirement_high'] : null;
    $credit_requirement_low = isset($search_params['credit_requirement_low']) ? $search_params['credit_requirement_low'] : null;
    $credit_requirement_high = isset($search_params['credit_requirement_high']) ? $search_params['credit_requirement_high'] : null;
    $rental_fee_low = isset($search_params['rental_fee_low']) ? $search_params['rental_fee_low'] : null;
    $rental_fee_high = isset($search_params['rental_fee_high']) ? $search_params['rental_fee_high'] : null;
  

    global $db;

    $sql = sprintf(
        'SELECT * FROM property 
    
        WHERE property_id=property_id  %s %s  %s %s  %s %s  %s %s  %s %s  %s %s  %s %s  %s %s',


        (isset($state_id) && !empty($state_id)) ? 'AND state_id   = :state_id' : null,

        (isset($type_id) && !empty($type_id)) ? 'AND type_id   = :type_id' : null,

        (isset($status_id) && !empty($status_id)) ? 'AND propstat_id   = :status_id' : null,
        // !empty($feature_id)   ? 'AND feature_id   = :feature_id'   : null,
        (isset($zip) && !empty($zip)) ? 'AND zip = :zip' : null,

        (isset($bed_low) && !empty($bed_low)) ? 'AND beds   >= :bed_low' : null,
        (isset($bed_high) && !empty($bed_high)) ? 'AND beds   <= :bed_high' : null,

        (isset($bath_low) && !empty($bath_low)) ? 'AND baths   >= :bath_low' : null,
        (isset($bath_high) && !empty($bath_high)) ? 'AND baths   <= :bath_high' : null,

        (isset($sqft_low) && !empty($sqft_low)) ? 'AND sqft   >= :sqft_low' : null,
        (isset($sqft_high) && !empty($sqft_high)) ? 'AND sqft   <= :sqft_high' : null,

        (isset($income_requirement_low) && !empty($income_requirement_low)) ? 'AND income_requirement   >= :income_requirement_low' : null,
        (isset($income_requirement_high) && !empty($income_requirement_high)) ? 'AND income_requirement   <= :income_requirement_high' : null,

        (isset($credit_requirement_low) && !empty($credit_requirement_low)) ? 'AND credit_requirement   >= :credit_requirement_low' : null,
        (isset($credit_requirement_high) && !empty($credit_requirement_high)) ? 'AND credit_requirement   <= :credit_requirement_high' : null,

        (isset($rental_fee_low) && !empty($rental_fee_low)) ? 'AND rental_fee   >= :rental_fee_low' : null,
        (isset($rental_fee_high) && !empty($rental_fee_high)) ? 'AND rental_fee   <= :rental_fee_high' : null

    );

    $statement = $db->prepare($sql);

    if (isset($state_id) && !empty($state_id)) {
        $statement->bindValue('state_id', $state_id);
    }
    if (isset($type_id) && !empty($type_id)) {
        $statement->bindValue('type_id', $type_id);
    }
    if (isset($status_id) && !empty($status_id)) {
        $statement->bindValue('status_id', $status_id);
    }
    if (isset($zip) && !empty($zip)) {
        $statement->bindValue('zip', $zip);
    }
    if (isset($bed_low) && !empty($bed_low)) {
        $statement->bindValue('bed_low', $bed_low);
    }
    if (isset($bed_high) && !empty($bed_high)) {
        $statement->bindValue('bed_high', $bed_high);
    }
    if (isset($bath_low) && !empty($bath_low)) {
        $statement->bindValue('bath_low', $bath_low);
    }
    if (isset($bath_high) && !empty($bath_high)) {
        $statement->bindValue('bath_high', $bath_high);
    }
    if (isset($sqft_low) && !empty($sqft_low)) {
        $statement->bindValue('sqft_low', $sqft_low);
    }
    if (isset($sqft_high) && !empty($sqft_high)) {
        $statement->bindValue('sqft_high', $sqft_high);
    }
    if (isset($sqft_low) && !empty($sqft_low)) {
        $statement->bindValue('sqft_low', $sqft_low);
    }
    if (isset($sqft_high) && !empty($sqft_high)) {
        $statement->bindValue('sqft_high', $sqft_high);
    }
    if (isset($income_requirement_low) && !empty($income_requirement_low)) {
        $statement->bindValue('income_requirement_low', $income_requirement_low);
    }
    if (isset($income_requirement_high) && !empty($income_requirement_high)) {
        $statement->bindValue('income_requirement_high', $income_requirement_high);
    }
    if (isset($credit_requirement_low) && !empty($credit_requirement_low)) {
        $statement->bindValue('credit_requirement_low', $credit_requirement_low);
    }
    if (isset($credit_requirement_high) && !empty($credit_requirement_high)) {
        $statement->bindValue('credit_requirement_high', $credit_requirement_high);
    }
    if (isset($rental_fee_low) && !empty($rental_fee_low)) {
        $statement->bindValue('rental_fee_low', $rental_fee_low);
    }
    if (isset($rental_fee_high) && !empty($rental_fee_high)) {
        $statement->bindValue('rental_fee_low', $rental_fee_high);
    }
    if (isset($state_id) && !empty($state_id)) {
        $statement->bindValue(':state_id', $state_id);
    }
    if (isset($state_id) && !empty($state_id)) {
        $statement->bindValue(':state_id', $state_id);
    }
    if (isset($state_id) && !empty($state_id)) {
        $statement->bindValue(':state_id', $state_id);
    }

    $statement->execute();
    $result = $statement->fetchAll(PDO::FETCH_ASSOC);
    $statement->closeCursor();
    if (empty($result)) {
        $result = false;
    }
    return $result;
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
    $picture = null,
    $landlord_id = null
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
    $property_id = $db->lastInsertId();
    $statement->closeCursor();
    
    mkdir(PROPERTY_BASE_PATH ."/".$property_id,0777,true);

    if (createLandlordPropertyRelationship($landlord_id, $property_id)) {
        return $property_id;
    } else {
        return false;
    }
    
}

function updatePropertyComplete(
    $property_id = null,
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
    $description = null
) {
    global $db;
    $sql = "
    UPDATE `property` SET 
        street = :street,
        city = :city,
        state_id = :state_id,
        zip = :zip,
        beds = :beds,
        baths = :baths,
        sqft = :sqft,
        type_id = :type_id,
        propstat_id = :propstat_id,
        income_requirement = :income_requirement,
        credit_requirement = :credit_requirement,
        rental_fee = :rental_fee,
        description = :description 
    WHERE property_id = :property_id  ";
    $statement = $db->prepare($sql);
    $statement->bindValue(':property_id', $property_id);
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

    $result = $statement->execute();
    $statement->closeCursor();
    if (empty($result)) {
        $result = false;
    } else {
        return getPropertyById($id);
    }
    
}

function createLandlordPropertyRelationship($landlord_id, $property_id)
{
    global $db;
    $sql = 'INSERT INTO `landlord_property`(`landlord_id`, `property_id`) VALUES (:landlord_id, :property_id)';
    $statement = $db->prepare($sql);
    $statement->bindValue(':landlord_id', $landlord_id);
    $statement->bindValue(':property_id', $property_id);
    $result = $statement->execute();
    $statement->closeCursor();
    if (empty($result)) {
        $result = false;
    } else {
        return true;
    }
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


function getPropertyTypes() {
        //returns an array of rental_application
        global $db;
        $statement = $db->prepare('select * '
            . ' from property_type');
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        $statement->closeCursor();
        return $result;
}

function getPropertyStatus() {
    //returns an array of rental_application
    global $db;
    $statement = $db->prepare('select * '
            . ' from property_status');
    $statement->execute();
    $result = $statement->fetchAll(PDO::FETCH_ASSOC);
    $statement->closeCursor();
    return $result;
}
?>