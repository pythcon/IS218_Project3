<?php
function display_questions($email){
    global $db;
    
    $query = "SELECT * FROM questions WHERE owneremail='$email'";
    $statement = $db->prepare($query);
    
    $statement->bindValue(':email', $email);
    $statement->execute();
    
    $results = array();
    while ($row = $statement->fetchAll()){
        array_push($results, $row[''])
    }
    
}