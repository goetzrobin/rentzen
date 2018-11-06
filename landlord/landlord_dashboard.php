<?php include '../view/header.php' ?>
<link href="./css/landlord_dashboard.css" rel="stylesheet">
<script src='./js/landlord_dashboard.js'></script>
<div class="container-fluid">
    <div class='row mx-1 my-3 justify-content-center'>
        <div class="col-md-8 shadow-sm p-3 bg-white rounded">
            <div class="row">
                <div class="col-md-10">
                    <div class='db_heading'>PROPERTIES</div>
                </div>
                <div class="p-3 col-md-2 d-flex justify-content-around">
                    <i class="prop__action__icon fas fa-sync"></i>
                    <i class="prop__action__icon fas fa-plus" data-toggle="modal" data-target="#addPropertyModal"></i>
                </div>
            </div>
                
                    <div id="accordion w-100">

                    <div class='d-flex w-100'>
                            <div class='list_header d-sm-block col-9 col-sm-6'>ADDRESS</div>
                            <div class='list_header d-none col-sm-3 d-sm-flex justify-content-sm-center'>STATUS</div>
                            <div class='list_header d-none d-sm-block col-sm-3'></div>
                    </div>

                    <?php foreach ($properties as $property) { ?>
                            <div class="card">
                                <div class="card-header" id="heading<?php echo $property['property_id']; ?>">
                                <h5 class="mb-0 prop_collapse">
                                    <div class='row w-100'>
                                        <div class='col-9 col-sm-6 overflow-hidden'>
                                            <button class="btn btn-link" data-toggle="collapse" data-target="#collapse<?php echo $property['property_id']; ?>" aria-expanded="true" aria-controls="collapse<?php echo $property['property_id']; ?> ">
                                            <h5 class='mb-0'> <?php echo $property['street']; ?></h5>
                                            <small class='ml-1'> <?php echo $property['zip']; ?> <?php echo $property['city']; ?>,  <?php echo $property['state_name']; ?></small>
                                            </button>
                                        </div>
                                        <div class="col-0 d-none col-sm-3 d-sm-flex justify-content-around align-items-center p-2">
                                            <?php 
                                                switch($property['propstat_id']) {
                                                    case 401: echo '<i class="fas fa-door-open text-black-50"></i>'; break;
                                                    case 402: echo '<i class="fas fa-door-closed text-black-50"></i>'; break;
                                                    case 403: echo '<i class="fas fa-clipboard-list text-black-50"></i>'; break;
                                                }
                                            ?>
                                        </div>
                                        <div class="col-3 col-sm-3 mt-3 mt-sm-0 d-flex justify-content-center justify-content-sm-around align-items-center p-2">
                                        <i class="prop__action__icon px-1 px-sm-0 fas fa-marker" data-toggle="modal" data-target="#editPropertyModal"
                                            data-propid="<?php echo $property['property_id']; ?>"
                                            data-street="<?php echo $property['street']; ?>"
                                            data-city="<?php echo $property['city']; ?>"
                                            data-state_id="<?php echo $property['state_id']; ?>"
                                            data-zip="<?php echo $property['zip']; ?>"
                                            data-beds="<?php echo $property['beds']; ?>"
                                            data-baths="<?php echo $property['baths']; ?>"
                                            data-sqft="<?php echo $property['sqft']; ?>"
                                            data-type_id="<?php echo $property['type_id']; ?>"
                                            data-propstat_id="<?php echo $property['propstat_id']; ?>"
                                            data-income_requirement="<?php echo $property['income_requirement']; ?>"
                                            data-credit_requirement="<?php echo $property['credit_requirement']; ?>"
                                            data-rental_fee="<?php echo $property['rental_fee']; ?>"
                                            data-description="<?php echo $property['description']; ?>"
                                            data-picture="<?php echo $property['picture']; ?>"
                                        ></i>
                                        <i class="prop__action__icon px-1 px-sm-0 fas fa-door-closed" data-toggle="modal" data-target="#removeFromMarketModal" data-id="<?php echo $property['property_id']; ?>"></i>
                                        <i class="prop__action__icon px-1 px-sm-0 fas fa-trash"  data-toggle="modal" data-target="#deleteModal"></i>
                                        </div>
                                    </div>
                                </h5>
                                </div>

                                <div id="collapse<?php echo $property['property_id']; ?>" class="collapse" aria-labelledby="heading<?php echo $property['property_id']; ?>" data-parent="#accordion">
                                <div class="card-body">
                                <div class='row'>
                                    <div class='col-sm-4'>
                                        <img src="../user_data/properties/images/rentzen.jpg" alt="..." class="img-thumbnail rounded">
                                    </div>
                                    <div class='col-sm-4'>
                                        <img src="../user_data/properties/images/rentzen.jpg" alt="..." class="img-thumbnail rounded">
                                    </div>
                                    <div class='col-sm-4'>
                                        <img src="../user_data/properties/images/rentzen.jpg" alt="..." class="img-thumbnail rounded">
                                    </div>
                                </div>
                                <div class='row mt-3'>
                                    <div class='col-12'><h5>Overall Information</h5></div>
                                    <div class='col-6 col-md-3 prop_info'>
                                        <i class='p-1 fas fa-bed'></i>
                                        <div><?php echo $property['beds']; ?></div>
                                    </div>
                                    <div class='col-6 col-md-3 prop_info'>
                                        <i class='p-1 fas fa-bath'></i>
                                        <div><?php echo $property['baths']; ?></div>
                                    </div>
                                    <div class='col-6 col-md-3 prop_info'>
                                        <i class='p-1 fas fa-vector-square'></i>
                                        <div><?php echo $property['sqft']; ?>sqft</div>
                                    </div>
                                    <div class='col-6 col-md-3 prop_info'>
                                        <i class='p-1 fas fa-home'></i>
                                        <div><?php echo $property['typename']; ?></div>
                                    </div>
                                    <div class='col-6 col-md-3 prop_info'>
                                        <i class='p-1 fas fa-door-open'></i>
                                        <div><?php echo $property['propertystat']; ?></div>
                                    </div>
                                    <div class='col-6 col-md-3 prop_info'>
                                        <i class='p-1 fas fa-money-bill'></i>
                                        <div>$ <?php echo number_format((float)$property['income_requirement'], 2, '.', ''); ?></div>
                                    </div>
                                    <div class='col-6 col-md-3 prop_info'>
                                        <i class='p-1 fas fa-money-check-alt'></i>
                                        <div><?php echo $property['credit_requirement']; ?></div>
                                    </div>
                                    <div class='col-6 col-md-3 prop_info'>
                                        <i class='p-1 fas fa-dollar-sign'></i>
                                        <div>$ <?php echo number_format((float)$property['rental_fee'], 2, '.', ''); ?></div>
                                    </div>
                                </div>
                                <div class='mt-3'>
                                    <h5>Description</h5>
                                    <p><?php echo $property['description']; ?></p>
                                </div>
                                </div>
                                </div>
                            </div>
                            <?php } ?>
                    </div>

        </div>
        <div class="col-md-4">
            <div class="row justify-content-center">
            <div class="col-md-10 shadow-sm p-3 bg-white rounded">
                <div class='d-flex justify-content-between pb-3'>
                <div class='db_heading'>APPLICATIONS</div>
                <div class="p-2 col-md-2 d-flex justify-content-center">
                    </div>
                <i class="prop__action__icon fas fa-sync"></i>
                </div>

              <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="home-tab" data-toggle="tab" href="#open-apps" role="tab" aria-controls="open-apps" aria-selected="true">Open</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="profile-tab" data-toggle="tab" href="#approved-apps" role="tab" aria-controls="approved-apps" aria-selected="false">Approved</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="contact-tab" data-toggle="tab" href="#rejected-apps" role="tab" aria-controls="rejected-apps" aria-selected="false">Rejected</a>
                    </li>
                </ul>
                    <div class="tab-content" id="app_tab">
                        <div class="tab-pane fade show active " id="open-apps" role="tabpanel" aria-labelledby="home-tab">
                                        
                        </div>
                        <div class="tab-pane fade " id="approved-apps" role="tabpanel" aria-labelledby="profile-tab">
                                
                        </div>
                        <div class="tab-pane fade " id="rejected-apps" role="tabpanel" aria-labelledby="contact-tab">   
                             
                    </div>
                    </div>

        </div>
    </div>
</div>'

<?php include '../view/footer.php' ?>


<?php /*
<!-- <?php if(!empty($submitted_applications)) { foreach ($submitted_applications as $application){ ?>
                                                        <div class="card my-2">
                                            <div class="card-header">
                                                <?php echo $application['street']; ?>
                                            </div>
                                            <div class="card-header">
                                                <?php echo $application['app_status_name']; ?>
                                            </div>
                                            <div class="card-body">
                                                <div class=""><?php echo $application['firstname'] . " " . $application['lastname'];?></div>
                                                <div class=""><?php echo $application['renter_message'] ?></div>
                                                <div class=''>
                                                    <div>Match Score</div>
                                                    <div><?php echo $application['renter_match_score'] ? $application['renter_match_score'] : "?.?" ; ?></div>
                                                </div>
                                            </div>
                                            <div class="card-footer d-flex justify-content-around">
                                            <a href="#" class="btn btn-secondary" style='width: 40px;' data-toggle="modal" data-target="#rejectApplicationModal" data-id='<?php echo $application['rental_application_id'];?>'><span hidden>Reject Application</span><i class='fa-icon fas fa-times'></i></a>
                                            <!-- <a href="#" class="btn btn-secondary" style='border-color: #eee; width: 40px; background-color: white'><i style='color: #8E0000' class='fa-icon fas fa-edit'></i></a> -->
                                            <a href="#" class="btn btn-secondary red" style='width: 40px;' data-toggle="modal" data-target="#approveApplicationModal" data-id='<?php echo $application['rental_application_id'];?>'><span hidden>Accept Application</span><i class='fa-icon fas fa-check'></i></a>
                                            </div>
                                            </div>
                                        <?php } ?>
                                        <?php } else { ?>
                                        <div class='error'>No open applications.</div>
                                        <?php } ?> -->

<?php if(!empty($approved_applications)) { foreach ($approved_applications as $application){ ?>
                                                    <div class="card my-2">
                                        <div class="card-header">
                                            <?php echo $application['street']; ?>
                                        </div>
                                        <div class="card-header">
                                            <?php echo $application['app_status_name']; ?>
                                        </div>
                                        <div class="card-body">
                                            <div class=""><?php echo $application['firstname'] . " " . $application['lastname'];?></div>
                                            <div class=""><?php echo $application['renter_message'] ?></div>
                                            <div class=''>
                                                <div>Match Score</div>
                                                <div><?php echo $application['renter_match_score'] ? $application['renter_match_score'] : "?.?" ; ?></div>
                                            </div>
                                        </div>
                                        <div class="card-footer d-flex justify-content-around">
                                        <a href="#" class="btn btn-secondary" style='width: 40px;' data-toggle="modal" data-target="#rejectApplicationModal" data-id='<?php echo $application['rental_application_id'];?>'><span hidden>Reject Application</span><i class='fa-icon fas fa-times'></i></a>
                                        <!-- <a href="#" class="btn btn-secondary" style='border-color: #eee; width: 40px; background-color: white'><i style='color: #8E0000' class='fa-icon fas fa-edit'></i></a> -->
                                        <a href="#" class="btn btn-secondary red" style='width: 40px;' data-toggle="modal" data-target="#approveApplicationModal" data-id='<?php echo $application['rental_application_id'];?>'><span hidden>Accept Application</span><i class='fa-icon fas fa-check'></i></a>
                                        </div>
                                        </div>
                                    <?php } ?>
                                    <?php } else { ?>
                                    <div class='error'>No approved applications.</div>
                                    <?php } ?>

                                              <?php if(!empty($rejected_applications)) { foreach ($rejected_applications as $application){ ?>
                                                        <div class="card my-2">
                                            <div class="card-header">
                                                <?php echo $application['street']; ?>
                                            </div>
                                            <div class="card-header">
                                                <?php echo $application['app_status_name']; ?>
                                            </div>
                                            <div class="card-body">
                                                <div class=""><?php echo $application['firstname'] . " " . $application['lastname'];?></div>
                                                <div class=""><?php echo $application['renter_message'] ?></div>
                                                <div class=''>
                                                    <div>Match Score</div>
                                                    <div><?php echo $application['renter_match_score'] ? $application['renter_match_score'] : "?.?" ; ?></div>
                                                </div>
                                            </div>
                                            <div class="card-footer d-flex justify-content-around">
                                            <a href="#" class="btn btn-secondary" style='width: 40px;' data-toggle="modal" data-target="#rejectApplicationModal" data-id='<?php echo $application['rental_application_id'];?>'><span hidden>Reject Application</span><i class='fa-icon fas fa-times'></i></a>
                                            <!-- <a href="#" class="btn btn-secondary" style='border-color: #eee; width: 40px; background-color: white'><i style='color: #8E0000' class='fa-icon fas fa-edit'></i></a> -->
                                            <a href="#" class="btn btn-secondary red" style='width: 40px;' data-toggle="modal" data-target="#approveApplicationModal" data-id='<?php echo $application['rental_application_id'];?>'><span hidden>Accept Application</span><i class='fa-icon fas fa-check'></i></a>
                                            </div>
                                            </div>
                                            <?php } ?>
                                        <?php } else { ?>
                                            <div class='error'>No rejected applications.</div>
                                        <?php }?>   
                     **/