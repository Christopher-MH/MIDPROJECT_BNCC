<?php
require "../class/UserController.php";
$user_Controller = new UserController();

if(isset($_POST["create_Button"])) {
    $user_Controller->create_User($_POST, $_FILES['photo_Input']);

} else if(isset($_POST["reset_Button"])){
    $user_Controller->emptyFolder($user_Controller->temp_FolderPath);
    header("Location: create_user_page.php");

} else if(isset($_POST["cancel_Button"])){
    $user_Controller->emptyFolder($user_Controller->temp_FolderPath);
    header("Location: dashboard_page.php");

}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../page_styles/create_user_page.css">
        <title>Create User</title>
    </head>

    <body>
        <div class = "container_A">
            <form action = "create_user_page.php" method = "post" enctype = "multipart/form-data">
                <div class = "container_B">
                    <img src = "<?=$user_Controller->display_Photo; ?>" id = "profile_Pic">
                    <label for = "photo_Input">Upload Image</label>
                    <input 
                        type = "file"
                        name = "photo_Input"
                        accept = "image/jpeg, image/png, image/jpg"
                        id = "photo_Input"
                    >
                </div>

                <div class = "container_C">
                    <div class = "first_Name_Label">
                        <label for = "firstName_Input">First Name</label>
                        <span id = "firstName_Count">(0/255)</span>
                    </div>
                    <input 
                        type = "text" 
                        name = "firstName_Input" 
                        id = "firstName_Input" 
                        maxlength = "255"
                        value = "<?php $user_Controller->get_firstName_Temp(); ?>"
                        placeholder = "<?php echo $user_Controller->firstName_Error; ?>"
                    >

                    <div class = "last_Name_Label">
                        <label for = "lastName_Input">Last Name</label>
                        <span id = "lastName_Count">(0/255)</span>
                    </div>
                    <input
                        type = "text"
                        name = "lastName_Input"
                        id = "lastName_Input"
                        maxlength = "255"
                        value = "<?php $user_Controller->get_lastName_Temp(); ?>"
                        placeholder = "<?php echo $user_Controller->lastName_Error; ?>"
                    >

                    <div class = "email_Label">
                        <label for = "email_Input">Email</label>
                        <span id = "email_Count">(0/255)</span>
                    </div>
                    <input
                        type = "text"
                        name = "email_Input"
                        id = "email_Input"
                        maxlength = "255"
                        value = "<?php $user_Controller->get_Email_Temp(); ?>"
                        placeholder = "<?php echo $user_Controller->email_Error; ?>"
                    >

                    <div class = "bio_Label">
                        <label for = "bio_Input">Bio</label>
                        <span id = "bio_Count">(0/255)</span>
                    </div>
                    <textarea
                        name = "bio_Input"
                        id = "bio_Input"
                        maxlength = "255"
                    ><?php echo $user_Controller->get_Bio_Temp(); ?></textarea>

                    <div class = "container_D">
                        <input name = "create_Button" type = "submit" value = "Create" class = "create">

                        <input name = "reset_Button" type = "submit" value = "Reset" class = "reset">

                        <input name = "cancel_Button" type = "submit" value = "Cancel" class = "cancel">
                    </div>         
                </div>
            </form>
        </div>
       <script src = "../page_scripts/create_user_page.js"></script>
    </body>
</html>
