<?php include '../common/configuration.php';
    session_start();
    if( (int) $_SESSION['ROLE_ID'] !== ROLE_ID_LANDLORD) {
        header("Location: ".$base_path."/public");
    }
?>
<?php include '../view/header.php' ?>
I am a landlord.
<?php include '../view/footer.php' ?>