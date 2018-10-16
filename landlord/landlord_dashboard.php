<?php include '../view/header.php' ?>
<link href="./css/landlord_dashboard.css" rel="stylesheet">
<script src='./js/landlord_dashboard.js'></script>
<div class="container-fluid">
    <div class='row mt-3'>
    <div class="col-md-8">
        <div class="row">
            <div class="col-md-10">
                <h5>Your Properties</h5>
            </div>
            <div class="p-3 col-md-2 d-flex justify-content-around">
                <i class="prop__action__icon fas fa-sync"></i>
                <i class="prop__action__icon fas fa-plus" data-toggle="modal" data-target="#addPropertyModal"></i>
            </div>
        </div>
                
            <div id="accordion w-100">
            <?php foreach ($properties as $property) { ?>
                    <div class="card">
                        <div class="card-header" id="heading<?php echo $property['property_id']; ?>">
                        <h5 class="mb-0 prop_collapse">
                            <div class='row w-100'>
                                <div class='col-sm-9'>
                                    <button class="btn btn-link" data-toggle="collapse" data-target="#collapse<?php echo $property['property_id']; ?>" aria-expanded="true" aria-controls="collapse<?php echo $property['property_id']; ?> ">
                                    <h5 class='mb-0'> <?php echo $property['street']; ?></h5>
                                    <small class='ml-1'> <?php echo $property['zip']; ?> <?php echo $property['city']; ?>,  <?php echo $property['state_name']; ?></small>
                                    </button>
                                </div>
                                <div class="col-sm-3 d-flex justify-content-around align-items-center p-2">
                                <i class="prop__action__icon fas fa-marker" data-toggle="modal" data-target="#editPropertyModal"
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
                                <i class="prop__action__icon fas fa-door-closed" data-toggle="modal" data-target="#removeFromMarketModal" data-id="<?php echo $property['property_id']; ?>"></i>
                                <i class="prop__action__icon fas fa-trash"  data-toggle="modal" data-target="#deleteModal"></i>
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
        <div class="row">
        <div class="col-md-10">
                <h5>Your Applications</h5>
            </div>
            <div class="p-2 col-md-2 d-flex justify-content-center">
            <i class="prop__action__icon fas fa-sync"></i>
            </div>
        </div>
        <div class='row'>
            <div class='container-fluid'>
         
        <?php foreach ($applications as $application){ ?>
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
     
    </div>
    </div>
    </div>
    </div>
</div>'

<?php include '../view/footer.php' ?>