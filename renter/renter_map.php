<?php include '../common/configuration.php';
session_start();
if ((int)$_SESSION['ROLE_ID'] !== ROLE_ID_RENTER) {
  header("Location: " . $base_path);
}
?>
<?php include '../view/header.php' ?>
<link href="./css/renter_map.css" rel="stylesheet">
<div class='container-fluid'>
  <div class='row search_row'>
    <div class='col mt-3 mb-3'>
      <!-- <div id="search">
        <div class='search_form_mobile'>Show all filters
          <a class="icon fas fa-chevron-up" tabindex='0' data-trigger='focus' data-container="body" data-toggle="popover"
            data-placement="top" data-content="Vivamus
            sagittis lacus vel augue laoreet rutrum faucibus."></a>
        </div>
        <form class='search_form'>
          <div id='type' class='search_form_item'>
            <div class='search_form_description'>THIS IS</div>
            <div class='search_form_data'><i class="fas fa-home mr-2"></i>An Apartment <a class="icon fas fa-chevron-up"
                tabindex='0' data-trigger='focus' data-container="body" data-toggle="popover" data-placement="top"
                data-content="<h4>Vivamus
            sagittis lacus vel augue laoreet rutrum faucibus.</h4"></a></div>
          </div>

          <div id='location' class='search_form_item'>
            <div class='search_form_description'>LOCATED IN</div>
            <div class='search_form_data'><i class="fas fa-city mr-2"></i>Neighborhood <a class="icon  fas fa-chevron-up"
                tabindex='0' data-trigger='focus' data-container="body" data-toggle="popover" data-placement="top"
                data-content="Vivamus
            sagittis lacus vel augue laoreet rutrum faucibus."></a></div>
          </div>

          <div id='bedbath' class='search_form_item'>
            <div class='search_form_description'>WITH</div>
            <div class='search_form_data'>2<i class="fas fa-bed mx-2"></i> / 1<i class="fas fa-bath ml-2"></i> <a class="icon fas fa-chevron-up"
                tabindex='0' data-trigger='focus' data-container="body" data-toggle="popover" data-placement="top"
                data-content="Vivamus
            sagittis lacus vel augue laoreet rutrum faucibus."></a></div>
          </div>

          <div id='budget' class='search_form_item'>
            <div class='search_form_description'>MY BUDGET IS:</div>
            <div class='search_form_data'>$100 - $1000 <a class="icon fas fa-chevron-up" tabindex='0' data-trigger='focus'
                data-container="body" data-toggle="popover" data-placement="top" data-content="Vivamus
            sagittis lacus vel augue laoreet rutrum faucibus."></a></div>
          </div>

          <div id='sqft' class='search_form_item'>
            <div class='search_form_description'>IT SHOULD BE:</div>
            <div class='search_form_data'>100 sqft - 2500 sqft <a class="icon fas fa-chevron-up" tabindex='0'
                data-trigger='focus' data-container="body" data-toggle="popover" data-placement="top" data-content="Vivamus
            sagittis lacus vel augue laoreet rutrum faucibus."></a></div>
          </div>

          <div id='income' class='search_form_item'>
            <div class='search_form_description'>I MAKE:</div>
            <div class='search_form_data'>$10000 - $100000 <a class="icon fas fa-chevron-up" tabindex='0' data-trigger='focus'
                data-container="body" data-toggle="popover" data-placement="top" data-content="Vivamus
            sagittis lacus vel augue laoreet rutrum faucibus."></a></div>
          </div>

          <div id='credit' class='search_form_item'>
            <div class='search_form_description'>CREDIT SCORE:</div>
            <div class='search_form_data'>800 <a class="icon fas fa-chevron-up" tabindex='0' data-trigger='focus'
                data-container="body" data-toggle="popover" data-placement="top" data-content="Vivamus
            sagittis lacus vel augue laoreet rutrum faucibus."></a></div>
          </div>

          <div id='more' class='search_form_item'>
            <div class='search_form_data'>More Filters <a class="icon fas fa-chevron-up" tabindex='0' data-trigger='focus'
                data-container="body" data-toggle="popover" data-placement="top" data-content="Vivamus
            sagittis lacus vel augue laoreet rutrum faucibus."></a></div>
          </div>

          <div id='button' class='search_form_item'>
            <button class='btn red'>Search</button>
          </div>

        </form>

      </div> end searchbar -->
    </div>
  </div>
  <div class='row'>
    <div class='col-12 mb-2 p-0'>
      <div id="map"></div>
    </div>

    </div>
  </div>
  <div class='mx-1 row mt-3'>
    <div class='col-12'><h4 class='list_header'>Available Properties</h4></div>
    <div class='col-12 container'>
      <div class="spinner" id='property_spinner'></div>
      <div class='row' id='property_list'>
      </div>
    </div>
  </div>

</div>
<script src='./js/renter_map.js'></script>
<script src="https://maps.googleapis.com/maps/api/js?key=XXXXXXXXXXXXXXXXXXX&callback=initMap"
  async defer></script>
<?php include '../view/footer.php' ?>

<?php /*
     <?php foreach ($properties as $property) { ?>
        <div class="row item justify-content-center">
        <div class="result_image col-sm-12 col-md-2 p-0 d-flex justify-content-center align-items-center">
          <img alt='Placeholder Image' class="img-fluid" src="<?php echo $base_path ?>/user_data/properties/images/rentzen.jpg">
          <!-- <div class='hidden thumbmails col-4 row' style='heigth: 100%; padding: 0'>
            <div class='col-6 thumbmails__image'>
            <img alt='Placeholder Image' class="img-fluid" src="<?php echo $base_path ?>/user_data/properties/images/rentzen.jpg">
        
            </div>
            <div class='col-6 thumbmails__image'>
            <img alt='Placeholder Image' class="img-fluid" src="<?php echo $base_path ?>/user_data/properties/images/rentzen.jpg">
        
            </div>
            <div class='col-6 thumbmails__image'>
            <img alt='Placeholder Image' class="img-fluid" src="<?php echo $base_path ?>/user_data/properties/images/rentzen.jpg">
        
            </div>
            <div class='col-6 thumbmails__image'>
            <img alt='Placeholder Image' class="img-fluid" src="<?php echo $base_path ?>/user_data/properties/images/rentzen.jpg">
        
            </div>
            <div class='col-6 thumbmails__image'>
            <img alt='Placeholder Image' class="img-fluid" src="<?php echo $base_path ?>/user_data/properties/images/rentzen.jpg">
        
            </div>
            <div class='col-6 thumbmails__image'>
            <img alt='Placeholder Image' class="img-fluid" src="<?php echo $base_path ?>/user_data/properties/images/rentzen.jpg">
        
            </div>
          </div> -->
         
        </div>
        <div class="result_address my-3 col-sm-12 col-md-3 d-flex align-items-center">
          <div>
            <input type='hidden' class='property_id' value='<?php echo $property['property_id'] ?>'</div>
            <h5 class='mb-0'> <?php echo $property['street']; ?>
             <!-- <i class="fas fa-chevron-down icon__expand"></i> -->
            </h5>
            <small class='ml-1'> <?php echo $property['zip']; ?>  <?php echo $property['city'];?>, <?php echo $property['state_name']; ?></small>
          </div>
          
        </div>
        <div class="result_fee quick_fact col-2 col-sm-1 col-md-1 d-flex justify-content-center align-items-baseline">
          <div class='d-flex flex-column justify-content-center'>
            <p class="mb-0 info"><i class='fas fa-money-check-alt'></i></p>
            <div>
              <div>$<?php echo $property['rental_fee']; ?></div> <small class='info_small'>/month</small>
            </div>
          </div>
        </div>
        <div class="result_sqft quick_fact col-2 col-sm-1 col-md-1 d-flex justify-content-center align-items-baseline">
          <div class='d-flex flex-column justify-content-center'>
            <p class="mb-0 info"><i class='fas fa-arrows-alt'></i></p>
            <div>
              <div>
              <?php echo $property['sqft']; ?>
              </div> <small class='info_small'>sqft</small>
            </div>
          </div>
        </div>
        <div class="result_beds quick_fact col-2 col-sm-1 col-md-1 d-flex justify-content-center align-items-baseline">
          <div class='d-flex flex-column justify-content-center'>
            <p class="mb-0 info"><i class='fas fa-bed'></i></p>
            <?php echo $property['beds']; ?>
          </div>
        </div>
        <div class="result_baths quick_fact col-2 col-sm-1 col-md-1 d-flex justify-content-center align-items-baseline">
          <div class='d-flex flex-column justify-content-center'>
            <p class="mb-0 info"><i class='fas fa-bath'></i></p>
            <?php echo $property['baths']; ?>
          </div>
        </div>
        <div class="result_match quick_fact col-2 col-sm-1 col-md-1 d-flex justify-content-center align-items-baseline">
          <div class='d-flex flex-column justify-content-center'>
            <p class="mb-0 info"><i class='fas fa-star'></i></p>
            10
          </div>
        </div>
        <div class='description col-sm-12 mt-3'>
          <h5 class='mt-2 mb-0'>Description</h5>
          <?php echo $property['description']; ?>
        </div>
        <div class="col-sm-12 col-md-2 p-3 d-flex justify-content-around align-items-center">
          <span style='background-color: transparent; border: 0; font-size: 30px;' class="far fa-calendar-check icon__action" id='icon__action--calendar' data-toggle="modal" data-target="#exampleModal" data-id='1234'></span>
          <i style='font-size: 30px; color: #8E0000' class="far fa-heart icon__action" id='icon__action--heart'></i>

        </div>
      </div>
      <?php 
    } ?>

 */
