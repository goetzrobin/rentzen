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
      <div id="search">
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

      </div> <!-- end searchbar -->
    </div>
  </div>

  <div class='row'>
    <div class='col mb-2 p-0'>
      <div id="map"></div>
    </div>
  </div>


  <div class='row mt-3'>
    <div class='col mt-3'>
      <h4>Results</h4>
      <div class='row' id='result_header'>
        <div class='col-2'></div>
        <div class='col-3'>Address</div>
        <div class='col-1'>Price</div>
        <div class='col-1'>Size</div>
        <div class='col-1'>Beds</div>
        <div class='col-1'>Baths</div>
        <div class='col-1'>ZenScore</div>
        <div class='col-2'></div>
      </div>


      <?php foreach($properties as $property) { ?>
        <div class="row item justify-content-center">
        <div class="col-sm-12 col-md-2 p-0 d-flex justify-content-center align-items-center">
          <img class="img-fluid" src="<?php echo $base_path ?>/user_data/properties/images/rentzen.jpg">
        </div>
        <div class="my-3 col-sm-12 col-md-3 d-flex align-items-center">
          <div>
            <h5 class='mb-0'> <?php echo $property['street']; ?></h5>
            <small class='ml-1'> <?php echo $property['zip']; ?>  <?php echo $property['state_name']; ?>, PA</small>
          </div>
        </div>
        <div class="quick_fact col-2 col-sm-2 col-md-1 d-flex justify-content-center align-items-baseline">
          <div class='d-flex flex-column justify-content-center'>
            <p class="mb-0 info"><i class='fas fa-money-check-alt'></i></p>
            <div>
              <div>$<?php echo $property['rental_fee']; ?></div> <small class='info_small'>/month</small>
            </div>
          </div>
        </div>
        <div class="quick_fact col-2 col-sm-2 col-md-1 d-flex justify-content-center align-items-baseline">
          <div class='d-flex flex-column justify-content-center'>
            <p class="mb-0 info"><i class='fas fa-arrows-alt'></i></p>
            <div>
              <div>
              <?php echo $property['sqft']; ?>
              </div> <small class='info_small'>sqft</small>
            </div>
          </div>
        </div>
        <div class="quick_fact col-2 col-sm-2 col-md-1 d-flex justify-content-center align-items-baseline">
          <div class='d-flex flex-column justify-content-center'>
            <p class="mb-0 info"><i class='fas fa-bed'></i></p>
            <?php echo $property['beds']; ?>
          </div>
        </div>
        <div class="quick_fact col-2 col-sm-2 col-md-1 d-flex justify-content-center align-items-baseline">
          <div class='d-flex flex-column justify-content-center'>
            <p class="mb-0 info"><i class='fas fa-bath'></i></p>
            <?php echo $property['baths']; ?>
          </div>
        </div>
        <div class="quick_fact col-2 col-sm- col-md-1 d-flex justify-content-center align-items-baseline">
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
          <i style='font-size: 30px;' class="far fa-calendar-check"></i>
          <i style='font-size: 30px; color: #8E0000' class="fas fa-heart"></i>

        </div>
      </div>
      <?php } ?>
     


    </div>
  </div>

</div>
<script>
  function setSearchbar() {
    if ($(window).width() <= 1418) {
      $('#credit').addClass('hidden');
      $('#more * a').attr('data-content', "Test yolo");
    } else {
      $('#credit').removeClass('hidden');
    }

    if ($(window).width() <= 1293) {
      $('#income').addClass('hidden');
    } else {
      $('#income').removeClass('hidden');
    }

    if ($(window).width() <= 1118) {
      $('#budget').addClass('hidden');
    } else {
      $('#budget').removeClass('hidden');
    }

    if ($(window).width() <= 972) {
      $('#bedbath').addClass('hidden');
    } else {
      $('#bedbath').removeClass('hidden');
    }

    if ($(window).width() <= 768) {
      $('.search_form').first().addClass('hidden');
     
      $('.search_form_mobile').first().removeClass('hidden');
      $('#result_header').addClass('hidden');

       $('.info').each(function (index) {
        $(this).removeClass('hidden')
      });

      $('.description').each(function (index) {
        $(this).removeClass('hidden');
      })

      $('img').each(function (index) {
        $(this).removeClass('max-height-img')
      });

      $('.quick_fact').each(function (index) {
        $(this).addClass('align-items-baseline')
        $(this).removeClass('align-items-center')
      });
    
    } else {
      $('.search_form').first().removeClass('hidden');
      $('.search_form_mobile').first().addClass('hidden');
      $('#result_header').removeClass('hidden');

      $('.description').each(function (index) {
        $(this).addClass('hidden');
      });

      $('.info').each(function (index) {
        $(this).addClass('hidden')
      });

      $('img').each(function (index) {
        $(this).addClass('max-height-img')
      });

      $('.quick_fact').each(function (index) {
        $(this).removeClass('align-items-baseline')
        $(this).addClass('align-items-center')
      });

    }
  }

  $(function () {
    $('[data-toggle="popover"]').popover({
      html: true,
      trigger: 'focus'
    });
    $('.search_form').first().removeClass('hidden');
    $('.search_form_mobile').first().addClass('hidden');
    setSearchbar();
    $(window).on('resize', setSearchbar);
  });
</script>
<script>
  var map;

  function initMap() {
    map = new google.maps.Map(document.getElementById('map'), {
      fullscreenControl: false,
      zoomControl: false,
      zoom: 8,
      styles: [{
        "featureType": "water",
        "elementType": "geometry",
        "stylers": [{
          "color": "#e9e9e9"
        }, {
          "lightness": 17
        }]
      }, {
        "featureType": "landscape",
        "elementType": "geometry",
        "stylers": [{
          "color": "#f5f5f5"
        }, {
          "lightness": 20
        }]
      }, {
        "featureType": "road.highway",
        "elementType": "geometry.fill",
        "stylers": [{
          "color": "#ffffff"
        }, {
          "lightness": 17
        }]
      }, {
        "featureType": "road.highway",
        "elementType": "geometry.stroke",
        "stylers": [{
          "color": "#ffffff"
        }, {
          "lightness": 29
        }, {
          "weight": 0.2
        }]
      }, {
        "featureType": "road.arterial",
        "elementType": "geometry",
        "stylers": [{
          "color": "#ffffff"
        }, {
          "lightness": 18
        }]
      }, {
        "featureType": "road.local",
        "elementType": "geometry",
        "stylers": [{
          "color": "#ffffff"
        }, {
          "lightness": 16
        }]
      }, {
        "featureType": "poi",
        "elementType": "geometry",
        "stylers": [{
          "color": "#f5f5f5"
        }, {
          "lightness": 21
        }]
      }, {
        "featureType": "poi.park",
        "elementType": "geometry",
        "stylers": [{
          "color": "#dedede"
        }, {
          "lightness": 21
        }]
      }, {
        "elementType": "labels.text.stroke",
        "stylers": [{
          "visibility": "on"
        }, {
          "color": "#ffffff"
        }, {
          "lightness": 16
        }]
      }, {
        "elementType": "labels.text.fill",
        "stylers": [{
          "saturation": 36
        }, {
          "color": "#333333"
        }, {
          "lightness": 40
        }]
      }, {
        "elementType": "labels.icon",
        "stylers": [{
          "visibility": "off"
        }]
      }, {
        "featureType": "transit",
        "elementType": "geometry",
        "stylers": [{
          "color": "#f2f2f2"
        }, {
          "lightness": 19
        }]
      }, {
        "featureType": "administrative",
        "elementType": "geometry.fill",
        "stylers": [{
          "color": "#fefefe"
        }, {
          "lightness": 20
        }]
      }, {
        "featureType": "administrative",
        "elementType": "geometry.stroke",
        "stylers": [{
          "color": "#fefefe"
        }, {
          "lightness": 17
        }, {
          "weight": 1.2
        }]
      }]
    });

    var marker = new google.maps.Marker({
      position: {
        lat: -34.397,
        lng: 150.644
      },
      map: map,
      title: 'Hello World!'
    });

    var marker = new google.maps.Marker({
      position: {
        lat: -33.397,
        lng: 150.644
      },
      map: map,
      title: 'Hello World!'
    });


    var marker = new google.maps.Marker({
      position: {
        lat: -32.397,
        lng: 150.644
      },
      map: map,
      title: 'Hello World!'
    });
    var contentString = '<div id="content">' +
      '<div id="siteNotice">' +
      '</div>' +
      '<h1 id="firstHeading" class="firstHeading">Uluru</h1>' +
      '<div id="bodyContent">' +
      '<p><b>Uluru</b>, also referred to as <b>Ayers Rock</b>, is a large ' +
      'sandstone rock formation in the southern part of the ' +
      'Northern Territory, central Australia. It lies 335&#160;km (208&#160;mi) ' +
      'south west of the nearest large town, Alice Springs; 450&#160;km ' +
      '(280&#160;mi) by road. Kata Tjuta and Uluru are the two major ' +
      'features of the Uluru - Kata Tjuta National Park. Uluru is ' +
      'sacred to the Pitjantjatjara and Yankunytjatjara, the ' +
      'Aboriginal people of the area. It has many springs, waterholes, ' +
      'rock caves and ancient paintings. Uluru is listed as a World ' +
      'Heritage Site.</p>' +
      '<p>Attribution: Uluru, <a href="https://en.wikipedia.org/w/index.php?title=Uluru&oldid=297882194">' +
      'https://en.wikipedia.org/w/index.php?title=Uluru</a> ' +
      '(last visited June 22, 2009).</p>' +
      '</div>' +
      '</div>';

    var infowindow = new google.maps.InfoWindow({
      content: contentString
    });

    var marker = new google.maps.Marker({
      position: {
        lat: -31.397,
        lng: 150.644
      },
      map: map,
      title: 'Uluru (Ayers Rock)'
    });
    marker.addListener('click', function () {
      infowindow.open(map, marker);
    });

    if (navigator.geolocation) {
      navigator.geolocation.getCurrentPosition(function (position) {
        var pos = {
          lat: position.coords.latitude,
          lng: position.coords.longitude
        };

        // infowindow.setPosition(pos);
        // infowindow.setContent('Location found.');
        // infowindow.open(map);
        map.setCenter(pos);
        map.setZoom(15);
      }, function () {
        handleLocationError(true, infowindow, map.getCenter());
      });
    } else {
      // Browser doesn't support Geolocation
      handleLocationError(false, infowindow, map.getCenter());
    }
  }

  function handleLocationError(browserHasGeolocation, infowindow, pos) {
    infowindow.setPosition(pos);
    infowindow.setContent(browserHasGeolocation ?
      'Error: The Geolocation service failed.' :
      'Error: Your browser doesn\'t support geolocation.');
    infowindow.open(map);
  }
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCBGe2Qu6G_eINiYN28_igiiifEKRmj8uw&callback=initMap"
  async defer></script>
<?php include '../view/footer.php' ?>