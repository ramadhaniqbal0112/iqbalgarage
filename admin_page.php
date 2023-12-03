<?php
require "function.php";
session_start();

if (isset($_SESSION['verify']) || $_SESSION['verify'] == true) {
    if (isset($_SESSION['id'])) {
        $id = $_SESSION['id'];
        $user = "SELECT * FROM user WHERE id = '$id'";
        $user = $conn->query($user);

        $webSetting = "SELECT * FROM web_setting WHERE id = '1'";
        $webSetting = $conn->query($webSetting);

        $webSetting = $webSetting->num_rows > 0 ? mysqli_fetch_assoc($webSetting) : false;

        $user = $user->num_rows > 0 ? mysqli_fetch_assoc($user) : false;

        if ($user['role_id'] == 1) {
            header("location: login_register.php");
            exit;
        }

        $numbOfUser = $conn->query("SELECT * FROM user WHERE role_id = 1");
        $numbOfRegularAdmin = $conn->query("SELECT * FROM user WHERE role_id = 2");
        $numbOfSuperAdmin = $conn->query("SELECT * FROM user WHERE role_id = 3");
        $numbOfGallery = $conn->query("SELECT * FROM gallery");
        $numberOfServiceAll = $conn->query("SELECT * FROM booking");
        $numberOfServiceDone = $conn->query("SELECT * FROM booking WHERE stattus = '1'");

        if ($numbOfUser->num_rows > 0) {
            $numbOfUser = mysqli_num_rows($numbOfUser);
        } else {
            $numbOfUser = 0;
        }

        if ($numbOfRegularAdmin->num_rows > 0) {
            $numbOfRegularAdmin = mysqli_num_rows($numbOfRegularAdmin);
        } else {
            $numbOfRegularAdmin = 0;
        }

        if ($numbOfSuperAdmin->num_rows > 0) {
            $numbOfSuperAdmin = mysqli_num_rows($numbOfSuperAdmin);
        } else {
            $numbOfSuperAdmin = 0;
        }
        if ($numbOfGallery->num_rows > 0) {
            $numbOfGallery = mysqli_num_rows($numbOfGallery);
        } else {
            $numbOfGallery = 0;
        }

        if ($numberOfServiceAll->num_rows > 0) {
            $numberOfServiceAll = mysqli_num_rows($numberOfServiceAll);
        } else {
            $numberOfServiceAll = 0;
        }

        if ($numberOfServiceDone->num_rows > 0) {
            $numberOfServiceDone = mysqli_num_rows($numberOfServiceDone);
        } else {
            $numberOfServiceDone = 0;
        }
    } else {
        header("location: login_register.php");
        exit;
    }
    if (isset($_REQUEST['adm_pg'])) {
        $admPg = $_REQUEST['adm_pg'];

        switch ($admPg) {
            case "dashboard":
                $adminPage = [
                    'include' => "dashboard.php",
                    'title' => "Dashboard Page"
                ];
                break;
            case "edt_act":
                $adminPage = [
                    'include' => "edit_profil.php",
                    'title' => "My Profile"
                ];
                break;
            case "user":
                $adminPage = [
                    'include' => "user.php",
                    'title' => "List of Users"
                ];
                break;
            case "edt_usr":
                $adminPage = [
                    'include' => "edit_user.php",
                    'title' => "Edit User"
                ];
                break;
            case "files":
                $adminPage = [
                    'include' => "files.php",
                    'title' => "Web Content"
                ];
                break;
            case "booking list":
                $adminPage = [
                    'include' => "list.php",
                    'title' => "Booking List"
                ];
                break;
            case "setting":
                $adminPage = [
                    'include' => "setting.php",
                    'title' => "Web Setting"
                ];
                break;
            default:
                $adminPage = [
                    'include' => "dashboard.php",
                    'title' => "Dashboard Page"
                ];
                break;
        }
    } else {
        $adminPage = [
            'include' => "dashboard.php",
            'title' => "Dashboard Page"
        ];
    }
} else {
    header("location: login_register.php");
    exit;
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- link cdn css Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <!-- link cdn fontawesome v6 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Link cdn google fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Belanosima&family=Dancing+Script&family=Gabarito&family=Inter:wght@300&family=Kanit:ital@1&family=Kdam+Thmor+Pro&family=Lato:ital@1&family=Noto+Serif+Makasar&family=Press+Start+2P&family=Raleway&family=Sacramento&display=swap" rel="stylesheet">
    <!-- link cdn google icon -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <!-- link cdn AOS -->
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <!-- link my style -->
    <link rel="stylesheet" href="style_admin.css">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
    <style>
        * {
            color: black;
        }

        body {
            background-image: none;
        }

        :root {
            --dropdown-link-hover-bg: #003049;
        }

        .dropdown-item:focus {
            background-color: var(--dropdown-link-hover-bg);
        }

        .profile-image {
            background-image: url("user_img/<?= $user['img'] ?>");
            width: 42px;
            height: 42px;
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;

        }

        #changePhoto::-webkit-scrollbar {
            height: 2px;
            background-color: #003049;
        }

        #changePhoto::-webkit-scrollbar-thumb {
            background-color: #f48c06;
        }

        .table-of-users::-webkit-scrollbar {
            width: 6px;
            background-color: #023047;
            border-radius: 3px;
        }

        .table-of-users::-webkit-scrollbar-thumb {
            border-radius: 3px;
            background-color: #f48c06;
        }

        .data-user {
            overflow-x: scroll;
        }

        .data-user::-webkit-scrollbar {
            height: 4px;
            background-color: #003049;
            border-radius: 2px;
        }

        .data-user::-webkit-scrollbar-thumb {
            border-radius: 2px;
            background-color: #f48c06;
        }
    </style>
</head>

<body>
    <div class="sidebar">
        <div class="logo-details">
            <!-- <i class='bx bxl-c-plus-plus icon'></i> -->
            <i class="fa-solid fa-motorcycle icon"></i>
            <div class="logo_name kdam-thmor-pro">IqbalGarage</div>
            <i class="fa-solid fa-bars" id="btn"></i>
        </div>
        <ul class="nav-list p-0">
            <li>
                <a href="admin_page.php?adm_pg=dashboard">
                    <i class="fa-solid fa-gauge"></i>
                    <span class="links_name">Dashboard</span>
                </a>
                <span class="tooltip">Dashboard</span>
            </li>
            <li>
                <a href="admin_page.php?adm_pg=user">
                    <i class="fa-solid fa-user-tie"></i>
                    <span class="links_name">User</span>
                </a>
                <span class="tooltip">User</span>
            </li>
            <li>
                <a href="admin_page.php?adm_pg=booking list">
                    <i class="fa-solid fa-clipboard-list"></i>
                    <span class="links_name">Booking List</span>
                </a>
                <span class="tooltip">Booking List</span>
            </li>
            <li>
                <a href="admin_page.php?adm_pg=files">
                    <i class="fa-solid fa-folder"></i>
                    <span class="links_name">File Manager</span>
                </a>
                <span class="tooltip">Files</span>
            </li>
            <li>
                <a href="admin_page.php?adm_pg=setting">
                    <i class="fa-solid fa-gears"></i>
                    <span class="links_name">Setting</span>
                </a>
                <span class="tooltip">Setting</span>
            </li>
            <li>
                <a href="logout.php">
                    <i class="fa-solid fa-arrow-right-from-bracket"></i>
                    <span class="links_name">Sign-Out</span>
                </a>
                <span class="tooltip">Sign-Out</span>
            </li>
            <li class="profile">
                <div class="profile-details">
                    <img src="icon/motorcycle_6-removebg-preview.png" alt="profileImg">
                    <div class="name_job">
                        <div class="name">&copy; 2021</div>
                        <div class="job">Iqbal Garage</div>
                    </div>
                </div>
                <i class='bx bx-log-out' id="log_out"></i>
            </li>
        </ul>
    </div>
    <section class="home-section">
        <div>
            <section class="py-2 px-3 d-flex justify-content-between aling-items-center" style="background-color: #14213d;">
                <h5 class="text-white m-0 kanit my-auto"><?= $adminPage['title'] ?></h5>
                <div class="btn-group">
                    <button type="button" class="btn d-flex align-items-center text-white dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                        <div class="profile-image rounded-circle border"></div>
                        <span class="text-white">&nbsp;Account&nbsp;</span>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end ">
                        <li><a class="dropdown-item text-dark" href="admin_page.php?adm_pg=edt_act"><i class="fa-solid fa-pen"></i>&nbsp;Edit Profil</a></li>
                        <li><a class="dropdown-item text-dark" href="logout.php"><i class="fa-solid fa-power-off"></i>&nbsp;Sign-Out</a></li>
                    </ul>
                </div>
            </section>
            <?php
            include $adminPage['include'];
            ?>
        </div>
    </section>

    <script>
        let sidebar = document.querySelector(".sidebar");
        let closeBtn = document.querySelector("#btn");
        let searchBtn = document.querySelector(".bx-search");
        closeBtn.addEventListener("click", () => {
            sidebar.classList.toggle("open");
            menuBtnChange();
        });
        searchBtn.addEventListener("click", () => {
            sidebar.classList.toggle("open");
            menuBtnChange();
        });

        function menuBtnChange() {
            if (sidebar.classList.contains("open")) {
                closeBtn.classList.replace("fa-bars", "fa-xmark");
            } else {
                closeBtn.classList.replace("fa-xmark", "fa-bars");
            }
        }
    </script>
    <!-- link JS cdn Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
</body>

</html>