<?php require_once '../common/configuration.php';?>
<?php require_once "../model/database.php"; ?>
<?php require_once "../model/people_db.php"; ?>
<?php require_once "../model/renter_property_db.php"; ?>
<?php

$message = "";
$state = getState();

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
        $_SESSION['FIRSTNAME'] = $login_data['firstname'];

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

// if (isset($_POST['signin_button']) )
// {
//     $email = filter_input(INPUT_POST,'email');
//     $password = filter_input(INPUT_POST,'password');
   


//     $inserted_user = insertPeople();


//     if($role_id ==  ROLE_ID_RENTER ) // tenant
//     {
//         header('Location: ../renter/index.php');
//         exit();
//     }
//     if($role_id == ROLE_ID_LANDLORD ) 
//     {
//         header('Location: ../landlord/index.php');
//         exit();
//     } else {
//         $message = "Login failed. Please try again.";
//         include 'public_sign_up.php';
//         exit();
//     }

// }

//validate Sign up page

if (isset($_POST['SignUp'])) {

    $firstname = filter_input(INPUT_POST, "firstname");
    $lastname = filter_input(INPUT_POST, "lastname");
    $email= filter_input(INPUT_POST, "email", FILTER_VALIDATE_EMAIL);
    $password = filter_input(INPUT_POST, "password");
    $phone = filter_input(INPUT_POST, "phone", FILTER_VALIDATE_INT);
    $street = filter_input(INPUT_POST, "street");
    $city = filter_input(INPUT_POST, "city");
    $state_id = filter_input(INPUT_POST, "state_id", FILTER_VALIDATE_INT);
    $zip = filter_input(INPUT_POST, "zip");
    $role_id = filter_input(INPUT_POST, "role_id");
    $credit_rating = filter_input(INPUT_POST, "credit_rating", FILTER_VALIDATE_INT);
    $income = filter_input(INPUT_POST, "income", FILTER_VALIDATE_FLOAT);


    if (empty($firstname)  || empty($lastname) || empty($email)  || empty($password)  || empty($phone) 
    || empty($city)|| empty($street) || empty($state_id)  || empty($zip)  || empty($role_id)  || empty($credit_rating) || empty($income)){
        $message = "One or more required fields are missing.";
        include 'public_sign_up.php'; //something is empty, go back to sign up page
        exit();
    } else
    {
        //use email twice because username and email are the same
        $confirmation = insertPeople($email,$email,$password,$firstname,$lastname,
        $phone,$street,$city,$state_id,$zip,$role_id,$credit_rating,$income);

        if ($confirmation !== false)
            {
            include 'public_sign_in.php';
            exit();
            } else {
            $message = "An unexpected error occurred.";
            include 'public_sign_up.php';
            exit();
            }
        
    }
}

//if all else fails
include 'public_landing_page.php';
exit();

?>