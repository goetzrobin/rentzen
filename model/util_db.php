<?php 
function getStates()
{
    global $db;
    $sql = 'select * from state';
    $statement = $db->prepare($sql);
    $statement->execute();
    $states = $statement->fetchAll(PDO::FETCH_ASSOC);
    $statement->closeCursor();
    return $states;
}

function getStateById($id)
{
    global $db;
    $sql = 'select * from state where state_id = :id';
    $statement = $db->prepare($sql);
    $statement->bindValue(':id', $id);
    $statement->execute();
    $state = $statement->fetch(PDO::FETCH_ASSOC);
    $statement->closeCursor();
    return $state;
}