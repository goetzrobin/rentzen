<!DOCTYPE html>
<html>
<head>
    <title>RentZen</title>
    
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
   
    <link rel="stylesheet" type="text/css" href="<?php echo $base_path;?>/main.css"/>
  
  <style>   
            .navbar-nav li {
            margin: 0 20px;
        }
    </style>
    </head>
    <script>
    $(function () {
        $('#notification__badge').hide();
        $('.modal-btn__optional').hide();
    });
    </script>
<body>
    <!-- Button trigger modal -->
<div id='notification__badge' style='display: flex; justify-content: center; align-items: center; background-color: #8E0000; display: block; position: fixed; z-index: 99; bottom: 10px; right: 10px; padding: 10px 20px;
        border-radius: 4px;
        border: 1px #8E0000 solid;
        color: white;'><i class="fas fa-bell"></i> <span id='notification__text' class='ml-1'>Appartment added to favorites</span></div>
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div style="min-width: 60%;" class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      <button type="button" class="btn btn-secondary modal-btn__optional" data-dismiss="modal">Save as Draft</button>
        <button type="button" class="btn btn-primary red modal-btn">Save changes</button>
      </div>
    </div>
  </div>
</div>
    <main>
<?php 
    if( isset($_SESSION['LOGGED_IN']) && $_SESSION['LOGGED_IN']=='OK' && $_SESSION['ROLE_ID'] == ROLE_ID_RENTER ){
        include 'renter_navigation.php';
    } 
    else if( isset($_SESSION['LOGGED_IN']) && $_SESSION['LOGGED_IN']=='OK' && $_SESSION['ROLE_ID'] == ROLE_ID_LANDLORD ){
        include 'landlord_navigation.php';
    }
?>