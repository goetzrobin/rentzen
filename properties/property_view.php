<?php include '../common/configuration.php'; ?>
<?php include '../view/header.php' ?>
<link href="./css/renter_map.css" rel="stylesheet">
<div class='container-fluid'>
<?php echo '<pre>';
print_r($property);
echo '</pre>'; ?>

<?php echo $property_data_icon_array['beds']; ?>
 <?php echo $property['beds']; ?>
<?php echo $property_data_icon_array['baths']; ?>
 <?php echo $property['baths']; ?>
<?php echo $property_data_icon_array['sqft']; ?>
 <?php echo $property['sqft']; ?>
<?php echo $property_data_icon_array['income_requirement']; ?>
 <?php echo number_format($property['income_requirement'], 2); ?>
<?php echo $property_data_icon_array['credit_requirement']; ?> 
<?php echo $property['credit_requirement']; ?>
<?php echo $property_data_icon_array['rental_fee']; ?>
 <?php echo number_format($property['rental_fee'], 2); ?>
<?php echo '<pre>';
print_r($features);
echo '</pre>';
foreach ($features as $feature) {
    echo $feature_icon_array[$feature['feature_id']];
    echo ' ' . $feature['feature_name'] . '<br>';
}

?>
</div>
<?php include '../view/footer.php' ?>