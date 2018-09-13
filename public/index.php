<?php require_once '../common/configuration.php';?>
<?php require_once "../model/database.php"; ?>
<?php require_once "../model/people_db.php"; ?>
<?php

$message = "";

if (isset($_GET['sign_out'])){
    include '../util/logout.php';
    exit();
}

if (isset($_GET['sign_in']) || isset($_GET['signed_out'])){
    include 'public_sign_in.php';
    exit();
}

if (isset($_GET['sign_up'])){
    include 'public_sign_up.php';
    exit();
}

if (isset($_POST['go_button']) )
{
    $email = filter_input(INPUT_POST,'email');
    $password = filter_input(INPUT_POST,'password');
    $login_data = loginPeople($email, $password);
    if (!empty($login_data)){
        session_start();
        $role_id = $login_data['role_id'];
        $people_id =   $login_data['people_id'];
        $_SESSION['LOGGED_IN']='OK';
        $_SESSION['ROLE_ID']= $role_id;
        $_SESSION['PEOPLE_ID'] = $people_id;
        $_SESSION['USERNAME'] = $email;

        if($role_id ==  ROLE_ID_RENTER ) // tenant
        {
            header('Location: ../renter/index.php');
            exit();
        }
        if($role_id == ROLE_ID_LANDLORD ) 
        {
            header('Location: ../landlord/index.php');
            exit();
        } else {
            $message = "Login failed. Please try again.";
            include 'public_sign_in.php';
            exit();
        }
    } else
    {
        $message = "Login failed. Please try again.";
        include 'public_sign_in.php';
        exit();
    }
} 

//if all else fails
include 'public_landing_page.php';
exit();

?>