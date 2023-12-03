<?php
require "function.php";
session_start();
?>
<!DOCTYPE html>
<html lang="id">

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
    <link rel="stylesheet" href="style_login_page.css">
    <title>( Nama )</title>
    <style>

    </style>
</head>

<body>
    <div class="container" id="container">
        <div class="form-container sign-up-container">
            <!-- form untuk buat akun baru -->
            <form id="regisForm" action="" method="post" onsubmit="validateForm(event)" class="text-dark">
                <input type="hidden" name="formType" value="registration">
                <h1 class="kdam-thmor-pro" style="color: #01161e;">Create Account</h1>
                <div class="social-container">
                    <a href="#" class="social"><i class="fab fa-facebook-f text-dark"></i></a>
                    <a href="#" class="social"><i class="fab fa-google-plus-g text-dark"></i></a>
                    <a href="#" class="social"><i class="fab fa-linkedin-in text-dark"></i></a>
                </div>
                <div>
                    <span>or use your email for registration</span>
                    <div>
                        <input id="rName" name="rname" type="text" placeholder="Name">
                        <div id="rAlertName" class="text-danger text-start ps-2" style="font-size: 13px;"></div>
                    </div>
                    <div>
                        <input id="rEmail" name="remail" type="email" placeholder="Email">
                        <div id="rAlertEmail" class="text-danger text-start ps-2" style="font-size: 13px;"></div>
                    </div>
                    <div>
                        <input id="rPassword" name="rpass" type="password" placeholder="Password">
                        <div id="rAlertPassword" class="text-danger text-start ps-2" style="font-size: 13px;"></div>
                    </div>
                    <div>
                        <input id="rRepeatPassword" name="rrepass" type="password" placeholder="Repeat Password">
                        <div id="rAlertRepeatPassword" class="text-danger text-start ps-2" style="font-size: 13px;"></div>
                    </div>
                    <input id="regisSubmit" type="submit" value="Sign-Up" name="signup">
                </div>
            </form>
        </div>
        <div class="form-container sign-in-container">
            <!-- form untuk login akun lama -->
            <form id="loginForm" action="" method="post" onsubmit="validateFormLogin(event)" class="text-dark">
                <input type="hidden" name="formType" value="login">
                <h1 class="kdam-thmor-pro" style="color: #01161e;">Sign in</h1>
                <div class="social-container">
                    <a href="#" class="social"><i class="fab fa-facebook-f text-dark"></i></a>
                    <a href="#" class="social"><i class="fab fa-google-plus-g text-dark"></i></a>
                    <a href="#" class="social"><i class="fab fa-linkedin-in text-dark"></i></a>
                </div>
                <div>
                    <span>or use your account</span>
                    <div>
                        <input id="lEmail" name="lemail" type="email" placeholder="Email" />
                        <div id="lAlertEmail" class="text-danger text-start ps-2" style="font-size: 13px;"></div>
                    </div>
                    <div>
                        <input id="lPassword" name="lpassword" type="password" placeholder="Password" />
                        <div id="lAlertPassword" class="text-danger text-start ps-2" style="font-size: 13px;"></div>
                    </div>
                    <input type="submit" value="Sign-In" name="signin">
                </div>
            </form>
        </div>
        <div class="overlay-container">
            <div class="overlay">
                <div class="overlay-panel overlay-left">
                    <h1 class="raleway text-light">Welcome Back!</h1>
                    <p class="text-light">To keep connected with us please login with your personal info</p>
                    <button class="ghost" id="signIn">Sign In</button>
                </div>
                <div class="overlay-panel overlay-right">
                    <h1 class="raleway text-light">Hello, Riders!</h1>
                    <p class="text-light">Enter your personal details and start journey with us</p>
                    <button class="ghost" id="signUp">Sign Up</button>
                </div>
            </div>
        </div>
    </div>

    <script src="script.js"></script>

</body>

</html>



<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST['formType'])) {
        $formType = $_POST['formType'];

        // syntax melakukan registrasi
        if ($formType === "registration") {
            $rName = htmlspecialchars($_POST['rname']);
            $rEmail = htmlspecialchars($_POST['remail']);
            $rPass = mysqli_escape_string($conn, htmlspecialchars($_POST['rpass']));

            $newPassword = password_hash($rPass, PASSWORD_DEFAULT);
            $joinDate = date("d M Y");

            $search = "SELECT * FROM user WHERE email = '$rEmail'";
            $search = $conn->query($search);

            if ($search->num_rows > 0) {
                echo "
                    <script>
                        alert('email $rEmail telah terdaftar');
                    </script>
                    ";
            } else {
                $query = "INSERT INTO user VALUES ('', '$rEmail', '$newPassword', '$rName', 'user.png', '1', '$joinDate')";
                mysqli_query($conn, $query);
                if (mysqli_affected_rows($conn) > 0) {
                    $_SESSION['verify'] = TRUE;
                    $new = "SELECT * FROM user WHERE email = '$rEmail'";
                    $new = $conn->query($new);
                    if ($new->num_rows > 0) {
                        $new = mysqli_fetch_assoc($new);
                        $_SESSION['id'] = $new['id'];
                    }
                    echo "
                        <script>
                            window.location.href = 'index.php?page=home'
                        </script>
                        ";
                }
            }
            // Syntax untk login
        } elseif ($formType === "login") {
            $lEmail = htmlspecialchars($_POST['lemail']);
            $lPassword = htmlentities($_POST['lpassword']);

            // verifikasi email
            $search = "SELECT * FROM user WHERE email = '$lEmail'";
            $search = $conn->query($search);

            if ($search->num_rows > 0) {
                $row = mysqli_fetch_assoc($search);
                //
                if (password_verify($lPassword, $row['password'])) {
                    if ($row['role_id'] <= 1) {
                        $_SESSION = [
                            "verify" => true,
                            "id" => $row['id']
                        ];
                        $conn->close();
                        echo "
                        <script>
                        window.location.href = 'index.php?page=home'
                        </script>
                        ";
                    } else if ($row['role_id'] >= 2) {
                        $_SESSION = [
                            "verify" => true,
                            "id" => $row['id']
                        ];
                        $conn->close();
                        echo "
                        <script>
                        window.location.href = 'admin_page.php?adm_pg=dashboard'
                        </script>
                        ";
                    }
                } else {
                    echo "
                        <script>
                            document.getElementById('lAlertPassword').innerHTML = 'Password wrong';
                        </script>
                    ";
                }
            } else {
                echo "
                    <script>
                        document.getElementById('lAlertEmail').innerHTML = 'Email not registered';
                    </script>
                ";
            }
        } else {
            echo "
            <script>
                alert('tidak ada form');
            </>
            ";
        }
    }
}
?>