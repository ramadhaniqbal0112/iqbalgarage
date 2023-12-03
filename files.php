<?php
if (isset($_POST['upload'])) {
    $pictureName = htmlspecialchars($_FILES['image']['name']);
    $pictureSize = $_FILES['image']['size'];
    $pictureError = $_FILES['image']['error'];
    $pictureTmp = $_FILES['image']['tmp_name'];

    $extensionImageValid = ['jpg', 'jpeg', 'png', 'JPG', 'JPEG', 'PNG'];
    $extensionImage = explode('.', $pictureName);
    $extensionImage = strtolower(end($extensionImage));

    if ($pictureError === 4 || $pictureSize > 1500000 || !in_array($extensionImage, $extensionImageValid)) {
        $errorMessage['img'] = !in_array($extensionImage, $extensionImageValid) ? "Invalid image extension, only (jpg, jpeg, png)" : ($pictureError === 4 ? "Select an image first" : ($pictureSize > 1500000 ? "File size is too large (must be under 1.5 Mb)" : false));
    } else {
        $newPictureName = uniqid();
        $newPictureName .= ".";
        $newPictureName .= $extensionImage;
        $date = date("d M Y");

        $query = "INSERT INTO gallery VALUES ('', '$newPictureName', '$date')";
        $stmt = $conn->prepare($query);

        if ($stmt->execute()) {
            $uploadDirectoryTarget = "img/gallery/" . $newPictureName;

            if (move_uploaded_file($pictureTmp, $uploadDirectoryTarget)) {
                echo "
                    <script>
                        alert('Image upload success');
                        document.location.href = 'admin_page.php?adm_pg=files';
                        </script>
                        ";
            } else {
                echo "
                        <script>
                        alert('Image upload failed');
                        document.location.href = 'admin_page.php?adm_pg=files';
                    </script>
                ";
            }
        } else {
            echo "
            <script>
                alert('Image upload failed');
            </script>
        ";
        }
        $stmt->close();
    }
}


?>


<main class="container mt-4">
    <section class="" style="width: 600px; max-width: 100%;">
        <h5 class="kanit" style="color: #2f3e46;">Gallery Image Input</h5>
        <hr class="my-2">
        <section class="ps-2">
            <form action="" method="post" enctype="multipart/form-data">
                <div>
                    <label for="image" class="ps-1">Insert Image <span class="text-danger">*</span></label>
                    <input type="file" name="image" id="image" class="form-control">
                    <div></div>
                </div>
                <div class="mt-3">
                    <input type="submit" value="Upload" name="upload" class="btn btn-primary">
                </div>
            </form>
        </section>
    </section>
    <hr class="mt-5">

    <section class="d-flex">
        <div class="mx-auto table-responsive" style="height: 600px;">
            <table class="table table-dark table-bordered table-hover table-striped" style="width: 1000px;">
                <thead>
                    <tr class="text-center">
                        <th>No</th>
                        <th>Action</th>
                        <th>Id</th>
                        <th>Image</th>
                        <th>Uniq</th>
                        <th>Upload Date</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $x = 1;
                    $gallery = "SELECT * FROM gallery ORDER BY id DESC";
                    $gallery = $conn->query($gallery);
                    $gallery = $gallery ? $gallery : false;

                    foreach ($gallery as $row) :
                    ?>
                        <tr>
                            <th class="text-center"><?= $x ?></th>
                            <td>
                                <div class="text-center">
                                    <a href="delete.php?q=gl&id=<?= $row['id'] ?>" class="btn btn-light">Delete</a>
                                </div>
                            </td>
                            <td class="text-center"><?= $row['id'] ?></td>
                            <td>
                                <div class="text-center">
                                    <img src="img/gallery/<?= $row['uniq'] ?>" alt="img" style="width: 120px; max-width: 100%;">
                                </div>
                            </td>
                            <td><?= $row['uniq'] ?></td>
                            <td><?= $row['upload_date'] ?></td>
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