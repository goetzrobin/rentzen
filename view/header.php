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
      var current_id;
      var element_opened_modal;
        $('#notification__badge').hide();
        $('.modal-btn__optional').hide();
        
        $('#addPropertyModal').on('show.bs.modal', function (event) {

          var states_option_html = "<option selected>Choose...</option>";
          $.getJSON('http://localhost/rentzen/services/index.php?type=get_states').done( (states) => {
            for(var i=0; i < states.length; i++){
              var current_state = states[i];
              states_option_html += ('<option value="'+current_state['state_id']+'">'+current_state['state_name']+"</option>");
            }

            $('#inputState').html(states_option_html);

          });

          var type_option_html = "<option selected>Choose...</option>";
          $.getJSON('http://localhost/rentzen/services/index.php?type=get_property_type').done( (types) => {
            for(var i=0; i < types.length; i++){
              var current_type = types[i];
              type_option_html += ('<option value="'+current_type['propertytype_id']+'">'+current_type['typename']+"</option>");
            }
            console.log(type_option_html);
            $('#type').html(type_option_html);

          });

          var status_option_html = "<option selected>Choose...</option>";
          $.getJSON('http://localhost/rentzen/services/index.php?type=get_property_status').done( (status) => {
            for(var i=0; i < status.length; i++){
              var current_status = status[i];
              status_option_html += ('<option value="'+current_status['propstat_id']+'">'+current_status['propertystat']+"</option>");
            }
            console.log(status_option_html);
            $('#status').html(status_option_html);

          });

          
        });
        $('#addPropertyModal .btn-primary').click((event) => {
          $form = $('#addPropertyModal form');
          event.preventDefault();
          console.log($form.serializeArray());
        });


        $('#removeFromMarketModal').on('show.bs.modal', function (event) {
          element_opened_modal = $(event.relatedTarget);
          var prop_id  = element_opened_modal.data('id');
          current_id = prop_id;
        });
        $('#removeFromMarketModal .btn-primary').click((event) => {
          $.getJSON('http://localhost/rentzen/services/index.php?type=set_property_status_occupied&prop_id='+current_id).done( (response) => {
            console.log('reloading data necessary');
            $('#removeFromMarketModal').modal('hide');
          });
        });
        
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


<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Delete Property</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Are you sure you want to delete this property?
        <br>
        This step cannot be undone.
      </div>
      <div class="modal-footer">
      <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-primary red modal-btn">Delete Property</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="removeFromMarketModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Remove Property</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Are you sure you want to remove this property from the market?
      </div>
      <div class="modal-footer">
      <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-primary red modal-btn">Remove Property</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="addPropertyModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div style="min-width: 60%;" class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Property</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form>
          
          <div class="form-group">
            <label for="inputAddress">Address</label>
            <input type="text" class="form-control" id="inputAddress" name="inputAddress" placeholder="1234 Main St">
          </div>
          <div class="form-group">
            <label for="inputAddress2">Address 2</label>
            <input type="text" class="form-control" id="inputAddress2" name="inputAddress2" placeholder="Apartment, studio, or floor">
          </div>
          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="inputCity">City</label>
              <input type="text" class="form-control" id="inputCity" nameinputCity">
            </div>
            <div class="form-group col-md-4">
              <label for="inputState">State</label>
              <select id="inputState" name="inputState" class="form-control">
              </select>
            </div>
            <div class="form-group col-md-2">
              <label for="inputZip">Zip</label>
              <input type="text" class="form-control" id="inputZip" nameinputZip">
            </div>
          </div>


          <div class="form-row">
            <div class="form-group col-sm-3">
              <label for="beds">Beds</label>
              <input type="number" class="form-control" id="beds" name="beds" min='0' value='0'>
            </div>
            <div class="form-group col-sm-3">
              <label for="baths">Baths</label>
              <input type="number" class="form-control" id="baths" name="baths" min='0' value='0' step='0.5'>
            </div>
            <div class="form-group col-sm-3">
              <label for="sqft">Square Feet</label>
              <input type="number" class="form-control" id="sqft" name="sqft"  min='0' value='0'>
            </div>
            <div class="form-group col-sm-3">
            <label for="type">Type</label>
              <select id="type" name="type" class="form-control">
                <option selected>Choose...</option>
                <option>...</option>
              </select>   </div>
          </div>

           <div class="form-row">
            <div class="form-group col-sm-3">
            <label for="status">Status</label>
              <select id="status" name="status" class="form-control">
                <option selected>Choose...</option>
                <option>...</option>
              </select>
            </div>
            <div class="form-group col-sm-3">
              <label for="income_req">Income Requirement</label>
              <input type="number" class="form-control" id="income_req" name="income_req" min='0' value='0' step='0.01'>
            </div>
            <div class="form-group col-sm-3">
              <label for="credit_score">Credit Score</label>
                <input type="number" class="form-control" id="credit_score" name="credit_score" min='0' max='800' value='0' step='1'>
            </div>
            <div class="form-group col-sm-3">
              <label for="rental_fee">Rental Fee</label>
              <input type="number" class="form-control" id="rental_fee" name="rental_fee" min='0' value='0' step='0.01'>
            </div>
          </div>

            <div class="form-group">
              <label for="exampleFormControlTextarea1">Description</label>
              <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
            </div>

          
      </div>
      <div class="modal-footer">
      <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <button type="submit" class="btn btn-primary red modal-btn">Submit</button>
      </div>
      </form>
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