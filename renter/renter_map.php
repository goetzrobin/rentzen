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


      <?php foreach ($properties as $property) { ?>
        <div class="row item justify-content-center">
        <div class="result_image col-sm-12 col-md-2 p-0 d-flex justify-content-center align-items-center">
          <img class="img-fluid" src="<?php echo $base_path ?>/user_data/properties/images/rentzen.jpg">
          <div class='hidden thumbmails col-4 row' style='heigth: 100%; padding: 0'>
          <div class='col-6 thumbmails__image'>
          <img class="img-fluid" src="<?php echo $base_path ?>/user_data/properties/images/rentzen.jpg">
       
          </div>
          <div class='col-6 thumbmails__image'>
          <img class="img-fluid" src="<?php echo $base_path ?>/user_data/properties/images/rentzen.jpg">
       
          </div>
          <div class='col-6 thumbmails__image'>
          <img class="img-fluid" src="<?php echo $base_path ?>/user_data/properties/images/rentzen.jpg">
       
          </div>
          <div class='col-6 thumbmails__image'>
          <img class="img-fluid" src="<?php echo $base_path ?>/user_data/properties/images/rentzen.jpg">
       
          </div>
          <div class='col-6 thumbmails__image'>
          <img class="img-fluid" src="<?php echo $base_path ?>/user_data/properties/images/rentzen.jpg">
       
          </div>
          <div class='col-6 thumbmails__image'>
          <img class="img-fluid" src="<?php echo $base_path ?>/user_data/properties/images/rentzen.jpg">
       
          </div>
          </div>
         
        </div>
        <div class="result_address my-3 col-sm-12 col-md-3 d-flex align-items-center">
          <div>
            <input type='hidden' class='property_id' value='<?php echo $property['property_id'] ?>'</div>
            <h5 class='mb-0'> <?php echo $property['street']; ?> <i class="fas fa-chevron-down icon__expand"></i></h5>
            <small class='ml-1'> <?php echo $property['zip']; ?>  <?php echo $property['state_name']; ?>, PA</small>
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
          <button style='background-color: transparent; border: 0; font-size: 30px;' class="far fa-calendar-check icon__action" id='icon__action--calendar' data-toggle="modal" data-target="#exampleModal" data-id='1234'></button>
          <i style='font-size: 30px; color: #8E0000' class="far fa-heart icon__action" id='icon__action--heart'></i>

        </div>
      </div>
      <?php 
    } ?>
     


    </div>
  </div>
</div>
<script>
  function setSearchbar() {
    if ($(window).width() <= 1418) {
      $('#credit').hide();
      $('#more * a').attr('data-content', "Test yolo");
    } else {
      $('#credit').show();
    }

    if ($(window).width() <= 1293) {
      $('#income').hide();
    } else {
      $('#income').show();
    }

    if ($(window).width() <= 1118) {
      $('#budget').hide();
    } else {
      $('#budget').show();
    }

    if ($(window).width() <= 972) {
      $('#bedbath').hide();
    } else {
      $('#bedbath').show();
    }

    if ($(window).width() <= 768) {
      $('.search_form').first().hide();
     
      $('.search_form_mobile').first().show();
      $('#result_header').hide();

       $('.info').each(function (index) {
        $(this).show()
      });

      $('.description').each(function (index) {
        $(this).show();
      })

      $('img').each(function (index) {
        $(this).removeClass('max-height-img')
      });

      $('.quick_fact').each(function (index) {
        $(this).addClass('align-items-baseline')
        $(this).removeClass('align-items-center')
      });
    
    } else {
      $('.search_form').first().show();
      $('.search_form_mobile').first().hide();
      $('#result_header').show();

      $('.description').each(function (index) {
        $(this).hide();
      });

      $('.info').each(function (index) {
        $(this).hide()
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

  function expand(el) {
      $(el).find('.info').each(function (index) { $(this).show('slow') });

      $(el).find('.description').first().show('slow');


      $(el).find('.result_image').first().removeClass('justify-content-center');

      $(el).find('.result_image img').first().removeClass('max-height-img');
      $(el).find('.result_image img').first().addClass('col-8');
      $(el).find('.result_image .thumbmails').first().removeClass('hidden');
      $(el).find('.result_image .thumbmails img').removeClass('max-height-img');
      $(el).find('.result_image .thumbmails img').addClass('h-100');
      $(el).find('.result_image').first().removeClass('col-md-2');
      $(el).find('.result_image').first().addClass('col-12');

      $(el).find('.result_address').first().toggleClass('col-md-3');
      $(el).find('.result_address').first().addClass('col-12');

      $(el).find('.result_fee').first().removeClass('col-md-1');
      $(el).find('.result_fee').first().addClass('col-2');

      $(el).find('.result_baths').first().removeClass('col-md-1');
      $(el).find('.result_baths').first().addClass('col-2');

      $(el).find('.result_sqft').first().removeClass('col-md-1');
      $(el).find('.result_sqft').first().addClass('col-2');

      $(el).find('.result_beds').first().removeClass('col-md-1');
      $(el).find('.result_beds').first().addClass('col-2');

      $(el).find('.result_match').first().removeClass('col-md-1');
      $(el).find('.result_match').first().addClass('col-2');

  }

  function minimize(el) {
    $(el).find('.info').each(function (index) { $(this).hide('slow') });

    $(el).find('.description').first().hide('slow');

    $(el).find('.result_image').first().addClass('justify-content-center');

    $(el).find('.result_image img').first().addClass('max-height-img');
    $(el).find('.result_image img').first().removeClass('col-8');
    $(el).find('.result_image .thumbmails').first().addClass('hidden');
    $(el).find('.result_image').first().addClass('col-md-2');
    $(el).find('.result_image').first().removeClass('col-12');

    $(el).find('.result_address').first().addClass('col-md-3');
    $(el).find('.result_address').first().removeClass('col-12');

    $(el).find('.result_fee').first().addClass('col-md-1');
    $(el).find('.result_fee').first().removeClass('col-2');

    $(el).find('.result_baths').first().addClass('col-md-1');
    $(el).find('.result_baths').first().removeClass('col-2');

    $(el).find('.result_sqft').first().addClass('col-md-1');
    $(el).find('.result_sqft').first().removeClass('col-2');

    $(el).find('.result_beds').first().addClass('col-md-1');
    $(el).find('.result_beds').first().removeClass('col-2');

    $(el).find('.result_match').first().addClass('col-md-1');
    $(el).find('.result_match').first().removeClass('col-2');

  }

function setApplicationModal(  prop_street,  prop_zip,  prop_city,  prop_state, land_name,  land_street,  land_zip,  land_city,  land_state, score)
{
     $('#exampleModal .modal-body').html(`
     <div class='container'>
     <div class='row py-2'>
     <div class='col-sm-4'>
      <h5>Property</h5>
      <div>`+prop_street+`</div>
      <div>`+prop_zip+` `+prop_city+`, `+prop_state+`</div>
     </div>
     <div class='col-sm-4'>
      <h5>Landlord</h5>
      <div class='mb-1'><b>`+land_name+`</b></div>
      <div>`+land_street+`</div>
      <div>`+land_zip+` `+land_city+`, `+land_state+`</div>
     </div>
     <div class='col-sm-4 d-flex justify-content-center align-items-center' style='flex-direction: column'>
      <div>Match Score</div>
      <div class='match-score__data'>`+score+`</div>
     </div>
     </div>
     <hr>
     <div class='row py-2'>
     <hr>
     <div class='col-sm-6'>
     <h5>Move In Date</h5>
        <input class='form-control move_in_date' type='date'>
      </div>

      <div class='col-sm-6'>
        <h5>Move Out Date</h5>
        <input class='form-control move_out_date' type='date'>
      </div>

     </div>
     <hr>
     <div class='row py-2'>
      <div class='col-12'>
        <h5>Message</h5>
        <textarea class='form-control message'  style='width: 100%; min-width: 300px;' rows='10'></textarea>
      </div>
     </div>
     </div>
     `);
     $('#exampleModal .modal-title').text('Rental Application');
     $('#exampleModal .modal-btn').show().text('Submit Application');
     $('#exampleModal .modal-btn__optional').show().text('Save as Draft');
     $('#exampleModal .move_in_date').val(new Date().toJSON().slice(0,10));
  }


  function addExpandMinimizeFunctionality() {
    $('.item').each( function (index) {
      var counter = 0;
      var window_width = $(window).width();
      
      $(this).find('i').first().click( () => {

        $(this).find('i').first().toggleClass('fa-chevron-up');
        $(this).find('i').first().toggleClass('fa-chevron-down');

        if(window_width > 768) {
          if(counter % 2 == 0) {
          expand(this);
          } else {
         minimize(this);
          }
        console.log('round: ', counter);
        counter++;}
       
        
      });
    });
  }

  function toggleIconExpand() {
    $('.item').each( function (index) {
      var window_width = $(window).width();

    if(window_width > 768) {
        $(this).find('i').first().show();
      } else {

        $(this).find('i').first().hide();
      }
    });
  }
  
  $(function () {
    $('[data-toggle="popover"]').popover({
      html: true,
      trigger: 'focus'
    });
    $('.search_form').first().show();
    $('.search_form_mobile').first().hide();

    setSearchbar();
    toggleIconExpand();
    $(window).on('resize', setSearchbar);
    $(window).on('resize', toggleIconExpand);
    addExpandMinimizeFunctionality();
    var current_prop_id  = null;
    var current_renter_id = null;
    $(document).on("click", ".icon__action", function () {
      $.getJSON("http://localhost/rentzen/services/?type=get_session_data").done((session_data) => {
        current_prop_id = $(this).parents('.item').find('.property_id').val();
        current_renter_id = (session_data.PEOPLE_ID);
        console.log(current_renter_id, current_prop_id);
        var url = "http://localhost/rentzen/services/?type=get_renter_prop&renter_id="+current_renter_id+"&property_id="+current_prop_id;
        console.log(url);
        $.getJSON(url).done((renter_prop_data) => {
          console.log(renter_prop_data);
          if (renter_prop_data) {
            setApplicationModal(prop_street = renter_prop_data.street, prop_zip=renter_prop_data.zip,prop_city=renter_prop_data.city,prop_state=renter_prop_data.state_name,land_name='Robins Property',land_street = '2234 North West Street',land_zip='19121',land_city='Philly',land_state='PA',score=renter_prop_data.renter_match_score);
          } else {
            console.error('FAILING STILL');
          }
        });

      });
     
      });



     $(document).on("click", "#exampleModal .modal-btn.btn-primary", function () {
       $modal_data = $('#exampleModal .modal-content .modal-body .container');
       var app_prop_id = current_prop_id;
       var app_renter_id = current_renter_id;
       var app_move_in_date =  $modal_data.find('.move_in_date').val();
       var app_move_out_date = $modal_data.find('.move_out_date').val();
       var app_message = $modal_data.find('.message').val();
       var app_status =  1;

       var data = {
         type: 'post_app_submit',
         app_prop_id,
         app_renter_id,
         app_move_in_date,
         app_move_out_date,
         app_message,
         app_status
       };

       var url = "http://localhost/rentzen/services/index.php?type=post_app_form"
       $.ajax({
          type: "POST",
          url: url,
          data: data
       }).done((message) => {
    
        $('#exampleModal .modal-btn.red').hide();
        $('#exampleModal .modal-btn__optional').hide();
        $('#exampleModal .modal-body').html(message);

       })
     });

    $('.fa-heart').each( function (index) {
      $(this).click(function (index) { 

        $(this).toggleClass('fas'); 
        $(this).toggleClass('far');
        
        $('#notification__badge').fadeIn(300).delay(300).fadeOut(300);
        
        // .show().delay(300).hide();
        });

    }
      );
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