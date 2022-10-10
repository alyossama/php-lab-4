<?php
// Start the session to receive the validation errors and old values
session_start();

require_once("./app/Models/User.php");

if (isset($_SESSION['show-user-id'])) {
    $userObject = new User;
    $userObject->setId($_SESSION['show-user-id']);
    $userFetch = $userObject->getById();
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <!-- Bootstrap CSS -->
    <!-- https://cdnjs.com/libraries/twitter-bootstrap/5.0.0-beta1 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.0-beta1/css/bootstrap.min.css" />

    <!-- Icons: https://getbootstrap.com/docs/5.0/extend/icons/ -->
    <!-- https://cdnjs.com/libraries/font-awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" />

    <title>User profile</title>

</head>
<!-- start body -->

<body>
    <div class="container">
        <?php if (isset($userFetch)) {
            $userDetails = $userFetch->fetch_all(MYSQLI_ASSOC);
            foreach ($userDetails as $detail => $value) {
        ?>
                <!-- Start values row -->
                <div class="row my-5 justify-content-center">
                    <div class="col-6 border border-info rounded-3 ">
                        <p class="h3">User Details</p>
                        <!-- Name -->
                        <div class="row my-2">
                            <div class="col-3 fw-bold">Name</div>
                            <div class="col-8"><?= $value['name'] ?></div>
                        </div>
                        <!-- Email -->
                        <div class="row mb-2">
                            <div class="col-3 fw-bold">Email</div>
                            <div class="col-8"><?= $value['email'] ?></div>
                        </div>
                        <!-- Gender -->
                        <div class="row mb-2">
                            <div class="col-3 fw-bold">Gender</div>
                            <div class="col-8"><?= $value['gender'] ?></div>
                        </div>
                        <!-- Mail status -->
                        <div class="row mb-2">
                            <div class="col-3 fw-bold">Mail status</div>
                            <div class="col-8"><?= $value['mail_status'] ?></div>
                        </div>

                    </div>
                </div>
        <?php
            }
        }
        ?>


    </div>

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.0-beta1/js/bootstrap.bundle.min.js"></script>
</body>
<!-- end body -->

</html>
<?php
// Unset the session to remove old validation errors
session_unset();
?>