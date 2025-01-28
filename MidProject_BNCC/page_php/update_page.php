<?php
require "../class/UserController.php";
$user_Controller = new UserController();
if(isset($_GET['id'])){
    $user_Controller->preprocessing_Update($_GET["id"]);
}

if (isset($_POST['update_Button'])) {
    $user_Controller->modify_User($_POST);

} else if (isset($_POST['cancel_Button'])) {
    header("Location: dashboard_page.php");

}
?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../page_styles/update_page.css">
        <title>Update User</title>
    </head>

    <body>
        <div class = "container_A">
            <form action = "update_page.php" method = "POST" enctype = "multipart/form-data">
                
                <div class = "container_B">
                    <img src = "<?=$user_Controller->display_Photo; ?>" id = "profile_Pic">
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

                    <input type = "hidden" name = "id_Temp" value = "<?php echo $user_Controller->id; ?>">
                    <input type = "hidden" name = "photo_Temp" value = "<?php echo $user_Controller->display_Photo; ?>">

                    <div class = "container_D">
                        <input name = "update_Button" type = "submit" value = "Update" class = "update">

                        <input name = "cancel_Button" type = "submit" value = "Cancel" class = "cancel">
                    </div>         
                </div>
            </form>
        </div>
       <script src = "../page_scripts/update_page.js"></script>
    </body>
</html>
