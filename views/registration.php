<?php include('abstract-views/header.php'); ?>

    <form action="index.php" method="post">
        <input type="hidden" name="action" value="validate_registration">
        
        <div class="form-group">
            <label for="firstName">First Name</label>
            <input type="text" class="form-control" name="firstName" id="firstName" placeholder="Johnny" autocomplete="off">
        </div>

        <div class="form-group">
            <label for="lastName">Last Name</label>
            <input type="text" class="form-control" name="lastName" id="lastName" placeholder="Appleseed" autocomplete="off">
        </div>
        
        <div class="form-group">
            <label for="birthday">Birthday</label>
            <input type="text" class="form-control" name="birthday" id="birthday" placeholder="1970/01/30" autocomplete="off">
        </div>

        <div class="form-group">
            <label for="email">Email Address</label>
            <input type="email" class="form-control" name="email" id="email" placeholder="JAppleseed@example.com" autocomplete="off">
        </div>

        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control" name="password" id="password" placeholder="Password" autocomplete="off">
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>

<?php include('abstract-views/footer.php'); ?>