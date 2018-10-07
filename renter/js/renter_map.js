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

function setApplicationModal(prop_street, prop_zip, prop_city, prop_state, land_name, land_street, land_zip, land_city, land_state, score) {
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
        <input class='form-control' type='date'>
      </div>

      <div class='col-sm-6'>
        <h5>Move Out Date</h5>
        <input class='form-control' type='date'>
      </div>

     </div>
     <hr>
     <div class='row py-2'>
      <div class='col-12'>
        <h5>Message</h5>
        <textarea class='form-control'  style='width: 100%; min-width: 300px;' rows='10'></textarea>
      </div>
     </div>
     </div>
     `);
    $('#exampleModal .modal-title').text('Rental Application');
    $('#exampleModal .modal-btn').text('Submit Application');
    $('#exampleModal .modal-btn__optional').show().text('Save as Draft');
}


function addExpandMinimizeFunctionality() {
    $('.item').each(function (index) {
        var counter = 0;
        var window_width = $(window).width();

        $(this).find('i').first().click(() => {

            $(this).find('i').first().toggleClass('fa-chevron-up');
            $(this).find('i').first().toggleClass('fa-chevron-down');

            if (window_width > 768) {
                if (counter % 2 == 0) {
                    expand(this);
                } else {
                    minimize(this);
                }
                console.log('round: ', counter);
                counter++;
            }


        });
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

    $(document).on("click", ".icon__action", function () {
        $.getJSON("http://localhost/rentzen/services/?type=get_session_data").done((session_data) => {
            var current_prop_id = $(this).parents('.item').find('.property_id').val();
            current_renter_id = (session_data.PEOPLE_ID);

            $.getJSON("http://localhost/rentzen/services/?type=get_renter_prop&renter_id=" + current_renter_id + "&property_id=" + current_prop_id).done((renter_prop_data) => {
                console.log(renter_prop_data);
                if (renter_prop_data) {
                    setApplicationModal(prop_street = renter_prop_data.street, prop_zip = renter_prop_data.zip, prop_city = renter_prop_data.city, prop_state = renter_prop_data.state_name, land_name = 'Robins Property', land_street = '2234 North West Street', land_zip = '19121', land_city = 'Philly', land_state = 'PA', score = 8.9);
                } else {
                    console.error('FAILING STILL');
                }
            });

        });

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
