<?php include('abstract-views/header.php'); ?>

    <h1>Edit Question:</h1>
    <div class="mainContainer">
        <div>
            <div class="formContainer">
                <form action="index.php?action=create_question" method="post">
                <?php
                    echo "
                    <div>
                        <input type='text' name='questionName' placeholder='Name (ex. test)'>
                        <textarea name=questionBody id=questionBody autocomplete='off' placeholder='Question Body' rows="6" required></textarea>
                        <input type='text' name='questionSkills' placeholder='Skills (ex. skill1, skill2)'>
                        <input type='submit' value='submit'>
                    </div>
                    ";
                ?>
                </form>
            </div>
        </div>
    </div>

<?php include('abstract-views/footer.php'); ?>