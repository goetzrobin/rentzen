<?php

/* for development purposes only */
/* Test model functions here. */

//before I can do anything, I need database credentials
include '../common/configuration.php';

// before I can use the model functions, I need a database connection
include 'database.php';

function echoArr($arr)
{
    echo '<pre style="max-height: 500px; overflow: scroll;">';
    print_r($arr);
    echo '</pre>';
}


include '../view/header.php';

echo "<a href='#' style='position: fixed; right: 20px; bottom: 20px; '><button class='btn'>Up</button></a>";
echo "<div class='container'>";
echo "<h1>Model Test Page</h1>";
echo '<nav>
        <a href="'.$base_path.'">Home</a>
        <a href="#feature">Feature functions</a>
        <a href="#people">People functions</a>
        <a href="#prop">Property functions</a>
        <a href="#rentapp">Rental Application functions</a>
        <a href="#rentprop">Renter Property functions</a>
                </nav>';


// ***********************************************************
// the feature model
include 'feature_db.php';
echo '<h1 id="feature">Testing the feature functions ... </h1>';

echo '<h4> Get All Feature Test </h4>';
echoArr(getFeature());

echo '<h4> Get Feature By Id Test (Id is 201) </h4>';
echoArr(getFeatureById(201));

echo '<h4> Insert Feature Test (returns inserted feature) </h4>';
echoArr(
    insertFeature(
        "Rooftop Access",
        "You can get on the roof",
        NULL
    ));

echo '<h4> Update Feature (return updated feature) </h4>';

echoArr(updateFeature(201,'description','Description Change'));

echo '<h4> Delete Feature By Id Test </h4>';
// echoArr(deleteFeatureById(205));


// ***********************************************************
// the people model
include 'people_db.php';
echo '<h1 id="people">Testing the people functions ... </h1>';

echo '<h5>Login Test</h5>';
$result = loginPeople('esmith@email.com', 'esmith123');
echo "Login should succeed: ";
if ($result == true) { print_r($result); } else {echo ("FAIL"); }
echo '<br>';
echo "Login should fail: " . (loginPeople('esmith@email.com', 'esmith3') == true ? "Success" : "FAIL");


echo '<h4> Get All People Test </h4>';
echoArr(getPeople());

echo '<h4> Get People By Id Test (902) </h4>';
echoArr(getPeopleById(902));

echo '<h4> Insert People Test </h4>';
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

echo '<h4> Update People (902 set firstname to Tester) </h4>';

echoArr(updatePeople(902,'firstname','Tester'));

updatePeople(902,'firstname','James');

echo '<h4> Delete People By Id Test </h4>';
// echoArr(deletePeopleById(931));


// ***********************************************************
// the property model
include 'property_db.php';
echo '<h1 id="prop">Testing the property functions ... </h1>';

echo '<p>Get Properties By Params</p>';
$params =     array(
    'state_id' => 38,
    'type_id' => 504, 
    'status_id' => 403, 
    'sqft_low' => 1100,
    'sqft_high' => 1400, 
    'credit_requirement_low' => 700,
    'rental_fee_low' => 1500 ,
);
echo '<h4>Search Parameters</h4>';

echoArr($params);

echoArr(getPropertiesBySearchParams($params));

echo '<p>Get Properties</p>';
echoArr(getProperties());

echo '<p>Get Properties By Landloard ID 902</p>';
echoArr(getPropertiesByLandlordId(902));


echo '<p>Get Landlords By Property ID 321</p>';
echoArr(getLandlordsByPropertyId(321));


echo '<p>Get Prop by Id 301</p>';
echoArr(getPropertyById(301));

echo '<p>Update Property (301 city to Birdtown)</p>';
echoArr(updateProperty(301, "city", "Birdtown"));

echoArr(updateProperty(301, "city", "Philadelphia"));

echo '<p>Insert Property</p>';
echoArr(insertProperty('123 N Broad', "Philadelphia", 38, 19145, 2, 1.5, 1100, 504, 403, 60000, 750, 1300, "Hello to Walnut", "../images/walnut.jpg"));


// ***********************************************************
// the rental_app model

include 'rental_app_db.php';
echo '<h1 id="rentapp">Testing the rental_app functions ... </h1>';

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
echo '<h1 id="rentprop">Testing the renter_property functions ... </h1>';


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
