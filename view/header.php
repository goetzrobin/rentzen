<!DOCTYPE html>
<html>
<head>
    <title>RentZen</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    
    <link rel="stylesheet" type="text/css" href="<?php echo $base_path;?>/main.css"/>
    <style>   
            .navbar-nav li {
            margin: 0 20px;
        }
    </style>
    </head>

<body>
    <main>
<?php 
    if( isset($_SESSION['LOGGED_IN']) && $_SESSION['LOGGED_IN']=='OK' && $_SESSION['ROLE_ID'] == ROLE_ID_RENTER ){
        include 'renter_navigation.php';
    } 
    else if( isset($_SESSION['LOGGED_IN']) && $_SESSION['LOGGED_IN']=='OK' && $_SESSION['ROLE_ID'] == ROLE_ID_LANDLORD ){
        include 'landlord_navigation.php';
    }
?>