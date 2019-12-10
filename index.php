<?php
session_start();
require('model/database.php');
require('model/accounts_db.php');
require('model/questions_db.php');

error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
ini_set('display_errors' , 1);

$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action');
    if ($action == NULL) {
        $action = 'show_login';
    }
}

switch ($action) {
    case 'show_login': {
        if ($_SESSION['logged']){
            header("Location: .?action=display_questions");
        }else{
            include('views/login.php');
        }
        break;
    }
        
    case 'validate_login': {
        $email = filter_input(INPUT_POST, 'email');
        $password = filter_input(INPUT_POST, 'password');
        
        if ($email == NULL || $password == NULL){
            $error = "Email and/or Password is empty.";
            include('errors/error.php');
        }else{
            $isValidLogin = validate_login($email, $password);
            
            if (!$isValidLogin){
                header("Location: .?action=display_registration");
            }else{
                $_SESSION['userId'] = $isValidLogin[0]['id'];
                $_SESSION['email'] = $email;
                $_SESSION['firstName'] = $isValidLogin[0]['fname'];
                $_SESSION['lastName'] = $isValidLogin[0]['lname'];
                $_SESSION['logged'] = true;
                header("Location: .?action=display_questions");
            }
        }
        
        break;
    }
        
    case 'validate_registration': {
        $email = filter_input(INPUT_POST, 'email');
        $password = filter_input(INPUT_POST, 'password');
        $firstName = filter_input(INPUT_POST, 'firstName');
        $lastName = filter_input(INPUT_POST, 'lastName');
        $birthday = filter_input(INPUT_POST, 'birthday');
        
        if ($email == NULL || $password == NULL || $firstName == NULL || $lastName == NULL || $birthday == NULL){
            $error = "All fields are required.";
            include('errors/error.php');
        }else{
            $isValidRegistration = validate_registration($email, $password, $firstName, $lastName, $birthday);
            
            if (!$isValidRegistration){
                $error = "Something went wrong. Please try again.";
                include('errors/error.php');
                header("Location: .?action=display_registration");
            }else{
                echo"
                <script>
                    alert(\"Account Created. Please log in.\");
                </script>";
                header("Location: .?action=display_login");
            }
        }
        break;
    }
        
    case 'display_questions': {
        if ($_SESSION['logged']){
            include('views/questions.php');
        }else{
            header("Location: .?action=show_login");
        }
        break;
    }
        
    case 'display_registration': {
        include('views/registration.php');
        break;
    }
        
    case 'display_edit_question': {
        $questionId = filter_input(INPUT_POST, 'questionToEdit');
        $questionToEdit = edit_question($questionId);
        include('views/question.php');
        break;
    }
    
    case 'logout': {
        $_SESSION['logged'] = false;
        $test = $_SESSION['logged'];
        session_destroy();
        header("Location: .?action=show_login");
        break;
    }

    default: {
        $error = 'Unknown Action';
        include('errors/error.php');
    }
}