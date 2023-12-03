<?php
$id = $user['id'];
if (isset($_POST['changePicture'])) {
    if (!empty($_FILES['picture']['name'])) {
        $pictureName = htmlspecialchars($_FILES['picture']['name']);
        $pictureSize = $_FILES['picture']['size'];
        $pictureError = $_FILES['picture']['error'];
        $pictureTmp = $_FILES['picture']['tmp_name'];

        $extensionImageValid = ['jpg', 'jpeg', 'png', 'JPG', 'JPEG', 'PNG'];
        $extensionImage = explode('.', $pictureName);
        $extensionImage = strtolower(end($extensionImage));

        if ($pictureError === 4 || $pictureSize > 1500000 || !in_array($extensionImage, $extensionImageValid)) {
            $errorMessage['img'] = !in_array($extensionImage, $extensionImageValid) ? "Invalid image extension, only (jpg, jpeg, png)" : ($pictureError === 4 ? "Select an image first" : ($pictureSize > 1500000 ? "File size is too large (must be under 1.5 Mb)" : false));
        } else {
            $newPictureName = uniqid();
            $newPictureName .= ".";
            $newPictureName .= $extensionImage;

            $query = "UPDATE user SET img = ? WHERE id = '$id'";
            $stmt = $conn->prepare($query);

            if ($stmt) {
                $stmt->bind_param("s", $newPictureName);

                if ($stmt->execute()) {
                    $uploadDirectory = "user_img/";
                    $target = $uploadDirectory . $newPictureName;
                    $oldPicture = $user['img'];

                    if (move_uploaded_file($pictureTmp, $target)) {
                        if (file_exists($uploadDirectory . $oldPicture) && $oldPicture != 'user.png') {
                            unlink($uploadDirectory . $oldPicture);
                            echo "
                                <script>
                                document.location.href = 'admin_page.php?adm_pg=edt_act';
                                </script>
                            ";
                        } else {
                            echo "
                                <script>
                                document.location.href = 'admin_page.php?adm_pg=edt_act';
                                </script>
                            ";
                        }
                    }
                } else {
                    var_dump("Error: " . $stmt->error);
                }
                $stmt->close();
            } else {
                var_dump("Error: " . $conn->error);
            }
        }
    } else {
        $errorMessage['img'] = "Select an image first";
    }
}

if (isset($_POST['changeData'])) {
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);

    if (empty($name) || empty($email)) {
        $errorMessage['name'] = empty($name) ? "The name form cannot be empty" : false;
        $errorMessage['email'] = empty($email) ? "The email form cannot be empty" : false;
    } else {
        if ($name != $user['name'] or $email != $user['email']) {
            $query = "UPDATE user SET name = ? , email = ? WHERE id = '$id'";
            $stmt = $conn->prepare($query);

            if ($stmt) {
                $stmt->bind_param("ss", $name, $email);

                if ($stmt->execute()) {
                    echo "
                    <script>
                    document.location.href = 'admin_page.php?adm_pg=edt_act';
                    </script>
                    ";
                }
            }
        }
    }
}

if (isset($_POST['changePassword'])) {
    $password = htmlspecialchars($_POST['password']);
    $newPassword = mysqli_escape_string($conn, htmlspecialchars($_POST['newPassword']));
    $repeatNewPassword = htmlspecialchars($_POST['repeatNewPassword']);

    if (password_verify($password, $user['password'])) {
        if ($newPassword != $repeatNewPassword || empty(trim($repeatNewPassword))) {
            $errorMessage['repeat new pass'] = $newPassword != $repeatNewPassword ? "Your new password is not the same" : (empty(trim($repeatNewPassword)) ? "Confirm your new password!" : false);
        } else {
            if ($newPassword != $password) {
                $newPassword = password_hash($newPassword, PASSWORD_DEFAULT);
                $query = "UPDATE user SET password = '$newPassword' WHERE id = '$id'";
                $result = $conn->query($query);

                if ($result) {
                    echo "
                    <script>
                        alert('Password changed successfully');
                        document.location.href = 'admin_page.php?adm_pg=edt_act';
                    </script>
                    ";
                } else {
                    echo "
                    <script>
                        alert('Password failed to change');
                    </script>
                    ";
                }
            } else {
                $errorMessage['new pass'] = "You should not use the same password as before";
            }
        }
    } else {
        $errorMessage['pass'] = "Your password is wrong";
    }
}

?>
<section class="container py-3 d-flex">
    <div class="mx-auto d-flex flex-column border p-4 shadow-lg rounded rounded-3" style="width: 600px; max-width: 100%;">
        <div class="mx-auto" style="width: 260px; max-width: 100%;">
            <img src="user_img/<?= $user['img'] ?>" alt="user image" class="w-100 border border-3 rounded-2 shadow-md">
            <div class="d-flex justify-content-between px-1">
                <div class="dropdown d-flex p-0">
                    <button type="button" class="btn btn-light dropdown-toggle py-1 px-2" data-bs-toggle="dropdown" aria-expanded="false" data-bs-auto-close="outside">
                        <i class="fa-solid fa-pen fa-xl"></i>
                    </button>
                    <form id="changePhoto" method="post" enctype="multipart/form-data" class="dropdown-menu p-4" style="width: 250px; max-width: 125%; overflow-x: scroll;">
                        <div class="mb-3">
                            <input type="file" name="picture" class="form-contro">
                        </div>
                        <button type="submit" name="changePicture" class="btn btn-primary">Change</button>
                    </form>
                </div>
                <button class="btn btn-light py-1 px-3 fa-md" onclick="confrimRemoveProfiePicture(<?= $id ?>)">
                    <i class="fa-regular fa-trash-can fa-xl"></i>
                </button>
            </div>
            <div class="text-center mt-1"><small class="text-danger"><?= isset($errorMessage['img']) ? $errorMessage['img'] : false ?></small></div>
        </div>
        <section id="editData" class="pt-3 d-flex">
            <form id="myForm" action="" method="post" class="mx-auto" style="width: 450px; max-width: 100%;">
                <section class="d-flex flex-column gap-3">
                    <div>
                        <input type="text" name="name" class="form-control mb-0" value="<?= $user['name'] ?>">
                        <div class="text-danger ps-2 fst-italic" style="font-size: 14px;"><?= isset($errorMessage['name']) ? $errorMessage['name'] : false ?></div>
                    </div>
                    <div>
                        <input type="email" name="email" class="form-control mb-0" value="<?= $user['email'] ?>">
                        <div class="text-danger ps-2 fst-italic" style="font-size: 14px;"><?= isset($errorMessage['email']) ? $errorMessage['email'] : false ?></div>
                    </div>
                    <div class="row justify-content-center gap-3 mx-0">
                        <input type="submit" value="Certain" name="changeData" class="btn btn-success col-md">
                        <button type="button" class="btn btn-warning text-light col-md" onclick="changePassword()">Change Password</button>
                    </div>
                </section>
            </form>
        </section>
        <section id="editPassword" class="pt-3 d-none">
            <form id="myForm" action="" method="post" class="mx-auto" style="width: 450px; max-width: 100%;">
                <section class="d-flex flex-column gap-3">
                    <div>
                        <input type="password" name="password" class="form-control mb-0" placeholder="Enter your old password">
                        <div class="text-danger ps-2 fst-italic" style="font-size: 14px;"><?= isset($errorMessage['pass']) ? $errorMessage['pass'] : false ?></div>
                    </div>
                    <div>
                        <input type="password" name="newPassword" class="form-control mb-0" placeholder="Create a new password">
                        <div class="text-danger ps-2 fst-italic" style="font-size: 14px;"><?= isset($errorMessage['new pass']) ? $errorMessage['new pass'] : false ?></div>
                    </div>
                    <div>
                        <input type="password" name="repeatNewPassword" class="form-control mb-0" placeholder="Create a new password">
                        <div class="text-danger ps-2 fst-italic" style="font-size: 14px;"><?= isset($errorMessage['repeat new pass']) ? $errorMessage['repeat new pass'] : false ?></div>
                    </div>
                    <div class="row justify-content-center gap-3 mx-0">
                        <button type="button" class="btn btn-primary text-light col-md" onclick="changeData()">Back</button>
                        <input type="submit" value="Confirm" name="changePassword" class="btn btn-danger col-md">
                    </div>
                </section>
            </form>
        </section>
    </div>
</section>


<script>
    function confrimRemoveProfiePicture(id) {
        var result = confirm("Are you sure you want to delete your profile photo?");

        if (result) {
            document.location.href = "delete.php?q=pi&id=" + id;
        }
    }

    function changePassword() {
        var formData = document.getElementById("editData");
        var formPassowrd = document.getElementById("editPassword");

        if (formData.style.display !== "none" && formPassowrd.style.display !== "flex") {
            formData.classList.replace('d-flex', 'd-none');
            formPassowrd.classList.replace('d-none', 'd-flex');
        }
    }

    function changeData() {
        var formData = document.getElementById("editData");
        var formPassowrd = document.getElementById("editPassword");

        if (formData.style.display !== "flex" && formPassowrd.style.display !== "none") {
            formData.classList.replace('d-none', 'd-flex');
            formPassowrd.classList.replace('d-flex', 'd-none');
        }
    }
</script>