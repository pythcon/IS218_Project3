<?php include('abstract-views/header.php'); ?>

    <h1>Display Questions</h1>
    <div class="mainContainer">
        <div>
            <div class="formContainer">
                <?php
                    $out = "Welcome, <b>".$_SESSION['firstName']. " " .$_SESSION['lastName']. "</b>, Here is your question data:<br>";

                    //call to function
                    $out = display_questions($_SESSION['email']);

                    //print out
                    print "<span>$out</span>";
                ?>
            </div>
        </div>
    </div>

<?php include('abstract-views/footer.php'); ?>