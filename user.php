<?php
$passwordSecurity = $webSetting['password_security'];
$users = "SELECT * FROM user WHERE role_id = '1'";
$users = $conn->query($users);
$users = $users ? $users : $conn->error;

$regularAdmins = "SELECT * FROM user WHERE role_id = '2'";
$regularAdmins = $conn->query($regularAdmins);
$regularAdmins = $regularAdmins ? $regularAdmins : $conn->error;

$superAdmins = "SELECT * FROM user WHERE role_id = '3'";
$superAdmins = $conn->query($superAdmins);
$superAdmins = $superAdmins ? $superAdmins : $conn->error;



?>


<main class="container-fluid mt-5 d-flex flex-column gap-5">
    <div class="table-responsive mx-auto table-of-users" style="height: 450px; overflow-y: scroll;">
        <table class="table table-bordered table-primary table-hover table-striped" style="width: 1200px;">
            <caption>List of users</caption>
            <thead>
                <tr class="text-center">
                    <th scope="col">No</th>
                    <th scope="col" style="width: 130px;">Action</th>
                    <th scope="col">Id</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Role Id</th>
                    <th scope="col">Join Date</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $x = 1;
                foreach ($users as $row) :
                ?>
                    <tr>
                        <td class="text-center"><?= $x ?></td>
                        <td class="d-flex gap-1 justify-content-center">
                            <a href="admin_page.php?adm_pg=edt_usr&id=<?= $row['id'] ?>" class="btn btn-primary">Edit</a>
                            <button class="btn btn-danger" <?= $user['role_id'] < 3 ? "disabled" : "" ?> onclick="del(<?= $row['id'] ?>)">Del</button>
                        </td>
                        <td class="text-center"><?= $row['id'] ?></td>
                        <td><?= $row['name'] ?></td>
                        <td><?= $row['email'] ?></td>
                        <td class="text-center"><?= $row['role_id'] ?></td>
                        <td><?= $row['join_date'] ?></td>
                    </tr>
                <?php
                    $x++;
                endforeach;
                ?>
            </tbody>
        </table>
    </div>
    <div class="table-responsive mx-auto">
        <table class="table table-bordered table-warning table-hover table-striped" style="width: 1200px;">
            <caption>List of regular admins</caption>
            <thead>
                <tr class="text-center">
                    <th scope="col">No</th>
                    <th scope="col" style="width: 130px;">Action</th>
                    <th scope="col">Id</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Role Id</th>
                    <th scope="col">Join Date</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $x = 1;
                foreach ($regularAdmins as $row) :
                ?>
                    <tr>
                        <td class="text-center"><?= $x ?></td>
                        <td class="d-flex gap-1 justify-content-center">
                            <a href="admin_page.php?adm_pg=edt_usr&id=<?= $row['id'] ?>" class="btn btn-primary">Edit</a>
                            <button class="btn btn-danger" onclick="del(<?= $row['id'] ?>)" <?= $user['role_id'] < 3 ? "disabled" : "" ?>>Del</button>
                        </td>
                        <td class="text-center"><?= $row['id'] ?></td>
                        <td><?= $row['name'] ?></td>
                        <td><?= $row['email'] ?></td>
                        <td class="text-center"><?= $row['role_id'] ?></td>
                        <td><?= $row['join_date'] ?></td>
                    </tr>
                <?php
                    $x++;
                endforeach;
                ?>
            </tbody>
        </table>
    </div>
    <div class="table-responsive mx-auto">
        <table class="table table-bordered table-danger table-hover table-striped" style="width: 1200px;">
            <caption>List of super admins</caption>
            <thead>
                <tr class="text-center">
                    <th scope="col">No</th>
                    <th scope="col" style="width: 130px;">Action</th>
                    <th scope="col">Id</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Role Id</th>
                    <th scope="col">Join Date</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $x = 1;
                foreach ($superAdmins as $row) :
                ?>
                    <tr>
                        <td class="text-center"><?= $x ?></td>
                        <td class="d-flex gap-1 justify-content-center">
                            <a href="admin_page.php?adm_pg=edt_usr&id=<?= $row['id'] ?>" class="btn btn-primary">Edit</a>
                            <button class="btn btn-danger" onclick="del(<?= $row['id'] ?>)" <?= $user['role_id'] < 3 ? "disabled" : "" ?>>Del</button>
                        </td>
                        <td class="text-center"><?= $row['id'] ?></td>
                        <td><?= $row['name'] ?></td>
                        <td><?= $row['email'] ?></td>
                        <td class="text-center"><?= $row['role_id'] ?></td>
                        <td><?= $row['join_date'] ?></td>
                    </tr>
                <?php
                    $x++;
                endforeach;
                ?>
            </tbody>
        </table>
    </div>
</main>

<script>
    function del(id) {
        var result = prompt("Enter the super admin password: ")

        if (result === "<?= $passwordSecurity ?>") {
            window.location.href = "delete.php?q=us&id=" + id;
        } else {
            alert("Password wrong");
        }
    }
</script>