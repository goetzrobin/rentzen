//JQUERY
$(function () {

  var properties = new Array();
  // get_properties(properties);

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
  $(window).on('resize', function () {
    if ($(window).width < 765) {
      $('.item').each(function (index) {

        $(this).find('.result_fee').first().addClass('col-2');
        $(this).find('.result_baths').first().addClass('col-2');
        $(this).find('.result_sqft').first().addClass('col-2');
        $(this).find('.result_beds').first().addClass('col-2');
        $(this).find('.result_match').first().addClass('col-2');

      });
    }
  })
  addExpandMinimizeFunctionality();

  var current_prop_id = null;
  var current_renter_id = null;


  $(document).on("click", ".icon__action", function () {
    $('#exampleModal .modal-body .spinner').show();
    current_prop_id = $(this).parents('.property_list_item').find('.property_id').val();
    // console.log(current_prop_id);
    url = base_path + "/services/index.php?type=set_property_renter_relationship&prop_id=" + current_prop_id;
    $.getJSON(url).done((response) => {
      // console.log('response', response);
      if (response.result) {

        /////////////////////
        var url = base_path + "/services/?type=get_prop_data&prop_id=" + current_prop_id;
        // console.log('getting data');
        $.getJSON(url).done((renter_prop_data) => {
          // console.log(renter_prop_data);
          if (renter_prop_data) {
            setApplicationModal(prop_street = renter_prop_data.street,
              prop_zip = renter_prop_data.zip, prop_city = renter_prop_data.city, prop_state = renter_prop_data.state_name,
              land_name = renter_prop_data.landlord_firstname + " " + renter_prop_data.landlord_lastname,
              land_street = renter_prop_data.landlord_street,
              land_zip = renter_prop_data.landlord_zip,
              land_city = renter_prop_data.landlord_city,
              land_state = renter_prop_data.landlord_state_text,
              land_email = renter_prop_data.landlord_username,
              landlord_phone = renter_prop_data.landlord_phone,
              score = response.data.renter_match_score);
          } else {
            $('#exampleModal .modal-body .spinner').hide();
            $('#exampleModal .modal-body').html(`<div class='d-flex justify-content-center align-items-center p-3 ml-1'>
            <i class='fa-icon fas fa-exclamation-triangle icon_red_40'></i>
            <div>No Owner Found. We are working to fix this...</div>
            </div>`);
          }
        }); // end done
        //////////////////////
      } else {
        $('#exampleModal .modal-body .spinner').hide();
        // console.error("FAILED TO ESTABLISH RELATIONSHIP");
      }

    });

  });



  $(document).on("click", "#exampleModal .modal-btn.btn-primary", function () {
    $modal_data = $('#exampleModal .modal-content .modal-body .container');
    var app_prop_id = current_prop_id;
    var app_move_in_date = $modal_data.find('.move_in_date').val();
    var app_move_out_date = $modal_data.find('.move_out_date').val();
    var app_message = $modal_data.find('.message').val();
    var app_status = 1;

    var data = {
      type: 'post_app_submit',
      app_prop_id,
      app_move_in_date,
      app_move_out_date,
      app_message,
      app_status
    };

    var url = base_path + "/services/index.php?type=post_app_form"
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

  $('.fa-heart').each(function (index) {
    $(this).click(function (index) {

      $(this).toggleClass('fas');
      $(this).toggleClass('far');

      $('#notification__badge').fadeIn(300).delay(300).fadeOut(300);

      // .show().delay(300).hide();
    });

  });

  $('#search_address_input').keyup(function(e){
    if(e.keyCode == 13)
    {
        $(this).trigger("enterKey");
    }
});

  $('#search_address_input').bind("enterKey",function(e){
    //do stuff here
    getGeoData();
 });
});

var map;

var my_location_marker = null;

function initMap() {
  definePopupClass();

  map = new google.maps.Map(document.getElementById('map'), {
    fullscreenControl: false,
    mapTypeControl: false,
    zoomControl: true,
    zoom: 16,
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

  map.addListener('idle', function () {
    var bounds = map.getBounds();
    // console.log(bounds);
    if (bounds) {
      var bounds_json = {
        north: bounds.getNorthEast().lat(),
        south: bounds.getSouthWest().lat(),
        east: bounds.getNorthEast().lng(),
        west: bounds.getSouthWest().lng(),
      };
    }
    // console.log(bounds_json);

    if (bounds_json) {
      update_map_properties(bounds_json);
    }

  });


  var pos = {
    // lat: position.coords.latitude,
    // lng: position.coords.longitude

    lat: 39.962229140924464,
    lng: -75.164762814668280
  };

  // infowindow.setPosition(pos);
  // infowindow.setContent('Location found.');
  // infowindow.open(map);
  map.setCenter(pos);
  map.setZoom(16);

  var icon = {
    url: base_path + "images/rentzen_marker_person.svg",
    scaledSize: new google.maps.Size(40, 40)
  }

  my_location_marker = new google.maps.Marker({
    position: pos,
    map: map,
    title: "My Position",
    icon: icon,
    optimized: false
  });;

  setMyLocationMarker(pos);
  // if (navigator.geolocation) {
  //   navigator.geolocation.getCurrentPosition(function (position) {
  //     var pos = {
  //       // lat: position.coords.latitude,
  //       // lng: position.coords.longitude

  //       lat: 39.962229140924464,
  //       lng: -75.164762814668280
  //     };

  //     // infowindow.setPosition(pos);
  //     // infowindow.setContent('Location found.');
  //     // infowindow.open(map);
  //     map.setCenter(pos);
  //     map.setZoom(16);
  //   }, function () {
  //     handleLocationError(true, infowindow, map.getCenter());
  //   });
  // } else {
  //   // Browser doesn't support Geolocation
  //   handleLocationError(false, infowindow, map.getCenter());
  // }


}

var popup, last_clicked_marker;

function update_map_properties(bounds) {

  var url = base_path + "services/index.php?type=get_properties_by_bounds&north=" + bounds.north + "&south=" + bounds.south + "&west=" + bounds.west + "&east=" + bounds.east;
  // console.log('updating prop', bounds);
  $('#property_list').hide();
  $('#property_spinner').show();
  $.getJSON(url, function (properties_within_bounds) {

    $.each(properties_within_bounds, function (indexInArray, property) {

      // get position of property
      var long = parseFloat(property.longitude)
      var lat = parseFloat(property.latitude);
      var contentString = `
          <div class='prop_card'>
            ` + //<div class='prop_card_exit'><i id='exit_`+property.property_id+`'class='fas fa-times'></i></div>
        `<div class='prop_card_img' style='background-image: url("` + base_path + `user_data/properties/images/rentzen.jpg"); background-size: cover;'>
            <div class='prop_card_price'>$` + parseFloat(property.rental_fee).toFixed(2) + `</div>
            </div>
            <!-- <div class='prop_card_chevron_left'><</div>
            <div class='prop_card_chevron_right'>></div> -->
            <div class='prop_card_icon' onclick="scrollToProp(`+property.property_id+`)" ><i class="fas fa-info"></i></div>
            <div class='prop_card_street ml-1'>` + property.street + `</div>
            <div class='prop_card_cs ml-1 mt-1'>` + property.zip + ' ' + property.city + ', ' + property.state_name + `</div>
            <div class='prop_card_info'>
            <div class='prop_card_info_bed'>` + property.beds + ` BEDS</div>
            <div class='prop_card_info_bath'>` + property.baths + ` BATHS</div>
            <div class='prop_card_info_sqft'>` + property.sqft + ` SQFT</div>
            </div>
          </div>`;


      // create info window with newly generated content
      // var infowindow = new google.maps.InfoWindow({
      //   content: contentString
      // });
      // create icon
      var icon = {
        url: base_path + "images/rentzen_marker.svg",
        scaledSize: new google.maps.Size(40, 40)
      }


      // set marker
      var marker = new google.maps.Marker({
        position: {
          lat: lat,
          lng: long
        },
        map: map,
        title: property.street,
        icon: icon,
        optimized: false
      });

      // when marker is clicked open info window
      marker.addListener('click', function () {
        // a popup already exists, i am going to remove it
        if (popup != undefined) {
          popup.onRemove();
          popup = undefined;
          // i just wanted to close the current one, stop here
          if (last_clicked_marker == marker) {
            last_clicked_marker = marker;
            return;
          }
        }
        // closed a different popup, open the new one
        var prop_pop_up = document.createElement('DIV');
        $(prop_pop_up).html(contentString);

        popup = new Popup(
          new google.maps.LatLng(lat, long),
          prop_pop_up);
        popup.setMap(map);
        last_clicked_marker = marker;
      });

      // end each
    });
    // end json

    build_property_list(properties_within_bounds);
    $('#property_spinner').hide();

  });
}

function scrollToProp(id){
  // console.log(id);
  $('html, body').animate({
    scrollTop: $("#" + id).offset().top - 50
   }, 1000);
   $("#"+id).find(".property_list_item").addClass("red_border").delay(2000).queue(function(next){
    $(this).removeClass("red_border");
    next();
});}

function handleLocationError(browserHasGeolocation, infowindow, pos) {
  infowindow.setPosition(pos);
  infowindow.setContent(browserHasGeolocation ?
    'Error: The Geolocation service failed.' :
    'Error: Your browser doesn\'t support geolocation.');
  infowindow.open(map);
}

/** Defines the Popup class. */
function definePopupClass() {
  /**
   * A customized popup on the map.
   * @param {!google.maps.LatLng} position
   * @param {!Element} content
   * @constructor
   * @extends {google.maps.OverlayView}
   */
  Popup = function (position, content) {
    this.position = position;

    content.classList.add('popup-bubble-content');

    var pixelOffset = document.createElement('div');
    pixelOffset.classList.add('popup-bubble-anchor');
    pixelOffset.appendChild(content);

    this.anchor = document.createElement('div');
    this.anchor.classList.add('popup-tip-anchor');
    this.anchor.appendChild(pixelOffset);

    // Optionally stop clicks, etc., from bubbling up to the map.
    this.stopEventPropagation();
  };
  // NOTE: google.maps.OverlayView is only defined once the Maps API has
  // loaded. That is why Popup is defined inside initMap().
  Popup.prototype = Object.create(google.maps.OverlayView.prototype);

  /** Called when the popup is added to the map. */
  Popup.prototype.onAdd = function () {
    this.getPanes().floatPane.appendChild(this.anchor);
  };

  /** Called when the popup is removed from the map. */
  Popup.prototype.onRemove = function () {
    if (this.anchor.parentElement) {
      this.anchor.parentElement.removeChild(this.anchor);
    }
  };

  /** Called when the popup needs to draw itself. */
  Popup.prototype.draw = function () {
    var divPosition = this.getProjection().fromLatLngToDivPixel(this.position);
    // Hide the popup when it is far out of view.
    var display =
      Math.abs(divPosition.x) < 4000 && Math.abs(divPosition.y) < 4000 ?
      'block' :
      'none';

    if (display === 'block') {
      this.anchor.style.left = divPosition.x + 'px';
      this.anchor.style.top = divPosition.y + 'px';
    }
    if (this.anchor.style.display !== display) {
      this.anchor.style.display = display;
    }
  };

  /** Stops clicks/drags from bubbling up to the map. */
  Popup.prototype.stopEventPropagation = function () {
    var anchor = this.anchor;
    anchor.style.cursor = 'auto';

    ['click', 'dblclick', 'contextmenu', 'wheel', 'mousedown', 'touchstart',
      'pointerdown'
    ]
    .forEach(function (event) {
      anchor.addEventListener(event, function (e) {
        e.stopPropagation();
      });
    });
  };
}


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
  $(el).find('.info').each(function (index) {
    $(this).show('slow')
  });

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
  $(el).find('.info').each(function (index) {
    $(this).hide('slow')
  });

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

function setApplicationModal(prop_street, prop_zip, prop_city, prop_state, land_name, land_street, land_zip, land_city, land_state, land_email, land_phone, score) {
  $('#exampleModal .modal-body .spinner').hide();
  $('#exampleModal .modal-body').html(`
     <div class='container'>
     <div class='row py-2'>
     <div class='my-2 col-sm-4'>
      <h5>Property</h5>
      <div>` + prop_street + `</div>
      <div>` + prop_zip + ` ` + prop_city + `, ` + prop_state + `</div>
     </div>
     <div class='my-2 col-sm-4'>
      <h5>Landlord</h5>
      <div class='mb-1'><b>` + land_name + `</b></div>
      <div><i class='fa-icon fas fa-phone'></i> ` + format_phone_number(land_phone) + `</div>
      <div><i class='fa-icon fas fa-envelope'></i> <a href="mailto:` + land_email + `">` + land_email + ` </a></div>
      <div>` + land_street + `</div>
      <div>` + land_zip + ` ` + land_city + `, ` + land_state + `</div>
     </div>
     <div class='col-sm-4 p-3 d-flex justify-content-center align-items-center flex-column'>
      <div>Match Score</div>
      <div class='match-score__data'>` + score + `</div>
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
        <textarea class='form-control message'  style='width: 100%;' rows='10'></textarea>
      </div>
     </div>
     </div>
     `);
  $('#exampleModal .modal-title').text('Rental Application');
  $('#exampleModal .modal-btn').show().html('<i class="far fa-check-circle"></i>');
  $('#exampleModal .modal-btn__optional').show().html('<i class="far fa-save"></i>');
  $('#exampleModal .move_in_date').val(new Date().toJSON().slice(0, 10));
}


function addExpandMinimizeFunctionality() {
  $('.item').each(function (index) {
    var counter = 0;
    var window_width = $(window).width();

    // $(this).find('i').first().click(() => {

    //   $(this).find('i').first().toggleClass('fa-chevron-up');
    //   $(this).find('i').first().toggleClass('fa-chevron-down');

    //   if (window_width > 768) {
    //     if (counter % 2 == 0) {
    //       expand(this);
    //     } else {
    //       minimize(this);
    //     }
    //     console.log('round: ', counter);
    //     counter++;
    //   }


    // });
  });
}

function toggleIconExpand() {
  $('.item').each(function (index) {
    var window_width = $(window).width();

    if (window_width > 768) {
      $(this).find('i').first().show();
    } else {
      $(this).find('i').first().hide();

    }
  });
}

function format_phone_number(number) {
  var cleaned = ('' + number).replace(/\D/g, '')
  var match = cleaned.match(/^(\d{3})(\d{3})(\d{4})$/)
  if (match) {
    return '(' + match[1] + ') ' + match[2] + '-' + match[3]
  }
  return null
}

function get_properties(property_arr) {
  var url = base_path + "services/index.php?type=get_listed_properties";

  $.getJSON(url, function (properties) {
    property_arr = properties;
    build_property_list(properties);
  })
}

function build_property_list(properties) {
  var new_html = '';

  $.each(properties, function (indexInArray, property) {
    // console.log(property.property_id);
    var fav_icon = (property.is_favorite == 1) ? "fas" : "far";
    new_html += `
              <div id='`+property.property_id+`'class='col-md-4 col-sm-6 col-12 mb-2'>
              <div class='property_list_item'>
              <input type='hidden' class='property_id' value='` + property.property_id + `'>
              <h5 class='mb-0'>` + property.street + `</h5>
              <small class='d-block mb-2'><i class="fas fa-map-marker-alt icon_red"></i><span class='ml-1'>` + property.city + `, ` + property.state_name + `</span></small>
                <img src="` + base_path + `user_data/properties/images/rentzen.jpg" class="mx-auto d-block w-100" alt="Image">
                  <div class='mt-1 prop_info'>
                  <div class='d-flex justify-content-around'>

                        <div class='p-1 d-flex flex-column align-items-center'>
                            <i class="fas fa-vector-square"></i>
                            <small>` + property.sqft + `/sqft</small>
                          </div>

                          <div class='p-1 d-flex flex-column align-items-center'>
                          <i class="fas fa-bed"></i>
                          <small>` + property.beds + `</small>
                        </div>

                        <div class='p-1 d-flex flex-column align-items-center'>
                        <i class="fas fa-bath"></i>
                        <small>$` + property.baths + `</small>
                      </div>

                          <div class='p-1 d-flex flex-column align-items-center'>
                            <i class="fas fa-home"></i>
                            <small>` + property.typename + `</small>
                          </div>

                      </div>

                      <div class='d-flex justify-content-around'>

                        <div class='p-1 d-flex flex-column align-items-center'>
                        <i class="far fa-credit-card"></i>
                        <small>` + property.credit_requirement + `</small>
                      </div>

                      <div class='p-1 d-flex flex-column align-items-center'>
                      <i class="fas fa-money-check"></i>
                      <small>$` + parseFloat(property.income_requirement).toFixed(2) + `</small>
                    </div>

                        <div class='p-1 d-flex flex-column align-items-center'>
                          <i class="fas fa-dollar-sign"></i>
                          <small>$` + parseFloat(property.rental_fee).toFixed(2) + `</small>
                        </div>

                    </div>
                    </div>
                    <h4 class='prop_desc_heading'>Description</h4>
                    <p class='prop_desc'>` + property.description + `</p>
                    <div class='prop_buttons d-flex justify-content-around'>
                        <i class="icon__action icon_20 far fa-clipboard" data-toggle="modal" data-target="#exampleModal"></i>
                        <i id="heart_icon_`+property.property_id+`" onclick="toggleFavorite(`+property.property_id+`)" class="icon_red_20 `+fav_icon+` fa-heart"></i>
                    </div>
                </div>
              </div>`;

    // console.log(property);
  });

  // console.log(properties);
  if (!properties) {
    new_html = `
            <div style='min-height: 200px;' class='d-flex w-100 flex-column justify-content-center align-items-center p-3'>
              <i class='icon_red_40 fas fa-home'></i>
              <p>Did not find any properties within your proximity.</p>
            </div>
      `
  }

  $('#property_list').html(new_html);
  $('#property_list').show();
}

function toggleFavorite(id){
  $("#heart_icon_"+id).toggleClass("fas far");
}

function getGeoData(){
  var address = $("#search_address_input").val();
  var url = "https://maps.googleapis.com/maps/api/geocode/json?address="+encodeURI(address)+"&key=AIzaSyBkYy3QdqyYgHr8_jUiX8WEePPE5DGIQy8";
  $.getJSON(url, function(response){
    if(response.status == "OK"){
      pos = getPosition(response);
      map.setCenter(pos);
      my_location_marker.setPosition(pos);
    } else {
      console.error("Cannot Locate Address");
    }
  });
}

function getPosition(response){
  var data = response.results[0];
  return {
    lat: data.geometry.location.lat,
    lng: data.geometry.location.lng
  }
}