<?php include('abstract-views/header.php'); ?>

    <h1>Edit Question:</h1>
    <div class="mainContainer">
        <div>
            <div class="formContainer">
                <form action="index.php?action=edit_question" method="post">
                <?php
                    echo "
                    <div>
                        <input type='text' name='questionName' value='$questionName'>
                        <input type='text' name='questionBody' value='$questionBody'>
                        <input type='text' name='questionSkills' value='$questionSkills'>
                        <input type='submit' value='submit'>
                    </div>
                    ";
                ?>
                </form>
            </div>
        </div>
    </div>

<?php include('abstract-views/footer.php'); ?>