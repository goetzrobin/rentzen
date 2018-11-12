<?php include '../common/configuration.php';
if ((int)$_SESSION['ROLE_ID'] !== ROLE_ID_RENTER) {
  header("Location: " . $base_path);
}
?>
<?php include '../view/header.php' ?>
<link href="./css/renter_profile.css" rel="stylesheet">

    <div class='container-fluid'>
        <div class='phila_bg'>
        <div class='profile_header row justify-content-center'>
        <img class="rounded-circle" src="../user_data/people/profile_picture_1.png" alt="Generic placeholder image" width="140" height="140">
            <h1><?php echo $profile_data['firstname'].' '.$profile_data['lastname']; ?></h1>
        </div>
        </div>
        <div class='row'>
        <div class='col-6 d-flex justify-content-center align-items-center'>
            <div class='w-100 shadow-sm p-3 bg-white rounded m-1'>
                <h1>Contact</h1>
                <div><i class="fas fa-phone mr-1"></i><?php echo $profile_data['phone']; ?></div>
                <div><i class="fas fa-envelope mr-1"></i><?php echo $profile_data['username']; ?></div>
            </div>
        </div>
        <div class='col-6 d-flex justify-content-center align-items-center'>
            <div class='w-100 shadow-sm p-3 bg-white rounded m-1'>
                <h1>Address</h1>
                <div><?php echo $profile_data['street']; ?></div>
                <div><?php echo $profile_data['zip']; ?> <?php echo $profile_data['city']; ?>, <?php echo $profile_data['state_name']; ?></div>
            </div>
        </div>
        <div class='col-12 d-flex justify-content-center align-items-center'>
            <div class='w-100 shadow-sm p-3 bg-white rounded m-1'>
                <h1>Financial Information</h1>
                <div>Credit Rating: <?php echo $profile_data['credit_rating']; ?></div>
                <div>Income: $<?php echo number_format($profile_data['income'],2); ?></div>
            </div>
        </div>
        </div>
    </div>
<?php include '../view/footer.php' ?>
