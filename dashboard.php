<?php
if ($user['role_id'] == 2) {
    $welcomeMessage = "You are logged in as a regular admin";
} else if ($user['role_id'] == 3) {
    $welcomeMessage = "You are logged in as a super admin";
}
?>
<main class="py-5">
    <section class="container">
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Welcome, <?= $user['name'] ?>!</strong>&nbsp;<?= isset($welcomeMessage) ? $welcomeMessage : "" ?>.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    </section>
    <section class="container d-flex px-3 mt-5">
        <section id="adminCardContainer" class="row justify-content-between px-0 mx-0">
            <?php
            $card = [
                'bgColor' => ['#ffba08', '#f48c06', '#dc2f02', '#9d0208'],
                'title' => ['Number of Galleries', 'Number of Users', 'Number of Regular Admins', 'Number of Super Admins'],
                'amount' => [$numbOfGallery, $numbOfUser, $numbOfRegularAdmin, $numbOfSuperAdmin]
            ];

            foreach ($card['bgColor'] as $key => $bgColor) :
            ?>
                <div class="col-md-4 row rounded p-2 my-2" style="background-color: <?= $bgColor ?>;">
                    <div class="col-3 d-grid p-0">
                        <h5 class="m-auto" style="font-size: 66px;"><i class="fa-solid fa-user text-secondary-2"></i></h5>
                    </div>
                    <div class="col-9 d-flex flex-column border border-top-0 border-end-0 border-bottom-0">
                        <h4 class="text-secondary-2 inter fw-semibold`"><?= $card['title'][$key] ?></h4>
                        <h3 class="fw-bold text-secondary-2"><?= $card['amount'][$key] ?></h3>
                    </div>
                </div>
            <?php endforeach; ?>
        </section>
    </section>
    <div class="container px-0 my-5">
        <hr>
    </div>
    <section class="container">
        <section class="container mt-4 row justify-content-start gap-5 px-0 mx-0">
            <div class="col-md-4 row rounded p-2" style="background-color: #1b263b;">
                <div class="col-3 d-grid p-0">
                    <h5 class="m-auto" style="font-size: 66px;"><i class="fa-solid fa-user text-secondary-2"></i></h5>
                </div>
                <div class="col-9 d-flex flex-column border border-top-0 border-end-0 border-bottom-0">
                    <h4 class="text-secondary-2 inter fw-semibold`">Numb of Service (All)</h4>
                    <h3 class="fw-bold text-secondary-2"><?= $numberOfServiceAll ?></h3>
                </div>
            </div>
            <div class="col-md-4 row rounded p-2" style="background-color: #1b263b;">
                <div class="col-3 d-grid p-0">
                    <h5 class="m-auto" style="font-size: 66px;"><i class="fa-solid fa-user text-secondary-2"></i></h5>
                </div>
                <div class="col-9 d-flex flex-column border border-top-0 border-end-0 border-bottom-0">
                    <h4 class="text-secondary-2 inter fw-semibold`">Numb of Service (Done)</h4>
                    <h3 class="fw-bold text-secondary-2"><?= $numberOfServiceDone ?></h3>
                </div>
            </div>
        </section>
    </section>
</main>

<script>
    function responsiveAdminCards() {
        var adminCardContainer = document.getElementById("adminCardContainer");

        var windowWidth = window.innerWidth || document.documentElement.clientWidth || document.body.clientWidth;

        if (windowWidth < 767) {
            adminCardContainer.classList.replace("justify-content-between", 'justify-content-center');
        } else {
            adminCardContainer.classList.replace("justify-content-center", 'justify-content-between');
        }
    }

    window.onload = responsiveAdminCards;
    window.onresize = responsiveAdminCards;
</script>