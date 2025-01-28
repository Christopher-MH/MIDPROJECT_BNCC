<?php
require "../class/UserController.php";
$user_Controller = new UserController();

if (isset($_POST["return_Button"])) {
    header("Location: ../page_php/dashboard_page.php");
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../page_styles/create_user_page_success.css">
        <title>Create User</title>
    </head>

    <body>
        <div class="container_A">
            <h1>User created successfully!</h1>
            <form action="create_user_page_success.php" method="post" enctype="multipart/form-data">  
                <input name="return_Button" type="submit" value="Return to Dashboard" class="return">
            </form>
        </div>
    </body>
</html>
