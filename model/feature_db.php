<?php
function getFeature()
{
    //returns an array of feature
    global $db;
    $statement = $db->prepare('select * '
        . ' from feature '
        . '');
    $statement->execute();
    $result = $statement->fetchAll(PDO::FETCH_ASSOC);
    $statement->closeCursor();
    return $result;
}

function getFeatureById($id)
{
    //returns an array of feature
    global $db;
    $statement = $db->prepare('select * '
        . ' from feature '
        . 'where feature_id=:id'
        . '');
    $statement->bindValue(':id', $id);
    $statement->execute();
    $result = $statement->fetch(PDO::FETCH_ASSOC);
    $statement->closeCursor();
    if (empty($result)) {
        $result = false;
    }
    return $result;
}


function insertFeature($feature_name, $description, $quantity)
{
    global $db;
    $sql = "
    INSERT INTO `feature`( 
            feature_name,
            description,
            quantity
        ) 
    VALUES ( 
        :feature_name,
        :description,
        :quantity
        )  ";
    $statement = $db->prepare($sql);

    $statement->bindValue(':feature_name', $feature_name);
    $statement->bindValue(':description', $description);
    $statement->bindValue(':quantity', $quantity);

    $result = $statement->execute();
    $id = $db->lastInsertId();
    $statement->closeCursor();
    return $id;
}

function updateFeature($id, $column, $value)
{
    global $db;
    $placeholder = ':' . $column;
    $sql = 'UPDATE feature SET ' . $column . ' = ' . $placeholder . ' WHERE feature_id=:feature_id';
    $statement = $db->prepare($sql);
    $statement->bindValue('feature_id', $id);
    $statement->bindValue($placeholder, $value);
    $result = $statement->execute();
    $statement->closeCursor();
    if (empty($result)) {
        $result = false;
    } else {
        return getFeatureById($id);
    }
}

function deleteFeatureById($id)
{
    global $db;
    $sql = 'DELETE FROM feature WHERE feature_id=:feature_id';
    $statement = $db->prepare($sql);
    $statement->bindValue('feature_id', $id);
    $result = $statement->execute();
    $statement->closeCursor();
    return $result;
}
?>