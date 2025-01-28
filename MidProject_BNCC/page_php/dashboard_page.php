<?php
require "../class/UserController.php";
$user_Controller = new UserController();
$all_Users = $user_Controller->show_Users();

if(isset($_POST['delete_Button'])){
    $user_Controller->remove_User($_POST);
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../page_styles/dashboard_page.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
        <title>Dashboard</title>
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
                    <a href ="../page_php/profile_page.php">
                        <i class = "fas fa-user"></i> 
                        <span>Profile</span>
                    </a>
                </li>
            </ul>
        </header>

        <div class = "search_Bar">
            <div class = "search_Container">
                <input type = "text" id = "search" placeholder = "Search user by email">
                <i class = "fas fa-search"></i>
            </div>
        </div>

        <div class = "user_Table">
            <table>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Photo</th>
                        <th>Full Name</th>
                        <th>Email</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        $counter = 1;
                        foreach($all_Users as $user):
                    ?>
                        <tr>
                            <td><?php echo $counter++; ?></td>
                            <td><img src="<?= $user['photo'] ?>" alt="User Photo"></td>
                            <td><?php echo $user['first_name'] . " " . $user['last_name'] ?></td>
                            <td><?php echo $user['email'] ?></td>
                            <td>
                                <form action = "view_page.php" method = "POST" enctype = "multipart/form-data">
                                    <input type = "hidden" name = "id" value = "<?= $user['id']; ?>">
                                    <button type = "submit" name = "view_Button" class = "view_Button">
                                        <i class = "fas fa-eye"></i>
                                    </button>
                                </form>    

                                <form action = "update_page.php" method = "GET" enctype = "multipart/form-data">
                                    <input type = "hidden" name = "id" value = "<?= $user['id']; ?>">
                                    <button type = "submit" name = "update_Button" class = "update_Button">
                                        <i class = "fas fa-edit"></i>
                                    </button>
                                </form>

                                <form action = "dashboard_page.php" method = "POST" enctype = "multipart/form-data">
                                    <input type = "hidden" name = "id" value = "<?= $user['id']; ?>">
                                    <input type = "hidden" name = "photo" value = "<?= $user['photo']; ?>">

                                    <button type = "submit" name = "delete_Button" class = "delete_Button" onclick = "return confirm('Are you sure you want to delete this user?');">
                                        <i class = "fas fa-trash-alt"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <div class = "add_User">
            <button onclick = "window.location.href='../page_php/create_user_page.php'">+ Add User</button>
        </div>

        <footer>
            <p>&copy; 2024, Christopher Mannuel Hendrata - 2702207761 | Follow me on: 
                <a href = "https://www.instagram.com/christophermannuelh/?hl=en">Instagram</a>, 
                <a href = "https://github.com/Christopher-MH">GitHub</a>
            </p>
        </footer>

        <script src = "../page_scripts/dashboard_page.js"></script>
    </body>
</html>
