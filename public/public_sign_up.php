<?php include '../common/configuration.php' ?>
<?php include '../view/header.php' ?>


<script>
"use strict";

var getTheStates = function(){
  $.getJSON("https://misdemo.temple.edu/states/",function(data){
    $("#list_of_states").html('');
  });
}

var isEmail = function(email) {
  var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
  return regex.test(email);
}
var validate = function (theForm){

  var result = true;

  // $('#message').html("<div class='invalid-feedback'><ul></ul></div>");
  
  if (theForm.email.value == "" || !isEmail(theForm.email.value))
  {
    $('#email').addClass('is-invalid');
    result=false;
  } else {
    $('#email').removeClass('is-invalid'); 
    result=true;
  }

   if (theForm.password.value == "")
   {
    $('#password').addClass('is-invalid');
    result=false;
  } else {
    $('#password').removeClass('is-invalid'); 
  }

   if (theForm.firstname.value == "")
  {
    $('#firstname').addClass('is-invalid');
    result=false;
  }else {
    $('#firstname').removeClass('is-invalid'); 
    result=true;
  }

   if (theForm.lastname.value == "")
  {
    $('#lastname').addClass('is-invalid');
    result=false;
  }else {
    $('#lastname').removeClass('is-invalid'); 
    result=true;
  }
  
   if (theForm.phone.value == "")
  {
    $('#phone').addClass('is-invalid');
    result=false;
  }else {
    $('#phone').removeClass('is-invalid'); 
    result=true;
  }

   if (theForm.city.value == "")
   {
    $('#city').addClass('is-invalid');
    result=false;
  }else {
    $('#city').removeClass('is-invalid'); 
    result=true;
  }

   if (theForm.state.value == "")
   {
    $('#state').addClass('is-invalid');
    result=false;
  }else {
    $('#state').removeClass('is-invalid'); 
    result=true;
  }

   if (theForm.zip.value == "")
   {
    $('#zip').addClass('is-invalid');
    result=false;
  }else {
    $('#zip').removeClass('is-invalid'); 
    result=true;
  }

   if (theForm.role_id.value == "100")
   {
    $('#role_id').addClass('is-invalid');
    result=false;
  }else {
    $('#role_id').removeClass('is-invalid'); 
    result=true;
  }

   if (theForm.creditrating.value == "")
   {
    $('#creditrating').addClass('is-invalid');
    result=false;
  }else {
    $('#creditrating').removeClass('is-invalid'); 
    result=true;
  }

   if (theForm.income.value == "")
   {
    $('#income').addClass('is-invalid');
    result=false;
  }else {
    $('#income').removeClass('is-invalid');
    result=true; 
  }

  return result;
};

$(document).ready(function(){
   $('#signup_form').submit(function(event){
     event.preventDefault();
     if(validate(this)){
      event.submit();
     };
   });

   var url = base_path + "services/index.php?type=get_states";
   $.getJSON(url,function(states){
    var state_html = `<option value="">Choose one...</option>`;
     $.each(states,function(indexInArray, state_data){
      state_html += (`<option value='`+state_data.state_id+`'>`+state_data.state_name+`</option>`);
     });
     $('#state_id').html(state_html);
   });
 }); 

</script>

<link href="./css/public_sign_up.css" rel="stylesheet">

<div class="container">
<form novalidate id='signup_form' method='post' action='index.php'> 
      <div class="py-5 text-center">
        <a href="<?php echo $base_path; ?>"><img class="d-block mx-auto mb-4" src="<?php echo $base_path; ?>/images/rentzen_logo.svg" alt="RentZen Logo" width="72" height="72"></a>
        <h2>Sign Up Form</h2>
        <p class="lead">
          Sign up below and join the RentZen Community. Whether you are a renter or a landlord, RentZen will 
          take the stress out of your property search. Sit back and relax. Your perfect match is out there.
          <br>
          <small><a href="<?php echo $base_path; ?>/public/index.php?sign_in">Already have an account? Sign in here.</a></small>
        </p>
      </div>

        <div class="col-md-4 order-md-2 mb-4"></div>

        <div class="col-md-8 order-md-1">
          <h4 class="mb-3">Personal Information</h4>
          
              <div class="row">

                    <div class="col-md-6 mb-3">
                      <div class="form-group">
                        <label for="email">Email <span class="text-muted"></span></label>
                        <input type="email" name="email" class="form-control" id="email" placeholder="you@example.com" required>
                        <div class="invalid-feedback">
                          Please enter a valid email address for to sign up.
                        </div>
                      </div> <!-- end input grou -->
                    </div> <!-- end email -->
                
                    <!-- <div class="col-md-4 mb-3">
                      <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" name="username" class="form-control" id="username" placeholder="Username" required>
                        <div class="invalid-feedback" style="width: 100%;">
                            Your username is required.</div>
                      </div> <!-- end input group -->
                    <!-- </div> end username -->

                    <div class="col-md-6 mb-3">
                      <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" name="password" class="form-control" id="password" placeholder="Password" required>
                            <div class="invalid-feedback" style="width: 100%;">
                            Your Password is required.
                            </div>
                      </div> <!-- end input group -->
                    </div> <!-- end password -->

              </div>   <!-- end row 1 --> 
             
              <div class='row'>

                <div class="col-md-6 mb-3">
                  <div class="form-group">
                    <label for="firstname">First name</label>
                    <input type="text" name="firstname" class="form-control" id="firstname" placeholder="" value="" required>
                    <div class="invalid-feedback">
                      Valid first name is required.
                    </div>
                  </div> <!-- end input group -->
                </div> <!-- end firstname -->

                <div class="col-md-6 mb-3">
                  <div class="form-group">
                    <label for="lastname">Last name</label>
                    <input type="text" name="lastname" class="form-control" id="lastname" placeholder="" value="" required>
                    <div class="invalid-feedback">
                      Valid last name is required.
                    </div>
                  </div> <!-- end input group -->
                </div> <!-- end last name -->
                
              </div> <!-- end row 2 -->

               
            
            <div class='row'>

               <div class="col-md-6 mb-3">
                  <div class='form-group'>
                    <label for="phone">Phone</label>
                    <input type="tel" name="phone" class="form-control" id="phone"  
                    placeholder="123-456-7890" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" required>
                    <div class="invalid-feedback">
                      Please enter your phone number.
                    </div>
                  </div>
                </div> <!-- phone group -->
                
                  <div class="col-md-6 mb-3">
                    <div class='form-group'>
                    <label for="role_id">Role</label>
                    <select type="select" name="role_id" class="form-control" id="role_id"  required>
                    <option value="100">Choose one</option>
                        <option value="101">Renter</option>
                        <option value="102">Owner</option>
                    </select>
                    <div class="invalid-feedback">
                      Role required.
                    </div>
                    </div>
                </div> 
</div>
              <div class='row'>
                <div class="col-md-6 mb-3">
                  <div class='form-group'>
                  <label for="credit_rating">Credit Rating</label>
                  <input type="number" min='300' max='850' value='300' step='1' name="credit_rating" class="form-control" id="credit_rating" placeholder="" required>
                  <div class="invalid-feedback">
                    Credit Rating code required.
                  </div>
                  </div>
                </div> 

                 <div class="col-md-6 mb-3">
                  <label for="income">Income</label>
                  <input type="number" min="0" step="0.01" value='0' name="income" class="form-control" id="income" required>
                  <div class="invalid-feedback">
                    Income required.
                  </div>
                </div>   <!-- end income --> 
            </div>
            <div class='row'>

                <div class="col-md-12 mb-3">
                  <div class='form-group'>
                    <label for="street">Street</label>
                    <input type="text" name="street" class="form-control" id="street" placeholder="1234 Main St" required>
                    <div class="invalid-feedback">
                      Please enter your address.
                    </div>
                  </div>
                </div> <!-- end street -->
              
            </div>

            <div class='row'>
              <div class="col-md-6 mb-3">
                <div class='form-group'>
                  <label for="city">City</label>
                  <input type="text" name="city" class="form-control" id="city" placeholder="Hometown" required>
                  <div class="invalid-feedback">
                    Please enter your shipping address.
                  </div>
                </div>
              </div> <!-- end city -->

              <div class="col-md-3 mb-3">
                <label for="state_id">State</label>
                <select name="state_id" class="custom-select d-block w-100" id="state_id" required>
                </select>
                <div class="invalid-feedback">
                  Please provide a valid state.
                </div>
              </div> <!-- end of state -->

              <div class="col-md-3 mb-3">
                <label for="zip">Zip</label>
                <input type="text" name="zip" class="form-control" id="zip" placeholder="12345" required>
                <div class="invalid-feedback">
                  Zip code required.
                </div>
              </div> <!-- end of zip --> 
            </div>

                          <?php if (!empty($message)) {
                            echo '<div class="row"><div class="col-12 mb-3"><div class="error form-control"><small>' . $message . '</small></div></div></div>';
                          } ?>
              <div class='row'>
                <button class="btn btn-primary btn-lg btn-block red" name="SignUp" id="SignUp" value="submit" type="submit">Sign Up</button> 
              </div>
          </div> <!-- end col-8 -->
          </form> <!-- end form -->
        </div> <!-- end container -->
      </div>
    </div>

      <div class="mt-3 py-3 text-muted text-center text-small">
        <p class="mb-1">&copy; 2018 RentZen</p>
        <ul class="list-inline">
          <li class="list-inline-item"><a href="<?php echo $base_path; ?>">Home</a></li>
        </ul>
      </div>
    <?php include '../view/footer.php'; ?>