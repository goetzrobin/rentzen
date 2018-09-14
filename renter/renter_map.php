<?php include '../common/configuration.php';
session_start();
if ((int)$_SESSION['ROLE_ID'] !== ROLE_ID_RENTER) {
    header("Location: " . $base_path);
}
?>
<?php include '../view/header.php' ?>
<link href="./css/renter_map.css" rel="stylesheet">

<div class='container-fluid'>
  <div class='row'>
    <div class='col mt-3 mb-3'>
      <div id="search">

        <form class='search_form'>
        <div class='search_form_item'>
            <div class='search_form_description'>THIS IS</div>
            <div class='search_form_data'>An Apartment</div>
          </div>

            <div class='search_form_item'>
            <div class='search_form_description'>LOCATED IN</div>
            <div class='search_form_data'>Neighborhood</div>
          </div>

            <div class='search_form_item'>
            <div class='search_form_description'>WITH</div>
            <div class='search_form_data'>2 - Beds / 1 - Bath</div>
          </div>

          <div class='search_form_item'>
            <div class='search_form_description'>MY BUDGET IS:</div>
            <div class='search_form_data'>$100 - $1000</div>
          </div>

          <div class='search_form_item'>
            <div class='search_form_data'>More Filters</div>
          </div>

          <div class='search_form_item'>
            <button class='btn red'>Search</button>
          </div>

        </form>

    </div> <!-- end searchbar -->
  </div>
</div>
<div class='row'>
  <div class='col-md-4 order-last'>
    <div id="list">
      <h4>Results</h4>
      <div class='placeholder'>Placeholder</div>
      <div class='placeholder'>Placeholder</div>
      <div class='placeholder'>Placeholder</div>
      <div class='placeholder'>Placeholder</div>
      <div class='placeholder'>Placeholder</div>
      <div class='placeholder'>Placeholder</div>
      <div class='placeholder'>Placeholder</div>
      <div class='placeholder'>Placeholder</div>
    </div>
  </div>
  <div class='col-md-8 mb-2'>
    <div id="map"></div>
  </div>
</div>
</div>

<script>
  var map;

  function initMap() {
    map = new google.maps.Map(document.getElementById('map'), {
      center: {
        lat: -34.397,
        lng: 150.644
      },
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


  }
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCBGe2Qu6G_eINiYN28_igiiifEKRmj8uw&callback=initMap"
  async defer></script>
<?php include '../view/footer.php' ?>