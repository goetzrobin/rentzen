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


<div class="container">
  <?php echo $message ?>
<form class="needs-validation" method='post' id="SignUpPage" action='index.php'> 
      <div class="py-5 text-center">
        <img class="d-block mx-auto mb-4" src="<?php echo $base_path; ?>/images/rentzen_logo.svg" alt="RentZen Logo" width="72" height="72">
        <h2>Sign Up Form</h2>
        <p class="lead">
          Sign up below and join the RentZen Community. Whether you are a renter or a landlord, RentZen will 
          take the stress out of your property search. Sit back and relax. Your perfect match is out there.  
        </p>
      </div>

      <div class="row">
        <div class="col-md-4 order-md-2 mb-4">

        </div>
        <div class="col-md-8 order-md-1">
          <h4 class="mb-3">Personal Information</h4>
          
        <div class="row">
            <div class="col-md-5 mb-3">
              <label for="email">Email <span class="text-muted"></span></label>
              <input type="email" name="email" class="form-control" id="email" placeholder="you@example.com" required>
              <div class="invalid-feedback" id="email">
                Please enter a valid email address for shipping updates.
              </div>
            </div>
            </div>
            <div class="input-group">
            <div class="col-md-6 mb-3">
             <label for="username">Username</label>
              <input type="text" name="username" class="form-control" id="username" placeholder="Username" required>
                <div class="invalid-feedback" style="width: 100%;">
                  Your username is required.
                </div>
            </div>

             <div class="col-md-6 mb-3">
              <label for="password">Password</label>
              <input type="text" name="password" class="form-control" id="password" placeholder="Password" required>
                  <div class="invalid-feedback" style="width: 100%;">
                  Your Password is required.
                  </div>
            </div>
            </div>
              <div class="input-group">
              <div class="col-md-6 mb-3">
                <label for="firstName">First name</label>
                <input type="text" name="firstname" class="form-control" id="firstname" placeholder="First " value="" required>
                <div class="invalid-feedback">
                  Valid first name is required.
                </div>
              </div>
              <div class="col-md-6 mb-3">
                <label for="lastName">Last name</label>
                <input type="text" name="lastname" class="form-control" id="lastname" placeholder="" value="" required>
                <div class="invalid-feedback">
                  Valid last name is required.
                </div>
              </div>
            </div>

               
             <div class="mb-3">
              <label for="phone">Phone</label>
              <input type="" name="phone" class="form-control" id="phone"  
              placeholder="123-456-7890" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" required>
              <div class="invalid-feedback">
                Please enter your phone number.
              </div>
            </div>
                
            <div class="mb-3">
              <label for="address">Street</label>
              <input type="text" name="street" class="form-control" id="street" placeholder="1234 Main St" required>
              <div class="invalid-feedback">
                Please enter your shipping address.
              </div>
            </div>
              

            <div class="mb-3">
              <label for="address">City</label>
              <input type="text" name="city" class="form-control" id="city" placeholder="1234 Main St" required>
              <div class="invalid-feedback">
                Please enter your shipping address.
              </div>
            </div>

            <div class="row">

              <div class="col-md- mb-3">
                <label for="state">State</label>
                <select name="state_id" class="custom-select d-block w-100" id="state_id" required>
                  <option value="">Choose...</option>
                  <?php foreach ($state as $s){ ?>
                  <option value="<?php echo $s['state_id']; ?>">
                          <?php echo $s['state_name']; ?>
                  </option>
                  <?php } ?>
                </select>
                <div class="invalid-feedback">
                  Please provide a valid state.
                </div>
              </div>

              <div class="col-md-6 mb-3">
                <label for="zip">Zip</label>
                <input type="text" name="zip" class="form-control" id="zip" placeholder="" required>
                <div class="invalid-feedback">
                  Zip code required.
                </div>
              </div>          
            </div>

            <div class="col-md-6 mb-3">
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

              <div class="col-md-6 mb-3">
                <label for="credit_rating">Credit Rating</label>
                <input type="text" name="credit_rating" class="form-control" id="credit_rating" placeholder="" required>
                <div class="invalid-feedback">
                  Credit Rating code required.
                </div>
              </div> 

              <div class="col-md-6 mb-3">
                <label for="income">Income</label>
                <input type="text" name="income" class="form-control" id="income" placeholder="" required>
                <div class="invalid-feedback">
                  Income required.
                </div>
              </div>                                
            <button class="btn btn-primary btn-lg btn-block" name="SignUp" id="SignUp" value="submit" type="submit">Sign Up</button> 
          </form>
        </div>
      </div>

      <footer class="my-5 pt-5 text-muted text-center text-small">
        <p class="mb-1">&copy; 2017-2018 Company Name</p>
        <ul class="list-inline">
          <li class="list-inline-item"><a href="#">Privacy</a></li>
          <li class="list-inline-item"><a href="#">Terms</a></li>
          <li class="list-inline-item"><a href="#">Support</a></li>
        </ul>
      </footer>
    </div>

    <?php include '../view/footer.php'; ?>