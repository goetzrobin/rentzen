<?php

function getRentalApp(){
    //returns an array of rental_application
    global $db;
    $statement = $db->prepare('select * '
            . ' from rental_application '
            . 'ORDER BY move_in_date DESC');
    $statement->execute();
    $result = $statement->fetchAll(PDO::FETCH_ASSOC);
    $statement->closeCursor();
    return $result;
}

function getRentalAppById($id){
    //returns an array of rental_application
    global $db;
    $statement = $db->prepare('select * '
            . ' from rental_application ' 
            . 'where rental_application_id=:id'
           );
    $statement->bindValue(':id', $id);
    $statement->execute();
    $result = $statement->fetch(PDO::FETCH_ASSOC);
    $statement->closeCursor();
    if (empty($result)){
        $result = false;
    } 
    return $result;
}

function getRentalAppByStatusId($status_id){
    //returns an array of rental_application
    global $db;
    $statement = $db->prepare('select * '
            . ' from rental_application ' 
            . 'where last_status_id=:id'
            . '');
    $statement->bindValue(':id', $status_id);
    $statement->execute();
    $result = $statement->fetchAll(PDO::FETCH_ASSOC);
    $statement->closeCursor();
    if (empty($result)){
        $result = false;
    } 
    return $result;
}


function insertRentalApp(
    $last_status_id,
    $move_in_date,
    $move_out_date,
    $renter_message
) {
    global $db;
    $sql = "
    INSERT INTO `rental_application`( 
        last_status_id,
        move_in_date,
        move_out_date,
        renter_message
        ) 
    VALUES ( 
        :last_status_id,
        :move_in_date,
        :move_out_date,
        :renter_message
        )  ";
    $statement = $db->prepare($sql);

    $statement->bindValue(":last_status_id", $last_status_id);
    $statement->bindValue(":move_in_date", $move_in_date);
    $statement->bindValue(":move_out_date", $move_out_date);
    $statement->bindValue(":renter_message", $renter_message);

    $result = $statement->execute();
    $id = $db->lastInsertId();
    $statement->closeCursor();
    return $id;
}

function updateRentalApp($id, $column, $value)
{
    global $db;
    $placeholder = ':' . $column;
    $sql = 'UPDATE rental_application SET ' . $column . ' = ' . $placeholder . ' WHERE rental_application_id=:rental_application_id';
    $statement = $db->prepare($sql);
    $statement->bindValue('rental_application_id', $id);
    $statement->bindValue($placeholder, $value);
    $result = $statement->execute();
    $statement->closeCursor();
    if (empty($result)) {
        $result = false;
    } else {
        return getRentalApp($id);
    }
}

function deleteRentalApp($id)
{
    global $db;
    $sql = 'DELETE FROM rental_application WHERE rental_application_id=:id';
    $statement = $db->prepare($sql);
    $statement->bindValue('id', $id);
    $result = $statement->execute();
    $statement->closeCursor();
    return $result;
}
?>