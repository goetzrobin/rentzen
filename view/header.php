<!DOCTYPE html>
<html>
<head>
    <title>RentZen</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="<?php echo $base_path;?>/main.css"/>
    </head>

<body>
    <main>
<?php 
    if( isset($_SESSION['LOGGED_IN']) && $_SESSION['LOGGED_IN']=='OK'){
        include 'navigation.php';
    } 
?>