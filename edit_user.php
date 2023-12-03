<?php
if (isset($_REQUEST['id'])) {
    $userId = $_REQUEST['id'];
    $sql = "SELECT * FROM user WHERE id = '$userId'";
    $dataUser = $conn->query($sql);

    if ($dataUser->num_rows > 0) {
        $dataUser = mysqli_fetch_assoc($dataUser);
    } else {
        echo "
            <script>
                window.location.href = 'admin_page.php?adm_pg=user';
            </script>
        ";
    }
}

if (isset($_POST['submit'])) {
    $newRoleId = $_POST['role_id'];
    $id = $dataUser['id'];
    if ($newRoleId == 1 or $newRoleId == 2 or $newRoleId == 3) {
        $sql = "UPDATE user SET role_id = '$newRoleId' WHERE id = '$id'";
        $result = $conn->query($sql);
        if ($result) {
            echo "
            <script>
                window.location.href = 'admin_page.php?adm_pg=edt_usr&id=$id';
            </script>
            ";
        }
    }
}
?>



<main class="container mt-4 d-flex">
    <section class="mx-auto p-3 rounded-3 shadow-lg bg-light" style="width: 800px; max-width: 100%;">
        <section class="row mx-0">
            <div class="col-lg d-flex justify-content-center">
                <div>
                    <img src="user_img/<?= $dataUser['img'] ?>" alt="user profil" class="img-fluid border" style="width: 220px; height: auto; max-width: 100%;">
                </div>
            </div>
            <div class="col-lg p-3 ">
                <div class="">
                    <h4 class="inter fw-bold" style="color: #001524;"><?= $dataUser['name'] ?></h4>
                    <h5 class="raleway mt-3"><?= $dataUser['role_id'] == 1 ? "Regular User" : ($dataUser['role_id'] == 2 ? "Regular Admin" : ($dataUser['role_id'] == 3 ? "Super Admin" : ""))  ?></h5>
                    <hr class="mt-5">
                    <form action="" method="post">
                        <div class="row mx-0 aling-items-center">
                            <div class="col-4 ps-0 pe-1 d-flex justify-content-between">
                                <label for="email" class="my-auto">Email</label>
                                <span class="my-auto">:</span>
                            </div>
                            <div class="col-8 ps-1 pe-0">
                                <input type="email" class="form-control" disabled value="<?= $dataUser['email'] ?>">
                            </div>
                        </div>
                        <div class="row mx-0 aling-items-center mt-2">
                            <div class="col-4 ps-0 pe-1 d-flex justify-content-between">
                                <label for="join" class="my-auto">Join Date</label>
                                <span class="my-auto">:</span>
                            </div>
                            <div class="col-8 ps-1 pe-0">
                                <input type="email" id="join" class="form-control" disabled value="<?= $dataUser['join_date'] ?>">
                            </div>
                        </div>
                        <div class="row mx-0 aling-items-center mt-2">
                            <div class="col-4 ps-0 pe-1 d-flex justify-content-between">
                                <label for="role_id" class="my-auto">Role Id</label>
                                <span class="my-auto">:</span>
                            </div>
                            <div class="col-8 ps-1 pe-0">
                                <select name="role_id" id="role_id" class="form-control">
                                    <?php
                                    switch ($user['role_id']) {
                                        case 2:
                                            $selUser = "";
                                            $selRegAdm = "";
                                            $selSupAdm = "disabled class='text-secondary'";
                                            break;
                                        case 3:
                                            $selUser = "";
                                            $selRegAdm = "";
                                            $selSupAdm = "";
                                            break;
                                    }
                                    ?>
                                    <option <?= $selUser ?> value="1" <?= $dataUser['role_id'] == 1 ? "selected" : ""; ?>>User</option>
                                    <option <?= $selRegAdm ?> value="2" <?= $dataUser['role_id'] == 2 ? "selected" : ""; ?>>Regular Admin</option>
                                    <option <?= $selSupAdm ?> value="3" <?= $dataUser['role_id'] == 3 ? "selected" : ""; ?>>Super Admin</option>
                                </select>
                            </div>
                        </div>
                        <input type="submit" value="Submit" name="submit" class="mt-3 btn btn-success">
                    </form>

                </div>
            </div>
        </section>
    </section>

</main>