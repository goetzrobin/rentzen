"use strict";

$(function () {

    var current_id;
    var element_opened_modal;


    $('#notification__badge').hide();
    $('.modal-btn__optional').hide();
    

    var states_option_html = "<option selected>Choose...</option>";
    $.getJSON(base_path + '/services/index.php?type=get_states').done((states) => {
        for (var i = 0; i < states.length; i++) {
            var current_state = states[i];
            states_option_html += ('<option value="' + current_state['state_id'] + '">' + current_state['state_name'] + "</option>");
        }

        $('#addPropertyModal #inputState').html(states_option_html);
        $('#editPropertyModal #edit_inputState').html(states_option_html);

    });

    var type_option_html = "<option selected>Choose...</option>";
    $.getJSON(base_path + '/services/index.php?type=get_property_type').done((types) => {
        for (var i = 0; i < types.length; i++) {
            var current_type = types[i];
            type_option_html += ('<option value="' + current_type['propertytype_id'] + '">' + current_type['typename'] + "</option>");
        }
        console.log(type_option_html);
        $('#addPropertyModal #type').html(type_option_html);
        $('#editPropertyModal #edit_type').html(type_option_html);

    });

    var status_option_html = "<option selected>Choose...</option>";
    $.getJSON(base_path + '/services/index.php?type=get_property_status').done((status) => {
        for (var i = 0; i < status.length; i++) {
            var current_status = status[i];
            status_option_html += ('<option value="' + current_status['propstat_id'] + '">' + current_status['propertystat'] + "</option>");
        }
        $('#addPropertyModal #status').html(status_option_html);
        $('#editPropertyModal #edit_status').html(status_option_html);
    });



    $('#removeFromMarketModal').on('show.bs.modal', function (event) {
        element_opened_modal = $(event.relatedTarget);
        var prop_id = element_opened_modal.data('id');
        current_id = prop_id;
    });
    $('#removeFromMarketModal .btn-primary').click((event) => {
        $.getJSON(base_path + '/services/index.php?type=set_property_status_occupied&prop_id=' + current_id).done((response) => {
            console.log('reloading data necessary');
            $('#removeFromMarketModal').modal('hide');

        });
    });

    $('#approveApplicationModal').on('show.bs.modal', function (event) {
        element_opened_modal = $(event.relatedTarget);
        var application_id = element_opened_modal.data('id');
        current_id = application_id;
    });
    $('#approveApplicationModal .btn-primary').click((event) => {
        console.log(current_id);
        $.getJSON(base_path + '/services/index.php?type=set_application_status_approved&app_id=' + current_id).done((response) => {
            console.log('reloading data necessary');
            $('#approveApplicationModal').modal('hide');
            location.reload();
        });
    });

    $('#rejectApplicationModal').on('show.bs.modal', function (event) {
        element_opened_modal = $(event.relatedTarget);
        var application_id = element_opened_modal.data('id');
        current_id = application_id;
    });
    $('#rejectApplicationModal .btn-primary').click((event) => {
        console.log(current_id);
        $.getJSON(base_path + '/services/index.php?type=set_application_status_rejected&app_id=' + current_id).done((response) => {
            console.log('reloading data necessary');
            $('#approveApplicationModal').modal('hide');
            location.reload();
        });
    });


    var submitted_applications = new Array();
    var rejected_applications = new Array();
    var approved_applications = new Array();

    var open_index = 0;
    var acc_index = 0;
    var rej_index = 0;

    var properties = new Array();

    get_applications(submitted_applications, rejected_applications, approved_applications);

    get_properties(properties);

    create_app_progress();

    // add event listener to application widget navigation
    $(".next_app").click(function (e) {
        e.preventDefault();


        if ($(e.currentTarget).attr('data') == 'open') {
            if (open_index < submitted_applications.length - 1) {
                open_index++;
                update_app_list('open-apps', submitted_applications[open_index]);
            }


        }
        if ($(e.currentTarget).attr('data') == 'rejected') {
            if (rej_index < rejected_applications.length - 1) {
                rej_index++;
                update_app_list('rejected-apps', rejected_applications[rej_index]);
            }
        }
        if ($(e.currentTarget).attr('data') == 'approved') {
            if (acc_index < approved_applications.length - 1) {
                acc_index++;
                update_app_list('approved-apps', approved_applications[acc_index]);
            }
        }
    });

    // add event listener to application widget navigation
    $(".last_app").click(function (e) {
        e.preventDefault();


        if ($(e.currentTarget).attr('data') == 'open') {
            if (open_index > 0) {
                open_index--;
                update_app_list('open-apps', submitted_applications[open_index]);
            }
        }
        if ($(e.currentTarget).attr('data') == 'rejected') {
            if (rej_index > 0) {
                rej_index--;
                update_app_list('rejected-apps', rejected_applications[rej_index]);
            }
        }
        if ($(e.currentTarget).attr('data') == 'approved') {
            if (acc_index > 0) {
                acc_index--;
                update_app_list('approved-apps', approved_applications[acc_index]);
            }
        }
    });

    //add event listner to application button accept
    $("#open_app_accept").click(function (e) {
        e.preventDefault();
        accept_application($(this).data('app_id'));

        submitted_applications = [];
        rejected_applications = [];
        approved_applications = [];

        open_index = 0;
        acc_index = 0;
        rej_index = 0;

        get_applications(submitted_applications, rejected_applications, approved_applications);
    });

    $("#open_app_reject").click(function (e) {
        e.preventDefault();
        reject_application($(this).data('app_id'));

        submitted_applications = [];
        rejected_applications = [];
        approved_applications = [];

        open_index = 0;
        acc_index = 0;
        rej_index = 0;

        get_applications(submitted_applications, rejected_applications, approved_applications);
    });

    $("#refresh_apps").click(function (e) {
        e.preventDefault();
        $("#refresh_apps").addClass('spinning');
        get_applications(submitted_applications, rejected_applications, approved_applications);
    });

    $("#refresh_props").click(function (e) {
        e.preventDefault();
        $("#refresh_props").addClass('spinning');
        properties = [];
        get_properties(properties);
    });

    $('#addPropertyModal').on('show.bs.modal', function (event) {
        reset_modal_add(states_option_html, status_option_html, type_option_html);
    });

    $('#editPropertyModal').on('show.bs.modal', function (event) {

        reset_modal_edit(states_option_html, status_option_html, type_option_html);

        element_opened_modal = $(event.relatedTarget);
        element_opened_modal.data('');
        var data_propid = element_opened_modal.data('propid')
        var data_street = element_opened_modal.data('street');
        var data_city = element_opened_modal.data('city');
        var data_state_id = element_opened_modal.data('state_id');
        var data_zip = element_opened_modal.data('zip');
        var data_beds = element_opened_modal.data('beds');
        var data_baths = element_opened_modal.data('baths');
        var data_sqft = element_opened_modal.data('sqft');
        var data_type_id = element_opened_modal.data('type_id');
        var data_propstat_id = element_opened_modal.data('propstat_id');
        var data_income_requirement = element_opened_modal.data('income_requirement');
        var data_credit_requirement = element_opened_modal.data('credit_requirement');
        var data_rental_fee = element_opened_modal.data('rental_fee');
        var data_description = element_opened_modal.data('description');
        var data_picture = element_opened_modal.data('picture');

        $('#editPropertyModal #edit_property_id').val(data_propid);
        $('#editPropertyModal #edit_inputAddress').val(data_street);
        $('#editPropertyModal #edit_inputCity').val(data_city);
        $('#editPropertyModal #edit_inputState').val(data_state_id);
        $('#editPropertyModal #edit_inputZip').val(data_zip);
        $('#editPropertyModal #edit_beds').val(data_beds);
        $('#editPropertyModal #edit_baths').val(data_baths);
        $('#editPropertyModal #edit_sqft').val(data_sqft);
        $('#editPropertyModal #edit_type').val(data_type_id);
        $('#editPropertyModal #edit_status').val(data_propstat_id);
        $('#editPropertyModal #edit_income_req').val(data_income_requirement);
        $('#editPropertyModal #edit_credit_score').val(data_credit_requirement);
        $('#editPropertyModal #edit_rental_fee').val(data_rental_fee);
        $('#editPropertyModal #edit_description').val(data_description);
    });

    $('#edit_form').submit(function(event){
        event.preventDefault();
        if(validate_form(this)){
            edit_property(event, properties);
        };
    });

    $('#add_form').submit(function(event) {
        event.preventDefault();
        if(validate_form(this)){
            create_property(event, properties);
        }
    });

    // $('#addPropertyModal .btn-secondary').click((event) => {
    //     $('#addPropertyModal').modal('hide');
    //     $('#addPropertyModal .btn-primary').show();
    //     $('#addPropertyModal .modal-body').html(add_default);
    // });

});

var update_app_list = function (type, application) {
    var $body = $('.' + type).find('.app_body');
    $body.find('h1').html(application.street);
    var message_text = application.renter_message ? application.renter_message : "This applicant did not leave a message.";

    $body.find('.message').html(message_text);

    $body.find('.info').html(
        "<div class='d-flex justify-content-between'>" +
        "<div>MOVE IN: " + application.move_in_date + "</div>" +
        "<div>MOVE OUT: " + ((application.move_out_date) ? application.move_out_date : "unknown ") + " </div>" +
        "</div>" +
        "<div>BY: " + application.firstname + " " + application.lastname + "</div>");

    if (type == 'open-apps') {
        $('#open_app_accept').data('app_id', application.rental_application_id);
        $('#open_app_reject').data('app_id', application.rental_application_id);
    }

}

var build_app_list_html = function (data_arr) {
    var html = "";
    $.each(data_arr, function (indexInArray, element) {
        html += build_single_app_html(element, indexInArray);
    });
    if (html.length == 0) {
        html = build_no_app_html();
    }
    return html
}

var get_applications = function (submitted_applications, rejected_applications, approved_applications) {


    var url = base_path + "services/index.php?type=get_application_data";
    $('#app_spinner').removeClass('d-none');
    $('#app_tab').addClass('d-none');
    $.getJSON(url,
        function (data, textStatus, jqXHR) {
            $.each(data, function (indexInArray, element) {
                switch (element.last_status_id) {
                    case "1":
                        submitted_applications.push(element);
                        break;
                    case "2":
                        rejected_applications.push(element);
                        break;
                    case "4":
                        approved_applications.push(element);
                        break;
                }
            });

            $('#app_spinner').addClass('d-none');
            $('#app_tab').removeClass('d-none');

            $("#refresh_apps").removeClass('spinning');

            display_array(submitted_applications, 'open-apps');
            display_array(rejected_applications, 'rejected-apps');
            display_array(approved_applications, 'approved-apps');

            create_app_progress(submitted_applications.length,rejected_applications.length,approved_applications.length)
        }
    );
}

var display_array = function (array, fieldname) {
    if (array.length > 0) {
        $('.' + fieldname).removeClass('d-none');
        $('.' + fieldname + '-empty').addClass('d-none');
        update_app_list(fieldname, array[0]);

    }
    if (array.length <= 0) {
        $('.' + fieldname).addClass('d-none');
        $('.' + fieldname + '-empty').removeClass('d-none');

    }
}

var accept_application = function (app_id) {
    var url = base_path + "services/index.php?type=set_application_status_approved&app_id=" + app_id;
    $.getJSON(url,
        function (data, textStatus, jqXHR) {
            console.log(data);
        }
    );
}

var reject_application = function (app_id) {
    var url = base_path + "services/index.php?type=set_application_status_rejected&app_id=" + app_id;

    $.getJSON(url,
        function (data, textStatus, jqXHR) {
            console.log(data)
        }
    );
}

var get_properties = function (properties) {
    var url = base_path + "services/index.php?type=get_properties";
    $('#prop_spinner').removeClass('d-none');
    $('#prop_list').addClass('d-none');
    $.getJSON(url,
        function (data, textStatus, jqXHR) {
            console.log(data);
            $.each(data, function (indexInArray, element) {
                properties.push(element)
            });

            $('#prop_spinner').addClass('d-none');
            $('#prop_list').removeClass('d-none');

            $("#refresh_props").removeClass('spinning');

            generate_property_list(properties);
            create_property_progress(properties);
        });
}

var generate_property_list = function (property_arr) {
    var html = "";
    $.each(property_arr, function (indexInArray, property) {
        html += `<div  class="card">
                                <div class="card-header" id="heading` + property.property_id + `">
                                <h5 class="mb-0 prop_collapse">
                                    <div class='row w-100'>
                                        <div class='col-9 col-sm-6 overflow-hidden'>
                                            <button class="btn btn-link" data-toggle="collapse" data-target="#collapse` + property.property_id + `" aria-expanded="true" aria-controls="collapse` + property.property_id + ` ">
                                            <h5 class='prop_heading mb-0'> ` + property.street + `</h5>
                                            <small class='prop_detail ml-1'> ` + property.zip + ` ` + property.city + `,  ` + property.state_name + `</small>
                                            </button>
                                        </div>
                                        <div class="col-0 d-none col-sm-3 d-sm-flex justify-content-around align-items-center p-2">
                                            `;

        switch (property.propstat_id) {
            case '401':
                html += '<i class="fas fa-door-open text-black-50"></i>';
                break;
            case '402':
                html += '<i class="fas fa-door-closed text-black-50"></i>';
                break;
            case '403':
                html += '<i class="fas fa-clipboard-list text-black-50"></i>';
                break;
        }
        html += `
                                        </div>
                                        <div class="col-3 col-sm-3 mt-3 mt-sm-0 d-flex justify-content-center justify-content-sm-around align-items-center p-2">
                                        <i class="prop__action__icon px-1 px-sm-0 fas fa-marker" data-toggle="modal" data-target="#editPropertyModal"
                                            data-propid="` + property.property_id + `"
                                            data-street="` + property.street + `"
                                            data-city="` + property.city + `"
                                            data-state_id="` + property.state_id + `"
                                            data-zip="` + property.zip + `"
                                            data-beds="` + property.beds + `"
                                            data-baths="` + property.baths + `"
                                            data-sqft="` + property.sqft + `"
                                            data-type_id="` + property.type_id + `"
                                            data-propstat_id="` + property.propstat_id + `"
                                            data-income_requirement="` + property.income_requirement + `"
                                            data-credit_requirement="` + property.credit_requirement + `"
                                            data-rental_fee="` + property.rental_fee + `"
                                            data-description="` + property.description + `"
                                            data-picture="` + property.picture + `"
                                        ></i>
                                        <i class="prop__action__icon px-1 px-sm-0 fas fa-door-closed" data-toggle="modal" data-target="#removeFromMarketModal" data-id="` + property.property_id + `"></i>
                                        <i class="prop__action__icon px-1 px-sm-0 fas fa-trash"  data-toggle="modal" data-target="#deleteModal"></i>
                                        </div>
                                    </div>
                                </h5>
                                </div>

                                <div id="collapse` + property.property_id + `" class="collapse" aria-labelledby="heading` + property.property_id + `" data-parent="#accordion">
                                <div class="card-body">
                                <div class='row'>
                                    <div class='col-sm-12'>
                                        <img src="../user_data/properties/images/rentzen.jpg" alt="..." class="img-thumbnail rounded">
                                    </div>
                                </div>
                                <div class='row mt-3'>
                                    <div class='col-12'><h5>Overall Information</h5></div>
                                    <div class='col-6 col-md-3 prop_info'>
                                        <i class='p-1 fas fa-bed'></i>
                                        <div>` + property.beds + `</div>
                                    </div>
                                    <div class='col-6 col-md-3 prop_info'>
                                        <i class='p-1 fas fa-bath'></i>
                                        <div>` + property.baths + `</div>
                                    </div>
                                    <div class='col-6 col-md-3 prop_info'>
                                        <i class='p-1 fas fa-vector-square'></i>
                                        <div>` + property.sqft + `sqft</div>
                                    </div>
                                    <div class='col-6 col-md-3 prop_info'>
                                        <i class='p-1 fas fa-home'></i>
                                        <div>` + property.typename + `</div>
                                    </div>
                                    <div class='col-6 col-md-3 prop_info'>
                                        <i class='p-1 fas fa-door-open'></i>
                                        <div>` + property.propertystat + `</div>
                                    </div>
                                    <div class='col-6 col-md-3 prop_info'>
                                        <i class='p-1 fas fa-money-bill'></i>
                                        <div>$ ` + property.income_requirement + `</div>
                                    </div>
                                    <div class='col-6 col-md-3 prop_info'>
                                        <i class='p-1 fas fa-money-check-alt'></i>
                                        <div>` + property.credit_requirement + `</div>
                                    </div>
                                    <div class='col-6 col-md-3 prop_info'>
                                        <i class='p-1 fas fa-dollar-sign'></i>
                                        <div>$ ` + property.rental_fee + `</div>
                                    </div>
                                </div>
                                <div class='mt-3'>
                                    <h5>Description</h5>
                                    <p>` + property.description + `</p>
                                </div>
                                </div>
                                </div>
                            </div>`
    });

    $('#property_container').html(html);
}

var create_property = function (event, properties) {
    var $form = $('#add_form');
    event.preventDefault();
    console.log($form.serializeArray());
    $.post(base_path + "/services/index.php?type=post_new_prop_form", $form.serializeArray())
        .done((res) => {
            $('#addPropertyModal .modal-footer').hide();
            $('#addPropertyModal .modal-body').html(`
      <div class="d-flex justify-content-center align-items-center">
        <i class='fas fa-check-circle mr-2 icon_red_40'></i>
        <div>` + res + `</div>`);
            properties = [];
            get_properties(properties);
            setTimeout(() => {
                $('#addPropertyModal').modal('hide');
            }, 800);

        });
}

var edit_property = function (event, properties) {
    var $form = $('#edit_form');
    event.preventDefault();
    console.log($form.serialize());
    $.post(base_path + "/services/index.php?type=post_edit_prop_form", $form.serializeArray())
        .done((res) => {
            console.log(res);
            $('#editPropertyModal .modal-footer').hide();
            $('#editPropertyModal .modal-body').html(`
                    <div class="d-flex justify-content-center align-items-center">
                        <i class='fas fa-check-circle mr-2 icon_red_40'></i>
                        <div>` + res + `</div>`);
            properties = [];
            get_properties(properties);
            setTimeout(() => {
                $('#editPropertyModal').modal('hide');
            }, 800);


        });
}

var reset_modal_edit = function (states_option_html, status_option_html, type_option_html) {
    var edit_default = ` 
    <input type="hidden" id='edit_property_id' name="property_id" type='number'>
    <div class="form-group">
      <label for="edit_inputAddress">Address</label>
      <input type="text" class="form-control" id="edit_inputAddress" name="inputAddress" placeholder="1234 Main St">
      <div class='invalid-feedback'>Test</div>
    </div>
    <div class="form-row">
      <div class="form-group col-md-6">
        <label for="edit_inputCity">City</label>
        <input type="text" class="form-control" id="edit_inputCity" name="inputCity">
        <div class='invalid-feedback'>Test</div>
      </div>
      <div class="form-group col-md-4">
        <label for="edit_inputState">State</label>
        <select id="edit_inputState" name="inputState" class="form-control">` + states_option_html + `</select>
        <div class='invalid-feedback'>Test</div>
      </div>
      <div class="form-group col-md-2">
        <label for="edit_inputZip">Zip</label>
        <input type="text" class="form-control" id="edit_inputZip" name="inputZip">
        <div class='invalid-feedback'>Test</div>
      </div>
    </div>


    <div class="form-row">
      <div class="form-group col-sm-3">
        <label for="edit_beds">Beds</label>
        <input type="number" class="form-control" id="edit_beds" name="beds" min='0' value='0'>
        <div class='invalid-feedback'>Test</div>
      </div>
      <div class="form-group col-sm-3">
        <label for="edit_baths">Baths</label>
        <input type="number" class="form-control" id="edit_baths" name="baths" min='0' value='0' step='0.5'>
        <div class='invalid-feedback'>Test</div>
      </div>
      <div class="form-group col-sm-3">
        <label for="edit_sqft">Square Feet</label>
        <input type="number" class="form-control" id="edit_sqft" name="sqft"  min='0' value='0'>
        <div class='invalid-feedback'>Test</div>
      </div>
      <div class="form-group col-sm-3">
      <label for="edit_type">Type</label>
        <select id="edit_type" name="type" class="form-control">` + type_option_html + `
        </select>
        <div class='invalid-feedback'>Test</div>
        </div>
    </div>

     <div class="form-row">
      <div class="form-group col-sm-3">
      <label for="edit_status">Status</label>
        <select id="edit_status" name="status" class="form-control">` + status_option_html + `
        </select>
        <div class='invalid-feedback'>Test</div>
      </div>
      <div class="form-group col-sm-3">
        <label for="edit_income_req">Income Req.</label>
        <input type="number" class="form-control" id="edit_income_req" name="income_req" min='0' value='0' step='0.01'>
        <div class='invalid-feedback'>Test</div>
      </div>
      <div class="form-group col-sm-3">
        <label for="edit_credit_score">Credit Score</label>
          <input type="number" class="form-control" id="edit_credit_score" name="credit_score" min='0' max='800' value='0' step='1'>
          <div class='invalid-feedback'>Test</div>
      </div>
      <div class="form-group col-sm-3">
        <label for="edit_rental_fee">Rental Fee</label>
        <input type="number" class="form-control" id="edit_rental_fee" name="rental_fee" min='0' value='0' step='0.01'>
        <div class='invalid-feedback'>Test</div>
      </div>
    </div>

      <div class="form-group">
        <label for="edit_description">Description</label>
        <textarea class="form-control" id="edit_description" name='description' rows="3"></textarea>
        <div class='invalid-feedback'>Test</div>
      </div>`;

    $('#editPropertyModal .modal-body').html(edit_default);
    $('#editPropertyModal .modal-footer').show();

}

var reset_modal_add = function (states_option_html, status_option_html, type_option_html) {
    var add_default = `
                <div class="form-group">
                    <label for="addinputAddress">Address</label>
                    <input type="text" class="form-control" id="addinputAddress" name="inputAddress" placeholder="1234 Main St">
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                    <label for="inputCity">City</label>
                    <input type="text" class="form-control" id="inputCity" name="inputCity">
                    </div>
                    <div class="form-group col-md-4">
                    <label for="inputState">State</label>
                    <select id="inputState" name="inputState" class="form-control">
                    </select>
                    </div>
                    <div class="form-group col-md-2">
                    <label for="inputZip">Zip</label>
                    <input type="text" class="form-control" id="inputZip" name="inputZip">
                    </div>
                </div>


                <div class="form-row">
                    <div class="form-group col-sm-3">
                    <label for="beds">Beds</label>
                    <input type="number" class="form-control" id="beds" name="beds" min='0' value='0'>
                    </div>
                    <div class="form-group col-sm-3">
                    <label for="baths">Baths</label>
                    <input type="number" class="form-control" id="baths" name="baths" min='0' value='0' step='0.5'>
                    </div>
                    <div class="form-group col-sm-3">
                    <label for="sqft">Square Feet</label>
                    <input type="number" class="form-control" id="sqft" name="sqft"  min='0' value='0'>
                    </div>
                    <div class="form-group col-sm-3">
                    <label for="type">Type</label>
                    <select id="type" name="type" class="form-control">
                        <option selected>Choose...</option>
                        <option>...</option>
                    </select>
                    <div class='invalid-feedback'>Test</div>   </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-sm-3">
                    <label for="status">Status</label>
                    <select id="status" name="status" class="form-control">
                        <option selected>Choose...</option>
                        <option>...</option>
                    </select>
                    <div class='invalid-feedback'>Test</div>
                    </div>
                    <div class="form-group col-sm-3">
                    <label for="income_req">Income Req.</label>
                    <input type="number" class="form-control" id="income_req" name="income_req" min='0' value='0' step='0.01'>
                    <div class='invalid-feedback'>Test</div>
                    </div>
                    <div class="form-group col-sm-3">
                    <label for="credit_score">Credit Score</label>
                        <input type="number" class="form-control" id="credit_score" name="credit_score" min='300' max='850' value='300' step='1'>
                        <div class='invalid-feedback'>Test</div>
                    </div>
                    <div class="form-group col-sm-3">
                    <label for="rental_fee">Rental Fee</label>
                    <input type="number" class="form-control" id="rental_fee" name="rental_fee" min='0' value='0' step='0.01'>
                    <div class='invalid-feedback'>Test</div>
                    </div>
                </div>

                    <div class="form-group">
                    <label for="description">Description</label>
                    <textarea class="form-control" id="description" name='description' rows="3"></textarea>
                    <div class='invalid-feedback'>Test</div>
                    </div>`;

    $('#addPropertyModal .modal-body').html(add_default);
    $('#addPropertyModal .modal-footer').show();
    $('#addPropertyModal #inputState').html(states_option_html);
    $('#addPropertyModal #type').html(type_option_html);
    $('#addPropertyModal #status').html(status_option_html);
}

var create_app_progress = function(submitted_applications_length,rejected_applications_length,accepted_application_length){
        var data = {
            datasets: [{
                data: [submitted_applications_length, rejected_applications_length,accepted_application_length],
                backgroundColor: ["#333", "#CCC", "#8E0000"]
            }],
        
            // These labels appear in the legend and in the tooltips when hovering different arcs
            labels: [
                'Submitted',
                'Rejected',
                'Approved'
            ]
        };
        
        var ctx = document.getElementById("myAppProgress").getContext('2d');
        var myPieChart = new Chart(ctx,{
            type: 'pie',
            data: data,
            options: {cutoutPercentage: 50, legend: {position: 'bottom'}}
        });
}

var create_property_progress = function(properties){
    var listed_count = 0;
    var occupied_count = 0;
    var vacant_count = 0;

    $.each(properties, function (indexInArray, property) { 
         switch(property.propstat_id){
             case "401": vacant_count++; break;
             case "402": occupied_count++; break;
             case "403": listed_count++; break;
         }
    });

    var data = {
        datasets: [{
            data: [listed_count, occupied_count,vacant_count],
            backgroundColor: ["#8E0000", "#CCC", "#333"]
        }],
    
        // These labels appear in the legend and in the tooltips when hovering different arcs
        labels: [
            'Listed',
            'Occupied',
            'Vacant'
        ]
    };
    
    var ctx = document.getElementById("myPropProgress").getContext('2d');
    var myPieChart = new Chart(ctx,{
        type: 'pie',
        data: data,
        options: {cutoutPercentage: 50, legend: {position: 'bottom'}}
    });

}

var validate_form = function(the_form){
    console.log(the_form);
    console.log(the_form.inputZip.value.length);
    var is_valid = true;
    if(the_form.inputAddress.value == ""){
        $(the_form.inputAddress).addClass('is-invalid');
        is_valid = false;
    } else {
        $(the_form.inputAddress).removeClass('is-invalid');
    }

    if(the_form.inputCity.value == ""){
        $(the_form.inputCity).addClass('is-invalid');
        is_valid = false;
    } else {
        $(the_form.inputCity).removeClass('is-invalid');
    }

    if(the_form.inputState.value == ""){
        $(the_form.inputState).addClass('is-invalid');
        is_valid = false;
    } else {
        $(the_form.inputState).removeClass('is-invalid');
    }
    
    var zip_length = the_form.inputZip.value.length;
    if( zip_length < 5 || zip_length > 10 ){
        $(the_form.inputZip).addClass('is-invalid');
        is_valid = false;
    } else {
        $(the_form.inputZip).removeClass('is-invalid');
    }

    if( the_form.beds.value < 1){
        $(the_form.beds).addClass('is-invalid');
        is_valid = false;
    } else {
        $(the_form.beds).removeClass('is-invalid');
    }

    if( the_form.baths.value < 1){
        $(the_form.baths).addClass('is-invalid');
        is_valid = false;
    } else {
        $(the_form.baths).removeClass('is-invalid');
    }

    if( the_form.sqft.value < 100){
        $(the_form.sqft).addClass('is-invalid');
        is_valid = false;
    } else {
        $(the_form.inputZip).removeClass('is-invalid');
    }

    if( the_form.type = ''){
        $(the_form.type).addClass('is-invalid');
        is_valid = false;
    } else {
        $(the_form.type).removeClass('is-invalid');
    }

    if( the_form.status = ''){
        $(the_form.status).addClass('is-invalid');
        is_valid = false;
    } else {
        $(the_form.status).removeClass('is-invalid');
    }

    if( the_form.income_req.value < 0){
        $(the_form.income_req).addClass('is-invalid');
        is_valid = false;
    } else {
        $(the_form.income_req).removeClass('is-invalid');
    }

    if( the_form.credit_score.value < 300 || the_form.credit_score.value > 850){
        $(the_form.credit_score).addClass('is-invalid');
        is_valid = false;
    } else {
        $(the_form.credit_score).removeClass('is-invalid');
    }

    if( the_form.rental_fee.value < 0){
        $(the_form.rental_fee).addClass('is-invalid');
        is_valid = false;
    } else {
        $(the_form.rental_fee).removeClass('is-invalid');
    }

    if( the_form.description.value == ""){
        $(the_form.description).addClass('is-invalid');
        is_valid = false;
    } else {
        $(the_form.description).removeClass('is-invalid');
    }



    return is_valid;
}