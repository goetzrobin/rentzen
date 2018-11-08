<?php include '../view/header.php' ?>
<link href="./css/landlord_dashboard.css" rel="stylesheet">
<script src='./js/landlord_dashboard.js'></script>
<div class="container-fluid">
    <div class='row mx-1 my-3 justify-content-center'>
        <div class="col-md-8 shadow-sm p-3 bg-white rounded my-1">
            <div class="row">
                <div class="col-md-10">
                    <div class='db_heading'>PROPERTIES</div>
                </div>
                <div class="p-3 col-md-2 d-flex justify-content-around">
                    <i id='refresh_props' class="prop__action__icon fas fa-sync"></i>
                    <i class="prop__action__icon fas fa-plus" data-toggle="modal" data-target="#addPropertyModal"></i>
                </div>
            </div>
                    <div id="prop_spinner" class="spinner"></div>
                    <div id="prop_list" class="accordion w-100">

                    <div class='d-flex w-100'>
                            <div class='list_header d-sm-block col-9 col-sm-6'>ADDRESS</div>
                            <div class='list_header d-none col-sm-3 d-sm-flex justify-content-sm-center'>STATUS</div>
                            <div class='list_header d-none d-sm-block col-sm-3'></div>
                    </div>

                    <div id='property_container'></div>
                    </div>

        </div>
        <div class="col-md-4 my-1">
            <div class="row justify-content-center">
            <div class="col-md-10 shadow-sm p-3 bg-white rounded">
                <div class='d-flex justify-content-between pb-3'>
                <div class='db_heading'>APPLICATIONS</div>
                <div class="p-2 col-md-2 d-flex justify-content-center">
                    </div>
                <i id='refresh_apps' class="prop__action__icon fas fa-sync"></i>
                </div>

              <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="open-tab" data-toggle="tab" href="#open-apps" role="tab" aria-controls="open-apps" aria-selected="true">Open</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="approved-tab" data-toggle="tab" href="#approved-apps" role="tab" aria-controls="approved-apps" aria-selected="false">Approved</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="rejected-tab" data-toggle="tab" href="#rejected-apps" role="tab" aria-controls="rejected-apps" aria-selected="false">Rejected</a>
                    </li>
                </ul>
                    <div id='app_spinner' class='spinner'></div>
                    <div class="tab-content d-none" id="app_tab">
                        <div class="tab-pane fade show active " id="open-apps" role="tabpanel" aria-labelledby="open-tab">
                            <div class='open-apps apps_container container d-none'>
                                <div class='row'>
                                    <div class='col-12'>
                                        <div class='app_navigation open'>
                                            <a class='app_navigation_arrow last_app' data='open' href=''><i class='fas fa-angle-left'></i></a>
                                            <a class='app_navigation_arrow next_app' data='open' href=''><i class='fas fa-angle-right'></i></a>
                                        </div>
                                        <div class='app_body'>
                                            <div class='heading'>OPEN APPLICATION</div>
                                                <h1>1604 Willington Street, 19121 Philadelphia PA</h1>
                                                <div class='info'>RECEIVED ON 10/11/2018 BY JESSIE JAMES</div>
                                                <div class=message>
                                                    Lorem, ipsum dolor sit amet consectetur adipisicing elit. Aut, nulla molestiae et ratione magnam tempora sequi 
                                                    labore pariatur illo maxime sit quae suscipit beatae non quis omnis perferendis cumque odio?
                                                </div>
                                        </div>
                                        <div class='app_buttons'>
                                            <button id='open_app_accept' class='btn btn-primary red'><i class='fas fa-check'></i></button>
                                            <button id='open_app_reject' class='btn btn-primary red'><i class='fas fa-times'></i></button>
                                        </div>
                                    </div>
                                    </div>
                            </div>
                            <div class='apps-empty open-apps-empty'><i class='fas fa-info icon_red_40'></i><div>No Applications to be displayed...</div></div>
                        </div>
                        <div class="tab-pane fade " id="approved-apps" role="tabpanel" aria-labelledby="approved-tab">
                        <div class='approved-apps apps_container container d-none'>
                                <div class='row'>
                                    <div class='col-12'>
                                        <div class='app_navigation'>
                                            <a class='app_navigation_arrow last_app' data='approved' href=''><i class='fas fa-angle-left'></i></a>
                                            <a class='app_navigation_arrow next_app' data='approved' href=''><i class='fas fa-angle-right'></i></a>
                                        </div>
                                        <div class='app_body approved'>
                                            <div class='heading'>APPROVED APPLICATION</div>
                                                <h1>1604 Willington Street, 19121 Philadelphia PA</h1>
                                                <div class='info'>RECEIVED ON 10/11/2018 BY JESSIE JAMES</div>
                                                <div class=message>
                                                    Lorem, ipsum dolor sit amet consectetur adipisicing elit. Aut, nulla molestiae et ratione magnam tempora sequi 
                                                    labore pariatur illo maxime sit quae suscipit beatae non quis omnis perferendis cumque odio?
                                                </div>
                                        </div>
                                        <div class='app_buttons'>
                                            <!-- <button class='btn btn-primary'><i class='fas fa-check'></i></button>
                                            <button class='btn btn-primary'><i class='fas fa-times'></i></button> -->
                                        </div>
                                    </div>
                                    </div>
                            </div>
                            <div class='apps-empty approved-apps-empty'><i class='fas fa-info icon_red_40'></i><div>No Applications to be displayed...</div></div>
                        </div>
                        <div class="tab-pane fade " id="rejected-apps" role="tabpanel" aria-labelledby="rejected-tab">   
                        <div class='rejected-apps apps_container container d-none'>
                                <div class='row'>
                                    <div class='col-12'>
                                        <div class='app_navigation'>
                                            <a class='app_navigation_arrow last_app' data='rejected' href=''><i class='fas fa-angle-left'></i></a>
                                            <a class='app_navigation_arrow next_app' data='rejected' href=''><i class='fas fa-angle-right'></i></a>
                                        </div>
                                        <div class='app_body rejected'>
                                            <div class='heading'>REJECTED APPLICATION</div>
                                                <h1>1604 Willington Street, 19121 Philadelphia PA</h1>
                                                <div class='info'>RECEIVED ON 10/11/2018 BY JESSIE JAMES</div>
                                                <div class=message>
                                                    Lorem, ipsum dolor sit amet consectetur adipisicing elit. Aut, nulla molestiae et ratione magnam tempora sequi 
                                                    labore pariatur illo maxime sit quae suscipit beatae non quis omnis perferendis cumque odio?
                                                </div>
                                        </div>
                                        <div class='app_buttons'>
                                        </div>
                                    </div>
                                    </div>
                            </div>
                            <div class='apps-empty rejected-apps-empty'><i class='fas fa-info icon_red_40'></i><div>No Applications to be displayed...</div></div>
                    </div>
                    </div>

        </div>
    </div>
</div>

<?php include '../view/footer.php' ?>
