<?php include '../common/configuration.php' ?>
<?php include '../view/header.php' ?>
<div class="container">

      <div class="py-5 text-center">
        <img class="d-block mx-auto mb-4" src="<?php echo $base_path; ?>/images/rentzen_logo.svg" alt="" width="72" height="72">
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
          
          <form class="needs-validation" novalidate>
        <div class="row">
            <div class="col-md-5 mb-3">
              <label for="email">Email <span class="text-muted"></span></label>
              <input type="email" name="email" class="form-control" id="email" placeholder="you@example.com">
              <div class="invalid-feedback">
                Please enter a valid email address for shipping updates.
              </div>
            </div>
            </div>
            <div class="input-group">
            <div class="col-md-5 mb-3">
             
            <label for="username">Username</label>
              <input type="text" name="username" class="form-control" id="username" placeholder="Username" required>
                <div class="invalid-feedback" style="width: 100%;">
                  Your username is required.
                </div>
            </div>

             <div class="col-md-5 mb-3">
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
                <input type="text" name="firstname" class="form-control" id="firstName" placeholder="" value="" required>
                <div class="invalid-feedback">
                  Valid first name is required.
                </div>
              </div>
              <div class="col-md-6 mb-3">
                <label for="lastName">Last name</label>
                <input type="text" name="lastName" class="form-control" id="lastName" placeholder="" value="" required>
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
              <label for="address">City</label>
              <input type="text" name="city" class="form-control" id="city" placeholder="1234 Main St" required>
              <div class="invalid-feedback">
                Please enter your shipping address.
              </div>
            </div>

            <div class="row">

              <div class="col-md-4 mb-3">
                <label for="state">State</label>
                <select name="state" class="custom-select d-block w-100" id="state" required>
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

              <div class="col-md-3 mb-3">
                <label for="zip">Zip</label>
                <input type="text" name="zip" class="form-control" id="zip" placeholder="" required>
                <div class="invalid-feedback">
                  Zip code required.
                </div>
              </div>          
            </div>

            <div class="col-md-3 mb-3">
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

              <div class="col-md-3 mb-3">
                <label for="credit_rating">Credit Rating</label>
                <input type="text" name="credit_rating" class="form-control" id="credit_rating" placeholder="" required>
                <div class="invalid-feedback">
                  Credit Rating code required.
                </div>
              </div> 

              <div class="col-md-3 mb-3">
                <label for="income">Income</label>
                <input type="text" name="income" class="form-control" id="income" placeholder="" required>
                <div class="invalid-feedback">
                  Zip code required.
                </div>
              </div>                                
            <button class="btn btn-primary btn-lg btn-block" name="SignUp" value="" type="submit">Sign Up</button> 
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