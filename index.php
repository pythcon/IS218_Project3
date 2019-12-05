<?php
require('model/database.php');
require('model/accounts_db.php');
require('model/questions_db.php');

$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action');
    if ($action == NULL) {
        $action = 'show_login';
    }
}

switch ($action) {
    case 'show_login': {
        include('views/login.php');
        break;
    }
        
    case 'validate_login': {
        $email = filter_input(INPUT_GET, 'email');
        $password = filter_input(INPUT_GET, 'password');
        
        if ($email = NULL || $password = NULL){
            $error = "Email and/or Password is empty.";
            include('errors/error.php');
        }else{
            
        }
        
        break;
    }

    default: {
        $error = 'Unknown Action';
        include('errors/error.php');
    }
}