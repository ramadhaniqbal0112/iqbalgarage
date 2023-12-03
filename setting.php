<?php
if ($user['role_id'] != 3) {
    $type = "password";
    $disabled = "disabled";
} else {
    $type = "text";
    $disabled = false;
}

if (isset($_POST['change'])) {
    $garageName = htmlspecialchars($_POST['garage']);
    $address = htmlspecialchars($_POST['address']);
    $whatsapp = htmlspecialchars($_POST['whatsapp']);
    $email = htmlspecialchars($_POST['email']);
    if ($disabled === "disabled") {
        $security = false;
    } else {
        $security = htmlspecialchars($_POST['security']);
    }
    // $error[4] = empty($security) ? "The security password cannot be empty" : false;

    if (empty($garageName) || empty($address) || empty($whatsapp) || empty($email)) {
        $error[0] = empty($garageName) ? "The name of the garage must be filled in" : false;
        $error[1] = empty($address) ? "Garage address must be filled in" : false;
        $error[2] = empty($whatsapp) ? "WhatsApp number must be filled in" : false;
        $error[3] = empty($email) ? "Email must be filled in" : false;
    } else if ($disabled === "disabled") {
        $sql = "UPDATE web_setting SET garage_name = ? , address = ? , whatsapp = ? , email = ? ";
        $stmt = $conn->prepare($sql);
        if ($stmt) {
            $stmt->bind_param("ssss", $garageName, $address, $whatsapp, $email);

            if ($stmt->execute()) {
                echo "
                    <script>
                        document.location.href = 'admin_page.php?adm_pg=setting';
                    </script>
                ";
            }
        }
    } else if ($disabled !== "disabled") {
        if (empty($security)) {
            $error[4] = empty($security) ? "The security password cannot be empty" : false;
        } else {
            $sql = "UPDATE web_setting SET garage_name = ? , address = ? , whatsapp = ? , email = ? , password_security = ? ";
            $stmt = $conn->prepare($sql);
            if ($stmt) {
                $stmt->bind_param("sssss", $garageName, $address, $whatsapp, $email, $security);

                if ($stmt->execute()) {
                    echo "
                    <script>
                        document.location.href = 'admin_page.php?adm_pg=setting';
                    </script>
                ";
                }
            }
        }
    }
}

?>


<main class="container mt-5 pb-5 d-flex">
    <section class="rounded-3 bg-light shadow-lg mx-auto" style="width: 650px; max-width: 100%;">
        <form action="" method="post" class="p-4 d-flex flex-column gap-3">
            <div>
                <label class="fw-semibold" for="garageName">Garage Name:</label>
                <input type="text" id="garageName" name="garage" class="form-control border-top-0 border-start-0 border-end-0 border-dark rounded-0" value="<?= $webSetting['garage_name'] ?>">
                <div class="text-danger fst-italic" style="font-size: 13px;"><?= isset($error[0]) ? $error[0] : false; ?></div>
            </div>
            <hr class="text-primary">
            <div>
                <label class="fw-semibold" for="address">Address:</label>
                <input type="text" id="address" name="address" class="form-control border-top-0 border-start-0 border-end-0 border-dark rounded-0" value="<?= $webSetting['address'] ?>">
                <div class="text-danger fst-italic" style="font-size: 13px;"><?= isset($error[1]) ? $error[1] : false; ?></div>
            </div>
            <hr class="text-primary">
            <div>
                <label class="fw-semibold" for="whatsapp">Whatsapp:</label>
                <input type="number" id="whatsapp" name="whatsapp" class="form-control border-top-0 border-start-0 border-end-0 border-dark rounded-0" value="<?= $webSetting['whatsapp'] ?>">
                <div class="text-danger fst-italic" style="font-size: 13px;"><?= isset($error[2]) ? $error[2] : false; ?></div>
            </div>
            <hr class="text-primary">
            <div>
                <label class="fw-semibold" for="email">Email:</label>
                <input type="email" id="email" name="email" class="form-control border-top-0 border-start-0 border-end-0 border-dark rounded-0" value="<?= $webSetting['email'] ?>">
                <div class="text-danger fst-italic" style="font-size: 13px;"><?= isset($error[3]) ? $error[3] : false; ?></div>
            </div>
            <hr class="text-primary">
            <div>
                <label class="fw-semibold" for="security">Security Password:</label>
                <input type="<?= $type ?>" <?= $disabled ?> id="security" name="security" class="form-control border-top-0 border-start-0 border-end-0 border-dark rounded-0" value="<?= $webSetting['password_security'] ?>">
                <div class="text-danger fst-italic" style="font-size: 13px;"><?= isset($error[4]) ? $error[4] : false; ?></div>
            </div>
            <hr class="text-primary">
            <div>
                <input type="submit" name="change" value="Change" class="btn btn-primary">
            </div>
        </form>
    </section>
</main>