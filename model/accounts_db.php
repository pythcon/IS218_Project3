<?php

function validate_login($email, $password){
    global $db;
    
    $query = "SELECT * FROM accounts WHERE email=:email AND password=:password";
    $statement = $db->prepare($query);
    
    $statement->bindValue(':email', $email);
    $statement->bindValue(':password', $password);
    $statement->execute();
    
    $account = $statement->fetchAll();
    
    $_SESSION['firstName'] = $account[0]['fname'];
    $_SESSION['lastName'] = $account[0]['lname'];
    $_SESSION['userId'] = $account[0]['id'];
    
    if (count($account) === 0){
        return false;
    }else{
        return true;
    }
}

function validate_registration($email, $password, $firstName, $lastName, $birthday){
    global $db;
    
    $sql = "SELECT * FROM accounts";
    $q = $db->prepare($sql);
    $q->execute();
    $results = $q->fetchAll();
    $num_rows = $q->rowCount();
    
    $sql = "INSERT INTO accounts VALUES($num_rows+1, '$email', '$firstName', '$lastName', '$birthday', '$password')";
    $q = $db->prepare($sql);
    
    if($q->execute() === false){
        $q->closeCursor();
        return false;
    }else{
        $q->closeCursor();
        return true;
    }

}