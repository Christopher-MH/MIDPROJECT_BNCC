<?php
require "../class/AdminController.php";
$admin_Controller = new AdminController();
$admin_Profile = $admin_Controller->show_Admin();

if(isset($_POST["logout_Button"])){
    $admin_Controller->logout();
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../page_styles/profile_page.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
        <title>Profile</title>
    </head>
    <body>
        <header class = "navbar">
            <ul>
                <li>
                    <a href = "../page_php/dashboard_page.php">
                        <i class = "fas fa-tachometer-alt"></i> 
                        <span>Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href = "../page_php/profile_page.php">
                        <i class = "fas fa-user"></i> 
                        <span>Profile</span>
                    </a>
                </li>
            </ul>
        </header>

        <div class = "container_A">
            <div class = "container_B">
                <h1>ID: <?php echo $admin_Profile["id"]; ?> </h1>

                <div class = "image_Container">
                    <img src = "<?= $admin_Profile["photo"]; ?>">
                </div>
            </div>

            <div class = "container_C">
                <div class = "container_FirstName">
                    <h1>First Name:</h1>
                    <p><?php echo $admin_Profile["first_name"];?></p>
                </div>

                <div class = "container_LastName">
                    <h1>Last Name:</h1>
                    <p><?php echo $admin_Profile["last_name"];?></p>
                </div>

                <div class = "container_Email">
                    <h1>Email:</h1>
                    <p><?php echo $admin_Profile["email"];?></p>
                </div>

                <div class = "container_Bio">
                    <h1>Bio:</h1>
                    <p><?php echo $admin_Profile["bio"];?></p>
                </div>

                <form action = "profile_page.php" method = "post" enctype = "multipart/form-data">
                    <button name = "logout_Button" type = "submit" class = "logout_Button" onclick = "return confirm('Are you sure you want to logout?');">
                        <i class = "fas fa-sign-out-alt"></i> Log Out
                    </button>
                </form>
            </div>
        </div>

        <footer>
            <p>&copy; 2024, Christopher Mannuel Hendrata - 2702207761 | Follow me on: 
            <a href = "https://www.instagram.com/christophermannuelh/?hl=en">Instagram</a>, 
            <a href = "https://github.com/Christopher-MH">GitHub</a>
            </p>
        </footer>
    </body>
</html>
