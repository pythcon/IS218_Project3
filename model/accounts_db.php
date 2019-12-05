<?php

function validate_login($email, $password){
    global $db;
    
    $query = "SELECT * FROM accounts WHERE email='$email' AND password='$password'";
    $statement = $db->prepare($query);
    
    $statement->bindValue(':email', $email);
    $statement->bindValue(':password', $password);
    $statement->execute();
    
    $account = $statement->fetchAll();
    
    if (count($account) === 0){
        return false;
    }else{
        return true;
    }
}