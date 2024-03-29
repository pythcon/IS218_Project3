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
                $_SESSION['email'] = $email;
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
        
        $valid = true;
        
        //Check First Name for requirements
        if (empty($firstName)){
            $error .= "First Name cannot be empty!<br>";
            $valid = false;
        }
        //Check Last Name for requirements
        if (empty($lastName)){
            $error .= "Last Name cannot be empty!<br>";
            $valid = false;
        }
        //Check Birthday for requirements
        if (empty($birthday)){
            $error .= "Birthday cannot be empty!<br>";
            $valid = false;
        }
        //Check Email for requirements
        $contains_symbol = strpos($email, '@') !== false;
        if (empty($email)){
            $error .= "Email cannot be empty!<br>";
            $valid = false;
        }
        if (!$contains_symbol){
            $error .= "Email does not contain @ symbol!<br>";
            $valid = false;
        }
        //Check Password for requirements
        if (empty($password)){
            $error .= "Password cannot be empty!<br>";
            $valid = false;
        }
        if (strlen($password) < 8){
            $error .= "Password must be at least 8 characters!<br>";
            $valid = false;
        }
        
        //passed checks
        if ($valid){
            $isValidRegistration = validate_registration($email, $password, $firstName, $lastName, $birthday);
            
            if (!$isValidRegistration){
                $error = "Something went wrong. Please try again.";
                include('errors/error.php');
            }else{
                echo"
                <script>
                    alert(\"Account Created. Please log in.\");
                </script>";
                header("Location: .?action=show_login");
            }
        }else{
            include('errors/error.php');
        }
        break;
    }
        
    case 'display_questions': {
        //$test = $_POST['showAllQuestions'];
        if ($_SESSION['logged']){
            if (filter_input(INPUT_POST, 'showAllQuestions') === 'yes'){
                $_SESSION['displayAll'] = true;
            }else{
                $_SESSION['displayAll'] = false;
            }
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
        if ($_SESSION['logged']){
            $questionId = filter_input(INPUT_POST, 'questionToEdit');
            $_SESSION['questionId'] = $questionId;
            $questionToEdit = display_edit_question($questionId);
            $questionToEdit = array_values($questionToEdit);
            $questionName = $questionToEdit[0];
            $questionBody = $questionToEdit[1];
            $questionSkills = $questionToEdit[2];
            include('views/question.php');
        }else{
            header("Location: .?action=show_login");
        }
        break;
    }
    
    case 'edit_question': {
        if ($_SESSION['logged']){
            $questionId = $_SESSION['questionId'];
            $questionName = filter_input(INPUT_POST, 'questionName');
            $questionBody = filter_input(INPUT_POST, 'questionBody');
            $questionSkills = filter_input(INPUT_POST, 'questionSkills');
            
            //check requirements
            $containsComma = strpos($questionSkills, ',') !== false;
            if (!$containsComma){
                $error .= "Two Skills must be entered!<br>";
                $valid = false;
            }

            //Check Question Name for requirements
            if (empty($questionName)){
                $error .= "Question Name cannot be empty!<br>";
                $valid = false;
            }

            if (strlen($questionName) <= 3){
                $error .= "Question Name must be at least 3 characters!<br>";
                $valid = false;
            }

            //Check Question Body for requirements
            if (empty($questionBody)){
                $error .= "Question Body cannot be empty!<br>";
                $valid = false;
            }

            if (strlen($questionBody) <= 500){
                $error .= "Question Body must be at least 500 characters!<br>";
                $valid = false;
            }
            
            //passed requirements
            if ($valid){
                if (edit_question($questionId, $questionName, $questionBody, $questionSkills)){
                    echo"
                    <script>
                        alert(\"Question edited successfully.\");
                    </script>";
                    header("Location: .");
                }else{
                    $error= "Something went wrong. Please try again.";
                    include('errors/error.php');
                }
            }else{
                include('errors/error.php');
            }
        }else{
            header("Location: .?action=show_login");
        }
        break;
    }
        
    case 'delete_question': {
        if ($_SESSION['logged']){
            $questionId = filter_input(INPUT_POST, 'questionToDelete');
            if (delete_question($questionId)){
                echo"
                <script>
                    alert(\"Question deleted successfully.\");
                </script>";
                header("Location: .?action=display_questions");
            }else{
                $error= "Something went wrong. Please try again.";
                include('errors/error.php');
            }
        }else{
            header("Location: .?action=show_login");
        }
        break;
    }
        
    case 'display_create_question': {
        if ($_SESSION['logged']){
            include("views/create_question.php");
        }else{
            header("Location: .?action=show_login");
        }
        break;
    }
        
    case 'create_question': {
        if ($_SESSION['logged']){
            $valid = true;
            $questionName = filter_input(INPUT_POST, 'questionName');
            $questionBody = filter_input(INPUT_POST, 'questionBody');
            $questionSkills = filter_input(INPUT_POST, 'questionSkills');

            //check requirements
            $containsComma = strpos($questionSkills, ',') !== false;
            if (!$containsComma){
                $error .= "Two Skills must be entered!<br>";
                $valid = false;
            }

            //Check Question Name for requirements
            if (empty($questionName)){
                $error .= "Question Name cannot be empty!<br>";
                $valid = false;
            }

            if (strlen($questionName) <= 3){
                $error .= "Question Name must be at least 3 characters!<br>";
                $valid = false;
            }

            //Check Question Body for requirements
            if (empty($questionBody)){
                $error .= "Question Body cannot be empty!<br>";
                $valid = false;
            }

            if (strlen($questionBody) <= 500){
                $error .= "Question Body must be at least 500 characters!<br>";
                $valid = false;
            }

            if ($valid){
                //passed all checks
                if (create_question($_SESSION['email'], $_SESSION['userId'], $questionName, $questionBody, $questionSkills)){
                    echo"
                    <script>
                        alert(\"Question added.\");
                    </script>";
                    header("Location: .?action=display_questions");
                }else{
                    $error= "Something went wrong. Please try again.";
                    include('errors/error.php');
                }
            }else{
                include('errors/error.php');
            }
        }else{
            header("Location: .?action=show_login");
        }
        break;
    }
    
    case 'logout': {
        $_SESSION['logged'] = false;
        $test = $_SESSION['logged'];
        session_destroy();
        header("Location: .?action=show_login");
        break;
    }
        
    case 'display_about': {
        include('views/about.php');
        break;
    }

    default: {
        $error = 'Unknown Action';
        include('errors/error.php');
    }
}