<?php include('abstract-views/header.php'); ?>

    <h1>Display Questions</h1>
    <div style="float:left;">
        <a href="index.php?action=display_create_question"><button>Add Question</button></a>
         &nbsp;&nbsp;
    </div>
    <form action='index.php?action=display_questions' method='post'>
        <?php 
        if($_SESSION['displayAll']) {
            echo "<input type='hidden' name='showAllQuestions' value='no'><input type='checkbox'checked onchange='this.form.submit()'> <b>Show All Questions</b>";
        }else{
            echo "<input type='hidden' name='showAllQuestions' value='yes'><input type='checkbox' onchange='this.form.submit()'> <b>Show All Questions</b>";
        }
        ?>
    </form>
    <br>
    <div class="mainContainer">
        <div>
            <div class="formContainer">
                <?php
                    $out = "Welcome, <b>".$_SESSION['firstName']. " " .$_SESSION['lastName']. "</b>, Here is your question data:<br>";

                    //call to function
                    $out .= display_questions($_SESSION['email'], $_SESSION['displayAll']);

                    //print out
                    print "<span>$out</span>";
                ?>
            </div>
        </div>
    </div>

<?php include('abstract-views/footer.php'); ?>