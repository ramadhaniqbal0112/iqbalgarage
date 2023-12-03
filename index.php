<?php
require "function.php";
session_start();
$web = "SELECT * FROM web_setting WHERE id = '1'";
$web = $conn->query($web);
$web = $web->num_rows > 0 ? mysqli_fetch_assoc($web) : false;



if (!isset($_SESSION['verify']) || $_SESSION['verify'] != true) {
    $login = [
        "class" => false,
        "href" => "login_register.php",
        "nav" => "Sign-In"
    ];
} else {
    if (isset($_SESSION['id'])) {
        $id = $_SESSION['id'];
        $user = "SELECT * FROM user WHERE id = '$id'";
        $user = $conn->query($user);
        $user = $user->num_rows > 0 ? mysqli_fetch_assoc($user) : false;
    }
    $login = [
        "class" => false,
        "href" => "logout.php",
        "nav" => "Sign-Out"
    ];
}

$content = 'home.php';
if (isset($_REQUEST['page'])) {
    $page = $_REQUEST['page'];
    switch ($page) {
        case 'home':
            $content = 'home.php';
            $login['class'] = false;
            $active = [
                "home" => "text-warning",
                "our service" => false,
                "contact us" => false,
                "gallery" => false,
                "about us" => false,
                "booking" => false,
            ];
            break;
        case 'gallery':
            $content = 'gallery.php';
            $login['class'] = false;
            $active = [
                "home" => false,
                "our service" => false,
                "contact us" => false,
                "gallery" => "text-warning",
                "about us" => false,
                "booking" => false,
            ];
            break;
        case 'about us':
            $content = 'about_us.php';
            $login['class'] = false;
            $active = [
                "home" => false,
                "our service" => false,
                "contact us" => false,
                "gallery" => false,
                "about us" => "text-warning",
                "booking" => false,
            ];
            break;
        case 'booking':
            $content = 'booking.php';
            $login['class'] = false;
            $active = [
                "home" => false,
                "our service" => false,
                "contact us" => false,
                "gallery" => false,
                "about us" => false,
                "booking" => "text-warning",
            ];
            break;
        default:
            $content = 'home.php';
            break;
    }
} else {
    $content = 'home.php';
    $active = [
        "home" => "text-warning",
        "our service" => false,
        "contact us" => false,
        "gallery" => false,
        "about us" => false,
        "booking" => false,
    ];
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
    <link rel="stylesheet" href="style.css">
    <!-- link untuk icon di title -->
    <link rel="shortcut icon" href="icon/motorcycle_6-removebg-preview.png" type="image/x-icon">
    <title><?= ucwords(strtolower($web['garage_name'])) ?></title>
</head>

<body>
    <!-- header  -->
    <section class="py-2">
        <div id="firstElement" class="container d-flex justify-content-between align-items-center">
            <h5 class=" text-center kanit fw-bold" style="text-transform: uppercase;"><?= strtolower($web['garage_name']) ?></h5>
            <div class="d-flex topbar-contact">
                <h5 class="fw-light" style="font-size: 12px;"><i class="fa-solid fa-warehouse"></i>&nbsp;<?= $web['address'] ?></h5>
                <h5 class="fw-light" style="font-size: 12px;"><i class="fa-brands fa-whatsapp"></i>&nbsp;<?= $web['whatsapp'] ?></h5>
            </div>
        </div>
    </section>
    <!-- navbar -->
    <nav class="my-navbar navbar navbar-expand-lg py-0 px-4">
        <div class="container-fluid py-0">
            <img src="icon/motorcycle_6-removebg-preview.png" alt="logo" width="120px">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link <?= $active['home'] ?>" href="index.php?page=home">Home</a>
                    </li>
                    <li class="nav-item text-light">
                        <a class="nav-link <?= $active['about us'] ?>" href="index.php?page=about us">About Us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= $active['gallery'] ?>" href="index.php?page=gallery">Gallery</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= $active['booking'] ?>" href="index.php?page=booking">Booking Service</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= $login["class"] ?>" href="<?= $login["href"] ?>"><?= $login['nav'] ?></a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- include halaman sesuai url -->
    <?php
    include $content;
    ?>
    <!-- footer -->
    <footer class="d-flex mt-5 py-3 footer">
        <section class="m-auto container row m-0 p-0 align-items-center">
            <div id="firstFooter" class="list-menu col-md-4 d-flex">
                <ul class="p-0" style="list-style: none; font-size: 14px;">
                    <li><a href="index.php?page=home"><i class="fa-sharp fa-solid fa-caret-right"></i>&nbsp;Home</a></li>
                    <li><a href="index.php?page=about us"><i class="fa-sharp fa-solid fa-caret-right"></i>&nbsp;About Us</a></li>
                    <li><a href="index.php?page=gallery"><i class="fa-sharp fa-solid fa-caret-right"></i>&nbsp;Gallery</a></li>
                    <li><a href="index.php?page=booking"><i class="fa-sharp fa-solid fa-caret-right"></i>&nbsp;Booking Service</a></li>
                </ul>
            </div>
            </div>
            <div class="col-md-4 px-4 border border-top-0 border-bottom-0">
                <img src="icon/motorcycle_6-removebg-preview.png" alt="" width="100%" class="img-fluid">
            </div>
            <div id="secondFooter" class="col-md-4 address d-flex justify-content-around">
                <ul class="p-0 pe-1" style="list-style: none; font-size: 14px;">

                    <li><i class="fa-sharp fa-solid fa-warehouse fa-xs"></i>&nbsp;<?= $web['address'] ?></li>
                    <li><i class="fa-brands fa-whatsapp"></i>&nbsp;<?= $web['whatsapp'] ?></li>
                    <li><i class="fa-solid fa-at fa-xs"></i>&nbsp;<?= $web['email'] ?></li>
                    <hr>
                    <li><i class="fa-regular fa-copyright"></i> 2021 | <span style="text-transform: capitalize;"><?= strtolower($web['garage_name']) ?></span></li>
                </ul>
                <br>
                <ul class="p-0 ps-1" style="list-style: none; font-size: 14px;">
                    <li><span>Monday - Thursday:<br></span><span>09.00AM - 05.00PM</span></li>
                    <li><span>Saturday:<br></span><span>09.00AM - 03.00PM</span></li>
                    <li><span>Sunday:<br></span><span>11.00AM - 04.00PM</span></li>
                    <li><span>Friday:<br></span><span>Closed</span></li>
                </ul>
            </div>
        </section>
        </section>
        <!-- link JS cdn Bootstrap -->
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
        <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
        <script>
            // import AOS from 'aos';
            // import 'aos/dist/aos.css';
            AOS.init();
        </script>
        <script src="script.js"></script>
</body>

</html>