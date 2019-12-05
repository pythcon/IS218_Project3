<?php
session_start();
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
        $email = filter_input(INPUT_POST, 'email');
        $password = filter_input(INPUT_POST, 'password');
        
        if ($email = NULL || $password = NULL){
            $error = "Email and/or Password is empty.";
            include('errors/error.php');
        }else{
            $isValidLogin = validate_login($email, $password);
            
            if (!$isValidLogin){
                //TODO: redirect to registration page
                
            }else{
                $userId = $isValidLogin[0]['id'];
                $_SESSION['userId'] = $userId;
                header("Location: .");
            }
        }
        
        break;
    }
        
    case 'display_questions':{
        include('views/questions.php');
        break;
    }
        
    case 'display_registration':{
        include('views/registration.php');
        break;
    }

    default: {
        $error = 'Unknown Action';
        include('errors/error.php');
    }
}