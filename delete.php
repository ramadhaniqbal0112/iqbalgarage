<?php
require "function.php";
if (isset($_GET['q']) && isset($_GET['id'])) {
    $id = $_GET['id'];
    $user = "SELECT * FROM user WHERE id = '$id'";
    $user = $conn->query($user);

    if ($user->num_rows > 0) {
        $user = mysqli_fetch_assoc($user);
    }

    $gallery = "SELECT * FROM gallery WHERE id = '$id'";
    $gallery = $conn->query($gallery);

    if ($gallery->num_rows > 0) {
        $gallery = mysqli_fetch_assoc($gallery);
    }

    if ($_GET['q'] == "pi") {
        // fungsi untuk menghapus poto profil
        $sql = "UPDATE user SET img = 'user.png' WHERE id = '$id'";

        if ($conn->query($sql) === TRUE) {

            if (file_exists('user_img/' . $user['img']) && $user['img'] !== "user.png") {
                unlink("user_img/" . $user['img']);
                echo "
                <script>
                    alert('Profile photo successfully deleted');
                </script>
            ";
            }
            echo "
                <script>
                    document.location.href = 'admin_page.php?adm_pg=edt_act';
                </script>
            ";
        }
    } else if ($_GET['q'] == "us") {
        // fungsi untuk menghapus user
        $sql = "DELETE FROM user WHERE id = '$id'";
        if ($conn->query($sql) === TRUE) {
            if (file_exists("user_img/" . $user['img']) && $user['img'] !== "user.png") {
                unlink("user_img/" . $user['img']);
            }
            echo "
                <script>
                    alert('user with Id = $id has been deleted');
                    document.location.href = 'admin_page.php?adm_pg=user';
                </script>
            ";
        }
    } else if ($_GET['q'] == "gl") {
        // fungsi untuk menghapus content di dalam halaman gallery
        $sql = "DELETE FROM gallery WHERE id = '$id'";
        if ($conn->query($sql) === TRUE) {
            if (file_exists("img/gallery/" . $gallery['uniq'])) {
                unlink("img/gallery/" . $gallery['uniq']);
            }

            echo "
                <script>
                    alert('Image with Id =  $id successfully deleted');
                    document.location.href = 'admin_page.php?adm_pg=files';
                </script>
            ";
        }
    } else if ($_GET['q'] == "done") {
        // fungsi untuk memvalidasi jika layanan booking service telah selesai
        $sql = "UPDATE booking SET stattus = '1' WHERE id = '$id'";
        if ($conn->query($sql) > 0) {
            echo "
                <script>
                    window.location.href = 'admin_page.php?adm_pg=booking%20list';
                </script>
            ";
        }
    } else if ($_GET['q'] == "dl") {
        // fungsi untuk menghapus data pada tabel booking service
        $sql = "DELETE FROM booking WHERE id = '$id'";
        if ($conn->query($sql) > 0) {
            echo "
                <script>
                    window.location.href = 'admin_page.php?adm_pg=booking%20list';
                </script>
            ";
        }
    }
}
