<?php

/**
 * returns people_id and role_id on success, false on fail
 */
function loginPeople($username, $password
// , $role_id
)
{
    //returns true if the username and password are a good match.  false if not
    global $db;
$statement = $db->prepare('select people_id, role_id from people where username=:username and password = :password '
    // . 'role_id=:role_id'
);
    $statement->bindValue(':username', $username);
    
    $statement->bindValue(':password', $password);
    // $statement->bindValue(':role_id', $role_id);
    $statement->execute();
    $array = $statement->fetch();
    $statement->closeCursor();
    if (empty($array['people_id'])) {
        $result = false;
    } else {
        $result = [
            'people_id' => $array['people_id'],
            'role_id' => $array['role_id']
        ];
    }
    return $result;
}


function getPeople()
{
    //returns an array of people
    global $db;
    $statement = $db->prepare('select * '
        . ' from people '
        . ' order by lastname, firstname');
    $statement->execute();
    $result = $statement->fetchAll(PDO::FETCH_ASSOC);
    $statement->closeCursor();
    return $result;
}

function getPeopleById($id)
{
    //returns an array of people
    global $db;
    $statement = $db->prepare('select * '
        . ' from people '
        . 'where people_id=:id'
        . ' order by lastname, firstname');
    $statement->bindValue(':id', $id);
    $statement->execute();
    $result = $statement->fetch(PDO::FETCH_ASSOC);
    $statement->closeCursor();
    if (empty($result)) {
        $result = false;
    }
    return $result;
}

function getPeopleByRoleId($role_id)
{
    //returns an array of people
    global $db;
    $statement = $db->prepare('select * '
        . ' from people '
        . 'where role_id=:id'
        . ' order by lastname, firstname');
    $statement->bindValue(':role_id', $role_id);
    $statement->execute();
    $result = $statement->fetchAll(PDO::FETCH_ASSOC);
    $statement->closeCursor();
    if (empty($result)) {
        $result = false;
    }
    return $result;
}

function insertPeople(
    $email,
    $username,
    $password,
    $firstname,
    $lastname,
    $phone,
    $street,
    $city,
    $state_id,
    $zip,
    $role_id,
    $credit_rating,
    $income
) {
    global $db;
    $sql = "
    INSERT INTO people ( 
        email,
        username,
        password,
        firstname, 
        lastname, 
        phone,
        street, 
        city, 
        state_id, 
        zip, 
        role_id, 
        credit_rating,
        income
        ) 
    VALUES ( 
        :email,
        :username,
        :password,
        :firstname, 
        :lastname, 
        :phone,
        :street, 
        :city, 
        :state_id, 
        :zip, 
        :role_id, 
        :credit_rating,
        :income
    )";
    $statement = $db->prepare($sql);

    $statement->bindValue(":email", $email);
    $statement->bindValue(":username", $username);
    $statement->bindValue(":password", $password);
    $statement->bindValue(":firstname", $firstname);
    $statement->bindValue(":lastname", $lastname);
    $statement->bindValue(":phone", $phone);
    $statement->bindValue(":street", $street);
    $statement->bindValue(":city", $city);
    $statement->bindValue(":state_id", $state_id);
    $statement->bindValue(":zip", $zip);
    $statement->bindValue(":role_id", $role_id);
    $statement->bindValue(":credit_rating", $credit_rating);
    $statement->bindValue(":income", $income);

    $result = $statement->execute();
    $id = $db->lastInsertId();
    $statement->closeCursor();
    return getPeopleById($id);
}

function updatePeople($id, $column, $value)
{
    global $db;
    $placeholder = ':' . $column;
    $sql = 'UPDATE people SET ' . $column . ' = ' . $placeholder . ' WHERE people_id=:people_id';
    $statement = $db->prepare($sql);
    $statement->bindValue('people_id', $id);
    $statement->bindValue($placeholder, $value);
    $result = $statement->execute();
    $statement->closeCursor();
    if (empty($result)) {
        $result = false;
    } else {
        return getPeopleById($id);
    }
}

function deletePeopleById($id)
{
    global $db;
    $sql = 'DELETE FROM people WHERE people_id=:people_id';
    $statement = $db->prepare($sql);
    $statement->bindValue('people_id', $id);
    $result = $statement->execute();
    $statement->closeCursor();
    return $result;
}
?>