<?php

/* for development purposes only */
/* Test model functions here. */

//before I can do anything, I need database credentials
include '../common/configuration.php';

// before I can use the model functions, I need a database connection
include 'database.php';

function echoArr($arr)
{
    echo '<pre>';
    print_r($arr);
    echo '</pre>';
}


include '../view/header.php';
echo "<div class='container'>";

// ***********************************************************
// the feature model
include 'feature_db.php';
echo '<h1>Testting the feature functions ... </h1>';

echo '<br><br> Get All Feature Test <br><br>';
echoArr(getFeature());

echo '<br><br> Get Feature By Id Test <br><br>';
echoArr(getFeatureById(201));

echo '<br><br> Insert Feature Test <br><br>';
echoArr(
    insertFeature(
        "Rooftop Access",
        "You can get on the roof",
        NULL
    ));

echo '<br><br> Update Feature <br><br>';

echoArr(updateFeature(205,'description','Description Changed'));

echo '<br><br> Delete Feature By Id Test <br><br>';
echoArr(deleteFeatureById(205));


// ***********************************************************
// the people model
include 'people_db.php';
echo '<h1>Testting the people functions ... </h1>';

echo '<h5>Login Test</h5>';
echo "Login should succeed: " . (loginPeople('esmith@email.com', 'esmith123', 101) == true ? "Success" : "FAIL");
echo '<br>';
echo "Login should fail: " . (loginPeople('esmith@email.com', 'esmith123', 102) == true ? "Success" : "FAIL");


echo '<br><br> Get All People Test <br><br>';
echoArr(getPeople());

echo '<br><br> Get People By Id Test <br><br>';
echoArr(getPeopleById(902));

echo '<br><br> Insert People Test <br><br>';
echoArr(
    insertPeople(
        "disdidsiom",
        "esmith@email.com",
        "esmith123",
        "Emily",
        "Smith",
        2677462000,
        "1234 Elm Ave.",
        "Marlton",
        30,
        "8053",
        101,
        670,
        120888
    ));

echo '<br><br> Delete People By Id Test <br><br>';
// echoArr(deletePeopleById(931));


// ***********************************************************
// the property model
include 'property_db.php';
echo '<h1>Testting the property functions ... </h1>';

echo '<p>Get Properties</p>';
echoArr(getProperties());

echo '<p>Get Properties By Landloard ID</p>';
echoArr(getPropertiesByLandlordId(902));


echo '<p>Get Landlords By Property ID</p>';
echoArr(getLandlordsByPropertyId(321));


echo '<p>Get Prop by Id</p>';
echoArr(getPropertyById(301));

echo '<p>Update Property</p>';
echoArr(updateProperty(301, "city", "Birdtown"));

echo '<p>Insert Property</p>';
echoArr(insertProperty('123 N Broad', "Philadelphia", 38, 19145, 2, 1.5, 1100, 504, 403, 60000, 750, 1300, "Hello to Walnut", "../images/walnut.jpg"));


// ***********************************************************
// the rental_app model

include 'rental_app_db.php';
echo '<h1>Testing the rental_app functions ... </h1>';

echo '<p>Get All Applications</p>';
echoArr(getRentalApp());

echo '<p>Get App. By Id</p>';
echoArr(getRentalAppById(10));

echo '<p>Get Apps By Status Id</p>';
echoArr(getRentalAppByStatusId(4));

echo '<p>Insert Property Renter Relationship</p>';
echoArr(insertRentalApp(4,"2018-05-18",NULL,"testing"));

echo '<p>Update Property Renter Relationship</p>';
echoArr(updateRentalApp(12,'last_status_id',2));

echo '<p>Delete Property Renter Relationship</p>';
// echoArr(deleteRentalApp(10));


// ***********************************************************
// the renter_prop model

include 'renter_property_db.php';
echo '<h1>Testing the renter_property functions ... </h1>';


echo '<p>Get All Relationships</p>';
echoArr(getRenterPropertyRelationships());

echo '<p>Get Rel. By Id</p>';
echoArr(getRenterPropertyById(10));

echo '<p>Get Renters By Prop. Id</p>';
echoArr(getRentersByPropertyId(307));


echo '<p>Get Properties By Renter. Id</p>';
echoArr(getPropertiesByRenterId(909));


echo '<p>Insert Property Renter Relationship</p>';
echoArr(insertRenterProperty(909,308,23));

echo '<p>Update Property Renter Relationship</p>';
echoArr(updateRenterProperty(30,'renter_match_score',5.5));

echo '<p>Delete Property Renter Relationship</p>';
// echoArr(deleteRenterPropertyById(31));

echo '</div>';
include '../view/footer.php';
?>
