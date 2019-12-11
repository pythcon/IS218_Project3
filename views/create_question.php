<?php include('abstract-views/header.php'); ?>

    <h1>Edit Question:</h1>
    <div class="mainContainer">
        <div>
            <div class="formContainer">
                <form action="index.php?action=create_question" method="post">
                <?php
                    echo "
                    <div>
                        <table>
                            <tr>
                                <td><label>Question Name</label></td>
                                <td><input type='text' name='questionName' placeholder='Name (ex. test)'></td>
                            </tr>
                            <tr>
                                <td><label>Question Body</label></td>
                                <td><textarea name=questionBody id=questionBody autocomplete='off' placeholder='Question Body' rows='6' required></textarea></td>
                            </tr>
                            <tr>
                                <td><label>Question Skills</label></td>
                                <td><input type='text' name='questionSkills' placeholder='Skills (ex. skill1, skill2)'></td>
                            </tr>
                            <tr>
                                <td></td><td><input type='submit' value='submit'></td>
                            </tr>
                    </div>
                    ";
                ?>
                </form>
            </div>
        </div>
    </div>

<?php include('abstract-views/footer.php'); ?>