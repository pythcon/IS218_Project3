<!DOCTYPE html>
<html>
<!-- the head section -->
<head>
    <title>IS218 MVC Practice</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="main.css" rel="stylesheet">
</head>
<!-- the body section -->
<body>
    
    <nav>
        <ul>
            <li><a href="index.php?action=display_login">Home</a></li>
            <li><a href="index.php?action=display_questions">Questions</a></li>
            <li><a href="index.php?action=display_about">About</a></li>
            <?php if ($_SESSION['logged']){ echo"<li><a href='index.php?action=logout'>Logout</a></li>";}?>
        </ul>
    </nav>

    <div class="container">
        <header><h1>IS218 MVC Practice</h1></header>