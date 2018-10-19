//JQUERY
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
    current_prop_id = $(this).parents('.item').find('.property_id').val();
    console.log(current_prop_id);
    url = base_path + "/services/index.php?type=set_property_renter_relationship&prop_id=" + current_prop_id;
    $.getJSON(url).done((response) => {
      console.log('response', response);
      if (response.result) {

        /////////////////////
        var url = base_path + "/services/?type=get_prop_data&prop_id=" + current_prop_id;
        console.log('getting data');
        $.getJSON(url).done((renter_prop_data) => {
          console.log(renter_prop_data);
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
        console.error("FAILED TO ESTABLISH RELATIONSHIP");
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
});




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
     <div class='col-sm-4'>
      <h5>Property</h5>
      <div>` + prop_street + `</div>
      <div>` + prop_zip + ` ` + prop_city + `, ` + prop_state + `</div>
     </div>
     <div class='col-sm-4'>
      <h5>Landlord</h5>
      <div class='mb-1'><b>` + land_name + `</b></div>
      <div><i class='fa-icon fas fa-phone'></i> ` + format_phone_number(land_phone) + `</div>
      <div><i class='fa-icon fas fa-envelope'></i> <a href="mailto:` + land_email + `">` + land_email + ` </a></div>
      <div>` + land_street + `</div>
      <div>` + land_zip + ` ` + land_city + `, ` + land_state + `</div>
     </div>
     <div class='col-sm-4 d-flex justify-content-center align-items-center' style='flex-direction: column'>
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
        <textarea class='form-control message'  style='width: 100%; min-width: 300px;' rows='10'></textarea>
      </div>
     </div>
     </div>
     `);
  $('#exampleModal .modal-title').text('Rental Application');
  $('#exampleModal .modal-btn').show().text('Submit Application');
  $('#exampleModal .modal-btn__optional').show().text('Save as Draft');
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