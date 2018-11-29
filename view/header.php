<!DOCTYPE html>
<html lang='en'>
<head>
    <title>RentZen</title>
    
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="../main.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.bundle.min.js"></script>
    
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
   
    <link rel="stylesheet" type="text/css" href="<?php echo $base_path; ?>/main.css"/>
  
  <style>   
            .navbar-nav li {
            margin: 0 20px;
        }
    </style>
    </head>
    <script>
    $('#notification__badge').hide();
    $('.modal-btn__optional').hide();
    </script>
<body>
    <!-- Button trigger modal -->
<div id='notification__badge' class='d-none' style='display: flex; justify-content: center; align-items: center; background-color: #8E0000; display: block; position: fixed; z-index: 99; bottom: 10px; right: 10px; padding: 10px 20px;
        border-radius: 4px;
        border: 1px #8E0000 solid;
        color: white;'><i class="fas fa-bell"></i> <span id='notification__text' class='ml-1'>Appartment added to favorites</span></div>



<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div style="min-width: 60%;" class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Loading...</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="spinner"></div>
      </div>
      <div class="modal-footer d-flex justify-content-around">
      <button style='max-width: 33%' type="button" class="btn btn-secondary" data-dismiss="modal"><i class="far fa-window-close"></i></button>
      <button style='max-width: 33%' type="button" class="btn btn-secondary modal-btn__optional" data-dismiss="modal"><i class="far fa-save"></i></button>
        <button style='max-width: 33%' type="button" class="btn btn-primary red modal-btn"><i class="far fa-check-circle"></i></button>
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

<div class="modal fade" id="approveApplicationModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Approve Application</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Are you sure you want to approve this application?
      </div>
      <div class="modal-footer">
      <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-primary red modal-btn">Approve Application</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="rejectApplicationModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Reject Application</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Are you sure you want to reject this application?
      </div>
      <div class="modal-footer">
      <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-primary red modal-btn">Reject Application</button>
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
      <form novalidate id='add_form'>
        <div class="modal-body">
            <div class="form-group">
              <label for="addinputAddress">Address</label>
              <input type="text" class="form-control" id="addinputAddress" name="inputAddress" placeholder="1234 Main St">
              <div class='invalid-feedback'>Plese enter an Address.</div>
            </div>
            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="inputCity">City</label>
                <input type="text" class="form-control" id="inputCity" name="inputCity">
                <div class='invalid-feedback'>Test</div>
              </div>
              <div class="form-group col-md-4">
                <label for="inputState">State</label>
                <select id="inputState" name="inputState" class="form-control">
                </select>
                <div class='invalid-feedback'>Choose a State.</div>
              </div>
              <div class="form-group col-md-2">
                <label for="inputZip">Zip</label>
                <input type="text" class="form-control" id="inputZip" name="inputZip">
                <div class='invalid-feedback'>Test</div>
              </div>
            </div>


            <div class="form-row">
              <div class="form-group col-sm-3">
                <label for="beds">Beds</label>
                <input type="number" class="form-control" id="beds" name="beds" min='0' value='0'>
                <div class='invalid-feedback'>Test</div>
              </div>
              <div class="form-group col-sm-3">
                <label for="baths">Baths</label>
                <input type="number" class="form-control" id="baths" name="baths" min='0' value='0' step='0.5'>
                <div class='invalid-feedback'>Test</div>
              </div>
              <div class="form-group col-sm-3">
                <label for="sqft">Square Feet</label>
                <input type="number" class="form-control" id="sqft" name="sqft"  min='0' value='0'>
                <div class='invalid-feedback'>Test</div>
              </div>
              <div class="form-group col-sm-3">
                <label for="type">Type</label>
                  <select id="type" name="type" class="form-control">
                    <option selected>Choose...</option>
                    <option>...</option>
                  </select>
                  <div class='invalid-feedback'>Test</div>
              </div>
            </div>

            <div class="form-row">
              <div class="form-group col-sm-3">
                <label for="status">Status</label>
                <select id="status" name="status" class="form-control">
                  <option selected>Choose...</option>
                  <option>...</option>
                </select>
                <div class='invalid-feedback'>Test</div>
              </div>
              <div class="form-group col-sm-3">
                <label for="income_req">Income Req.</label>
                <input type="number" class="form-control" id="income_req" name="income_req" min='0' value='0' step='0.01'>
                <div class='invalid-feedback'>Test</div>
              </div>
              <div class="form-group col-sm-3">
                <label for="credit_score">Credit Score</label>
                  <input type="number" class="form-control" id="credit_score" name="credit_score" min='300' max='850' value='300' step='1'>
                  <div class='invalid-feedback'>Test</div>
              </div>
              <div class="form-group col-sm-3">
                <label for="rental_fee">Rental Fee</label>
                <input type="number" class="form-control" id="rental_fee" name="rental_fee" min='0' value='0' step='0.01'>
                <div class='invalid-feedback'>Test</div>
              </div>
            </div>

              <div class="form-group">
                <label for="description">Description</label>
                <textarea class="form-control" id="description" name='description' rows="3"></textarea>
                <div class='invalid-feedback'>Test</div>
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

<div class="modal fade" id="editPropertyModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div style="min-width: 60%;" class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Property</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form novalidate id='edit_form'>
      <div class="modal-body">
          <input type="hidden" id='edit_property_id' name="property_id" type='number'>
                <div class="form-group">
                  <label for="edit_inputAddress">Address</label>
                  <input type="text" class="form-control" id="edit_inputAddress" name="inputAddress" placeholder="1234 Main St">
                  <div class='invalid-feedback'>Please provide an address</div>
                </div>
          <div class="form-row">
                  <div class="form-group col-md-6">
                    <label for="edit_inputCity">City</label>
                    <input type="text" class="form-control" id="edit_inputCity" name="inputCity">
                    <div class='invalid-feedback'>Test</div>
                    <div class='invalid-feedback'>Test</div>
                  </div>
              <div class="form-group col-md-4">
                <label for="edit_inputState">State</label>
                <select id="edit_inputState" name="inputState" class="form-control">
                  <div class='invalid-feedback'>Test</div>
                </select>
              </div>
            <div class="form-group col-md-2">
              <label for="edit_inputZip">Zip</label>
              <input type="text" class="form-control" id="edit_inputZip" name="inputZip">
              <div class='invalid-feedback'>Test</div>
            </div>
          </div>


          <div class="form-row">
            <div class="form-group col-sm-3">
              <label for="edit_beds">Beds</label>
              <input type="number" class="form-control" id="edit_beds" name="beds" min='0' value='0'>
              <div class='invalid-feedback'>Test</div>
            </div>
            <div class="form-group col-sm-3">
              <label for="edit_baths">Baths</label>
              <input type="number" class="form-control" id="edit_baths" name="baths" min='0' value='0' step='0.5'>
              <div class='invalid-feedback'>Test</div>
            </div>
            <div class="form-group col-sm-3">
              <label for="edit_sqft">Square Feet</label>
              <input type="number" class="form-control" id="edit_sqft" name="sqft"  min='0' value='0'>
              <div class='invalid-feedback'>Test</div>
            </div>
            <div class="form-group col-sm-3">
                <label for="edit_type">Type</label>
                  <select id="edit_type" name="type" class="form-control">
                    <option selected>Choose...</option>
                    <option>...</option>
                  </select> 
                  <div class='invalid-feedback'>Test</div>  
            </div>
          </div>

           <div class="form-row">
            <div class="form-group col-sm-3">
            <label for="edit_status">Status</label>
              <select id="edit_status" name="status" class="form-control">
                <option selected>Choose...</option>
                <option>...</option>
              </select>
              <div class='invalid-feedback'>Test</div>
            </div>
            <div class="form-group col-sm-3">
              <label for="edit_income_req">Income Req.</label>
              <input type="number" class="form-control" id="edit_income_req" name="income_req" min='0' value='0' step='0.01'>
              <div class='invalid-feedback'>Test</div>
            </div>
            <div class="form-group col-sm-3">
              <label for="edit_credit_score">Credit Score</label>
                <input type="number" class="form-control" id="edit_credit_score" name="credit_score" min='0' max='800' value='0' step='1'>
                <div class='invalid-feedback'>Test</div>
            </div>
            <div class="form-group col-sm-3">
              <label for="edit_rental_fee">Rental Fee</label>
              <input type="number" class="form-control" id="edit_rental_fee" name="rental_fee" min='0' value='0' step='0.01'>
              <div class='invalid-feedback'>Test</div>
            </div>
          </div>

            <div class="form-group">
              <label for="edit_description">Description</label>
              <textarea class="form-control" id="edit_description" name='description' rows="3"></textarea>
              <div class='invalid-feedback'>Test</div>
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
if (isset($_SESSION['LOGGED_IN']) && $_SESSION['LOGGED_IN'] == 'OK' && $_SESSION['ROLE_ID'] == ROLE_ID_RENTER) {
  include 'renter_navigation.php';
} else if (isset($_SESSION['LOGGED_IN']) && $_SESSION['LOGGED_IN'] == 'OK' && $_SESSION['ROLE_ID'] == ROLE_ID_LANDLORD) {
  include 'landlord_navigation.php';
}
?>