$(function () {
    var submitted_applications = new Array();
    var rejected_applications = new Array();
    var accepted_applications = new Array();

    var open_index = 0;
    var acc_index = 0;
    var rej_index = 0;


    get_applications(submitted_applications, rejected_applications, accepted_applications);

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
        if ($(e.currentTarget).attr('data') == 'accepted') {
            if (acc_index < accepted_applications.length - 1) {
                acc_index++;
                update_app_list('accepted-apps', accepted_applications[acc_index]);
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
        if ($(e.currentTarget).attr('data') == 'accepted') {
            if (acc_index > 0) {
                acc_index--;
                update_app_list('accepted-apps', accepted_applications[acc_index]);
            }
        }
    });

    //add event listner to application button accept
    $("#open_app_accept").click(function (e) {
        e.preventDefault();
        console.log($(this).data('app_id'));
    })

    $("#open_app_reject").click(function (e) {
        e.preventDefault();
        console.log($(this).data('app_id'));
    })

    $("#refresh_apps").click(function (e) {
        e.preventDefault();
        get_applications(submitted_applications, rejected_applications, accepted_applications);
    })
});

var update_app_list = function (type, application) {
    var $body = $('.' + type).find('.app_body');
    $body.find('h1').html(application.street);
    console.log(application);
    var message_text = application.renter_message ? application.renter_message : "This applicant did not leave a message.";

    $body.find('.message').html(message_text);

    $body.find('.info').html(
        "<div class='d-flex justify-content-between'>" +
        "<div>MOVE IN: " + application.move_in_date + "</div>" +
        "<div>MOVE OUT: " + ((application.move_out_date) ? application.move_out_date : "unknown ") + " </div>" +
        "</div>" +
        "<div>BY: " + application.firstname + " " + application.lastname + "</div>");

    if (type == 'open-apps') {
        console.log('setting app_id', application.rental_application_id);
        $('#open_app_accept').data('app_id', application.rental_application_id);
        $('#open_app_reject').data('app_id', application.rental_application_id);
    }

}

var build_app_list_html = function (data_arr) {
    var html = "";
    $.each(data_arr, function (indexInArray, element) {
        html += build_single_app_html(element, indexInArray);
    });
    // console.log(html);
    if (html.length == 0) {
        html = build_no_app_html();
    }
    return html
}

var get_applications = function (submitted_applications, rejected_applications, accepted_applications) {

    submitted_applications = new Array();
    rejected_applications = new Array();
    accepted_applications = new Array();

    url = base_path + "services/index.php?type=get_application_data";
    // console.log(url);
    $('#app_spinner').removeClass('d-none');
    $('#app_tab').addClass('d-none');
    $.getJSON(url,
        function (data, textStatus, jqXHR) {
            // console.log(data);
            $.each(data, function (indexInArray, element) {
                switch (element.app_status_id) {
                    case "1":
                        submitted_applications.push(element);
                        break;
                    case "2":
                        rejected_applications.push(element);
                        break;
                    case "3":
                        accepted_applications.push(element);
                        break;
                }
            });

            $('#app_spinner').addClass('d-none');
            $('#app_tab').removeClass('d-none');
            display_array(submitted_applications, 'open-apps');
            display_array(rejected_applications, 'rejected-apps');
            display_array(accepted_applications, 'accepted-apps');
        }
    );
}

var display_array = function (array, fieldname) {
    if (array.length > 0) {
        console.log(array.length);
        $('.' + fieldname).removeClass('d-none');
        $('.' + fieldname + '-empty').addClass('d-none');
        update_app_list(fieldname, array[0]);

    }
    if (array.length <= 0) {
        console.log(array.length);
        $('.' + fieldname).addClass('d-none');
        $('.' + fieldname + '-empty').removeClass('d-none');

    }
}