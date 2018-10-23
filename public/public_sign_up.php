<?php include '../common/configuration.php' ?>
<?php include '../view/header.php' ?>


<!-- <script>
"use strict";

var validate = function (event){
  var email = $('#email').val();
  var username = $('#username').val();
  var password = $('#password').val();
  var firstname = $('#firstname').val();
  var lastname = $('#lastname').val();
  var phone = $('#phone').val();
  var city = $('#city').val();
  var state = $('#state').val();
  var zip = $('#zip').val();
  var email = $('#role').val();
  var email = $('#creditrating').val();
  var email = $('#income').val();

  var result = true;

  $('#message').html("<div class='invalid-feedback'><ul></ul></div>");

  var theForm = document.getElementById('SignUpPage');

  if (theForm.email.value=== " ")
  {
    alert("You must provide a email.");
    event.preventDefault();
    result=false;
  }

   if (theForm.username.value=== " ")
  {
    alert("You must provide a Username.");
    event.preventDefault();
    result=false;
  }

   if (theForm.password.value=== " ")
  {
    alert("You must provide a password.");
    event.preventDefault();
    result=false;
  }

   if (theForm.firstname.value=== " ")
  {
    alert("You must provide a first name.");
    event.preventDefault();
    result=false;
  }

   if (theForm.lastname.value=== " ")
  {
    alert("You must provide a last name.");
    event.preventDefault();
    result=false;
  }

   if (theForm.phone.value=== " ")
  {
    alert("You must provide a phone number.");
    event.preventDefault();
    result=false;
  }

   if (theForm.city.value=== " ")
  {
    alert("You must provide a City.");
    event.preventDefault();
    result=false;
  }

   if (theForm.state.value=== " ")
  {
    alert("You must provide a State.");
    event.preventDefault();
    result=false;
  }

   if (theForm.zip.value=== " ")
  {
    alert("You must provide a Zip code.");
    event.preventDefault();
    result=false;
  }

   if (theForm.role.value=== " ")
  {
    alert("You must provide a role.");
    event.preventDefault();
    result=false;
  }

   if (theForm.creditrating.value=== " ")
  {
    alert("You must provide a credit rating.");
    event.preventDefault();
    result=false;
  }

   if (theForm.income.value=== " ")
  {
    alert("You must provide a email.");
    event.preventDefault();
    result=false;
  }
return result;
};
 $(document).ready(function(){
   $('#SignUpPage').submit(function(event){
     validate(event);
   });

  $('#SignUpPage').submit();
 });
 }); 

</script>-->

<link href="./css/public_sign_up.css" rel="stylesheet">

<div class="container">
<form novalidate class="needs-validation" method='post' id="SignUpPage" action='index.php'> 
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
                        <div class="invalid-feedback" id="email">
                          Please enter a valid email address for shipping updates.
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
                    <select type="select" name="role_id" class="form-control" id="role_id" placeholder="" required>
                    <option value="volvo">Choose one</option>
                        <option value="101">Renter</option>
                        <option value="102">Owner</option>
                    </select>
                    <div class="invalid-feedback">
                      Role code required.
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
                  <option value="">Choose...</option>
                  <?php foreach ($state as $s) { ?>
                  <option value="<?php echo $s['state_id']; ?>">
                          <?php echo $s['state_name']; ?>
                  </option>
                  <?php 
                } ?>
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