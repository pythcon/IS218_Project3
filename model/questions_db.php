<?php
function display_questions($email){
    global $db;
    
    $sql = "SELECT * FROM questions WHERE owneremail='$email'";
    $q = $db->prepare($sql);
    $q->execute();
    $results = $q->fetchAll();

    $out .= "<div class='tablePrintout'><table border='2px'>";
    $out .= "<tr><td>Name</td><td>Body</td><td>Skills</td></tr>";
    foreach ($results as $row){
        $out .= "<tr><td>".$row['title']."</td><td>".$row['body']."</td><td>".$row['skills']."</td></tr>";
    }
    $out .= "</table></div>";

    $q->closeCursor();
    
    return $out;
    
}