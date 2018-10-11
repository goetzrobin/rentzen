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