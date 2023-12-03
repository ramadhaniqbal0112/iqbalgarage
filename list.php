<?php
$query = "SELECT * FROM booking ORDER BY id DESC";
$list = $conn->query($query);

?>


<main class="container my-5">
    <section class="d-flex">
        <div class="table-responsive mx-auto">
            <table class="table table-dark" style="width: 1200px;">
                <thead>
                    <tr class="text-center">
                        <th>No</th>
                        <th>Id</th>
                        <th>Action</th>
                        <th>Stattus</th>
                        <th>Name</th>
                        <th>Type</th>
                        <th>Hour</th>
                        <th>Email</th>
                        <th>Whatsapp Number</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $x = 1;
                    foreach ($list as $row) :
                        $idList = $row['id'];
                    ?>
                        <tr class="text-center">
                            <td><?= $x ?></td>
                            <td><?= $idList ?></td>
                            <a href="delete.php?q=done&id="></a>
                            <td>
                                <?= $row['stattus'] == 0 ? "<a href='delete.php?q=done&id=$idList' class='btn btn-light py-1 px-3'>Done</a>" : ($row['stattus'] == 1 ? '-' : false) ?>
                                <a href="delete.php?q=dl&id=<?= $idList ?>" class="btn btn-danger px-3 py-1 ms-2">Del</a>
                            </td>
                            <td><?= $row['stattus'] == 0 ? '<i class="fa-solid fa-circle text-danger"></i>' : ($row['stattus'] == 1 ? '<i class="fa-solid fa-circle text-success"></i>' : false) ?></td>
                            <td class="text-start"><?= $row['name'] ?></td>
                            <td><?= $row['type'] ?></td>
                            <td><?= $row['hour'] ?></td>
                            <td class="text-start"><?= $row['email'] ?></td>
                            <td class="text-start"><?= $row['whatsapp'] ?></td>
                        </tr>
                    <?php
                        $x++;
                    endforeach;
                    ?>
                </tbody>
            </table>
        </div>
    </section>
</main>