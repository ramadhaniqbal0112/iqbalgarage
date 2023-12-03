<?php
$msg = false;
if (isset($_POST['booking'])) {
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $whatsapp = htmlspecialchars($_POST['whatsapp']);
    $type = htmlspecialchars($_POST['type']);
    $hour = htmlspecialchars($_POST['hour']);

    if (
        empty($name) || empty($email) || empty($whatsapp) || empty($type)
        || empty($hour) || $hour < "09:00" || $hour > "14:00"
    ) {
        $empty[0] = empty($name) ? "Customer Name cannot be left blank" : false;
        $empty[1] = empty($email) ? "Customer Email must not be left blank" : false;
        $empty[2] = empty($whatsapp) ? "Enter Your whatsapp number" : false;
        $empty[3] = empty($type) ? "Select the type of service You want" : false;
        $empty[4] = empty($hour) ? "Determine the order time" : (($hour < "09:00" || $hour > "14:00") ? "Choose a time above 9 am and below 2 pm" : false);
        $msg = '
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                Oh No! Something seems wrong, please check Your form.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        ';
        // Oh no, something seems wrong, please check your form
    } else {
        $query = "INSERT INTO booking VALUES ('', '$name', '$email', '$whatsapp', '$type', '$hour', '0')";
        $result = $conn->prepare($query);

        if ($result->execute()) {
            $msg = '
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong class="text-success">Thank You!</strong> Your request has been sent.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
        }
    }
}


?>


<main>
    <section class="about-us-jumbotron position-relative d-flex">
        <div class="position-absolute">
        </div>
        <div class="m-auto p-5">
            <h5 class="text-center kdam-thmor-pro">Booking Service</h5>
            <p class="text-center inter"><a href="index.php?page=home">Home</a>&nbsp;\&nbsp;<a href="index.php?page=booking">Booking Service</a></p>
        </div>
    </section>
    <section class="container mt-5 py-5 d-flex">
        <div class="form-booking mx-auto p-4 rounded" style="width: 600px; max-width: 100%;">
            <?php
            echo $msg;
            if (isset($_SESSION['verify']) && $_SESSION['verify'] === TRUE) {            ?>
                <form action="" method="POST">
                    <div class="d-flex flex-column gap-3">
                        <div>
                            <label for="nameCustomer">Name:</label>
                            <input type="text" id="nameCustomer" class="form-control" name="name" value="<?= $user['name'] ?>">
                            <div class="form-text text-danger ps-2"><?= isset($empty[0]) ? $empty[0] : false ?></div>
                        </div>
                        <div>
                            <label for="emailCustomer">Email:</label>
                            <input type="email" id="emailCustomer" class="form-control" name="email" value="<?= $user['email'] ?>">
                            <div class="form-text text-danger ps-2"><?= isset($empty[1]) ? $empty[1] : false ?></div>
                        </div>
                        <div>
                            <label for="whatsappCustomer">Whatsapp Number:</label>
                            <input type="tel" id="whatsappCustomer" class="form-control" name="whatsapp">
                            <div class="form-text text-danger ps-2"><?= isset($empty[2]) ? $empty[2] : false ?></div>
                        </div>
                        <div>
                            <label for="type">Type of Service:</label>
                            <select class="form-control text-dark" name="type" id="type">
                                <option class="text-dark" value="oil">Oil Change</option>
                                <option class="text-dark" value="light service">Light Service</option>
                                <option class="text-dark" value="heavy service">Heavy Service</option>
                                <option class="text-dark" value="spare parts">Replace Spare Parts</option>
                            </select>
                            <div class="form-text text-danger ps-2"><?= isset($empty[3]) ? $empty[3] : false ?></div>
                        </div>
                        <div>
                            <label for="hourCustomer">Select Hour:</label>
                            <input type="time" id="hourCustomer" class="form-control" name="hour">
                            <div class="form-text text-danger ps-2"><?= isset($empty[4]) ? $empty[4] : false ?></div>
                        </div>
                        <div class="row mx-0 mt-3 justify-content-center">
                            <input type="submit" value="Booking" name="booking" class="col-6 btn btn-warning text-light fw-bold">
                        </div>
                    </div>
                </form>
            <?php
            } else {
            ?>
                <div class="text-center">
                    <h1>You must have an account to utilize the ordering service features <i class="fa-solid fa-triangle-exclamation"></i></h1>
                    <a class="btn btn-light fw-bold mt-3" href="login_register.php">Sign-In / Registration</a>
                </div>

            <?php

            } ?>
        </div>

    </section>
</main>