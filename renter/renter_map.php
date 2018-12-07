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

<div id='search_address' class="input-group mb-3">
    <input id='search_address_input' type="text" class="form-control" placeholder="Address, City or Zip" aria-label="Search Address" aria-describedby="search">
    <div class="input-group-append">
      <button onclick="getGeoData()" class="btn red" type="button" id="button-search"><i class='fas fa-search'></i></button>
    </div>
  </div>

    </div>
  </div>
  <div class='mx-1 row my-3'>
    <div class='col-12'><h4 class='list_header'>Available Properties</h4></div>
    <div class='col-12 container'>
      <div class="spinner" id='property_spinner'></div>
      <div class='row' id='property_list'>
      </div>
    </div>
  </div>

</div>
</div>
<script src='./js/renter_map.js'></script>
<script src="https://maps.googleapis.com/maps/api/js?key=XXXXXXXXXXXXXXXXXXXXXXXXXXXX&callback=initMap"
  async defer></script>
<?php include '../view/footer.php' ?>
