<?php
$sql = "SELECT * FROM gallery ORDER BY id DESC";
$gallery = $conn->query($sql);
$gallery = $gallery ? $gallery : false;


?>


<main class="container my-4">
    <div class="row mx-0">
        <?php
        foreach ($gallery as $row) :
        ?>
            <div class="col-md-4 py-2 px-3 d-flex" data-aos="fade-up" data-aos-duration="1500" data-aos-offset="200">
                <img src="img/gallery/<?= $row['uniq'] ?>" altgallery class="m-auto" style="width: 300px; max-width: 100%;">
            </div>
        <?php endforeach; ?>
    </div>

</main>