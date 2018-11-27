<?php
    //this is for the database
    // $dsn = 'mysql:host=localhost;dbname=db_fall105';
    // $username = 'fall105';
    // $password = 'XO464841';

    $dsn = 'mysql:host=localhost;dbname=rentzen';
    $username = 'rentzen';
    $password = 'rentzen123';
    
    //this path can be used in place of relative references in HTML
    // $base_path = 'http://misdemo.temple.edu/fall105/rentzen';

    $base_path = 'http://localhost/rentzen';

    if (!defined('ROLE_ID_RENTER')) define('ROLE_ID_RENTER', 101);
    if (!defined('ROLE_ID_LANDLORD')) define('ROLE_ID_LANDLORD', 102);
?>
