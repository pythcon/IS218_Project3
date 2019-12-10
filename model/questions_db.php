<?php
function display_questions($email){
    global $db;
    $out = "";
    
    $sql = "SELECT * FROM questions WHERE owneremail='$email'";
    $q = $db->prepare($sql);
    $q->execute();
    $results = $q->fetchAll();

    $out .= "<div class='tablePrintout'><table border='2px'>";
    $out .= "<tr><td>Name</td><td>Body</td><td>Skills</td></tr>";
    foreach ($results as $row){
        $out .= "<tr><td>".$row['title']."</td><td>".$row['body']."</td><td>".$row['skills']."</td><td><form action='index.php?action=edit_question' method='post'><input type='hidden' value='".$row['id']."'><input type='submit' name='questionToEdit' value='edit'></td></tr>";
    }
    $out .= "</table></div>";

    $q->closeCursor();
    
    return $out;
    
}

function display_edit_question($questionId){
    global $db;
    
    $sql = "SELECT * FROM questions WHERE id='$questionId'";
    $q = $db->prepare($sql);
    $q->execute();
    $results = $q->fetchAll();
    $q->closeCursor();
    
    return $results;
    
}

function edit_question($questionId, $title, $body, $skills){
    global $db;
    
    $sql = "UPDATE questions SET title='$title', body='$body', skills='$skills' WHERE id='$questionId'";
    $q = $db->prepare($sql);
    
    if($q->execute() === false){
        return false;
    }else{
        return true;
    }

    $q->closeCursor();
    
}

function create_question($email, $id, $title, $body, $skills){
    //insert num rows variable
    global $db;
    
    $sql = "SELECT * FROM questions";
    $q = $db->prepare($sql);
    $q->execute();
    $results = $q->fetchAll();
    $num_rows = count($results);
    $q->closeCursor();
    
    $sql = "INSERT INTO questions VALUES($num_rows+1, '$email', '$id', NOW(), '$questionName', '$questionBody', '$skillsOutput', 0)";
    $q = $db->prepare($sql);
    
    if($q->execute() === false){
        return false;
    }else{
        return true;
    }

    $q->closeCursor();
}