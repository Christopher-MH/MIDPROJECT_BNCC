<?php
require "../class/AdminController.php";
$admin_Controller = new AdminController();

if(isset($_POST["login_Button"])){
    $admin_Controller->login($_POST);
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../page_styles/login_page.css">
        <title>Login</title>
    </head>

    <body>
        <div class = "container">
            <h1>Hello, Admin!</h1>

            <form action = "../page_php/login_page.php" method = "post" enctype = "multipart/form-data">
                <label>Email:</label>
                <input 
                    type = "text" 
                    name = "email_Input"
                    id = "email_Input"
                    maxlength = "255"
                    value = "<?php $admin_Controller->get_Email_Temp(); ?>"
                    placeholder = "<?php echo $admin_Controller->email_Error; ?>"
                >

                <label>Password:</label>
                <input type = "password" name = "password_Input">

                <label><input type="checkbox" name="remember_me"> Remember Me</label>

                <h2 style="display: <?php echo $admin_Controller->fail_Login; ?>;">*Wrong email or password</h2>

                <input type = "submit" name = "login_Button" value = "Log in">
            </form>
        </div>
    </body>
</html>