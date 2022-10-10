<?php
// Start the session to receive the validation errors and old values
session_start();

require_once("./app/Models/User.php");

if (isset($_SESSION['edit-user-id'])) {
    $userObject = new User;
    $userObject->setId($_SESSION['edit-user-id']);
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

    <title>Edit User</title>

</head>
<!-- start body -->

<body>


    <div class="container">
        <!-- Start register row -->
        <div class="row my-5 justify-content-center">
            <div class="col-12 my-2">
                <p class="h1 text-center my-2">Edit user</p>
            </div>
            <div class="col-6">
                <small class="text-danger my-2">* Required field</small>
                <!-- Start registration form -->
                <form class="col-12" action="./app/Requests/UsersRequest.php" method="POST">

                    <?php
                    if (isset($userFetch)) {
                        $userDetails = $userFetch->fetch_all(MYSQLI_ASSOC);
                        foreach ($userDetails as $detail => $value) {


                    ?>
                            <input type="hidden" name="id" value="<?= $value['id'] ?>">
                            <!-- Start name input -->
                            <div class="mb-3 col-6">
                                <label for="name" class="form-label">Name <span class="text-danger">*</span></label>
                                <input class="form-control <?php if (isset($_SESSION['old-values']['name']) && !empty($_SESSION['old-values']['name'] && !isset($_SESSION['validation']['name-validation']))) {
                                                                echo "is-valid";
                                                            } elseif (isset($_SESSION['validation']['name-validation'])) {
                                                                echo "is-invalid";
                                                            } ?>" name="name" id="name" value="<?php
                                                                                                // get submitted value if it's valid
                                                                                                if (isset($_SESSION['old-values']['name'])) {
                                                                                                    echo $_SESSION['old-values']['name'];
                                                                                                } else {
                                                                                                    echo $value['name'];
                                                                                                } ?>">
                                <?php
                                // name validation
                                //required
                                if (isset($_SESSION['validation']['name-validation']['name-required'])) {
                                    $nameRequired = $_SESSION['validation']['name-validation']['name-required'];
                                }
                                //invalid
                                if (isset($_SESSION['validation']['name-validation']['name-invalid'])) {
                                    $nameInvalid = $_SESSION['validation']['name-validation']['name-invalid'];
                                }
                                ?>
                                <small class="text-danger"><?php if (isset($nameRequired)) {
                                                                echo $nameRequired;
                                                            } elseif (isset($nameInvalid)) {
                                                                echo $nameInvalid;
                                                            } ?></small>
                            </div>
                            <!-- End name input -->
                            <!-- Start email input -->
                            <div class="mb-3 col-6">
                                <label for="email" class="form-label">Email address <span class="text-danger">*</span></label>
                                <input class="form-control <?php if (isset($_SESSION['old-values']['email']) && !empty($_SESSION['old-values']['email'] && !isset($_SESSION['validation']['email-validation']))) {
                                                                echo "is-valid";
                                                            } elseif (isset($_SESSION['validation']['email-validation'])) {
                                                                echo "is-invalid";
                                                            } ?>" name="email" id="email" value="<?php
                                                                                                    // get submitted value if it's valid
                                                                                                    if (isset($_SESSION['old-values']['email'])) {
                                                                                                        echo $_SESSION['old-values']['email'];
                                                                                                    } else {
                                                                                                        echo $value['email'];
                                                                                                    } ?>">
                                <?php
                                // email validation
                                //required
                                if (isset($_SESSION['validation']['email-validation']['email-required'])) {
                                    $emailRequired = $_SESSION['validation']['email-validation']['email-required'];
                                }
                                //invalid
                                if (isset($_SESSION['validation']['email-validation']['email-invalid'])) {
                                    $emailInvalid = $_SESSION['validation']['email-validation']['email-invalid'];
                                }
                                //unique
                                if (isset($_SESSION['validation']['email-validation']['email-exists'])) {
                                    $emailExists = $_SESSION['validation']['email-validation']['email-exists'];
                                }
                                ?>
                                <small class="text-danger"><?php if (isset($emailRequired)) {
                                                                echo $emailRequired;
                                                            } elseif (isset($emailInvalid)) {
                                                                echo $emailInvalid;
                                                            } elseif (isset($emailExists)) {
                                                                echo $emailExists;
                                                            } ?></small>
                            </div>
                            <!-- End email input -->

                            <!-- Start gender -->
                            <label>Gender <span class="text-danger">*</span></label>
                            <div class="form-check col-2 mb-3">
                                <label class="form-check-label">
                                    <input type="radio" class="form-check-input" name="gender" id="gender" value="m" <?php
                                                                                                                        // get submitted value if it's valid
                                                                                                                        if (isset($_SESSION['old-values']['gender']) && $_SESSION['old-values']['gender'] == 'm') {
                                                                                                                            echo "checked";
                                                                                                                        } elseif (isset($value['gender']) && $value['gender'] == 'm') {
                                                                                                                            echo "checked";
                                                                                                                        } else {
                                                                                                                            echo "";
                                                                                                                        } ?>>
                                    Male
                                </label>
                                <label class="form-check-label">
                                    <input type="radio" class="form-check-input" name="gender" id="gender" value="f" <?php
                                                                                                                        // get submitted value if it's valid
                                                                                                                        if (isset($_SESSION['old-values']['gender']) && $_SESSION['old-values']['gender'] == 'f') {
                                                                                                                            echo "checked";
                                                                                                                        } elseif (isset($value['gender']) && $value['gender'] == 'f') {
                                                                                                                            echo "checked";
                                                                                                                        } else {
                                                                                                                            echo "";
                                                                                                                        } ?>>
                                    Female
                                </label>
                            </div>
                            <?php
                            // gender validation
                            //required
                            if (isset($_SESSION['validation']['gender-validation']['gender-required'])) {
                                $genderRequired = $_SESSION['validation']['gender-validation']['gender-required'];
                            } ?>
                            <div class="col-12 mb-3">
                                <small class="text-danger"><?php if (isset($genderRequired)) {
                                                                echo $genderRequired;
                                                            } ?></small>
                            </div>
                            <!-- End gender -->
                            <div class="mb-3 form-check">
                                <input type="checkbox" name="check-agree" class="form-check-input" value="true" id="check-agree" <?php
                                                                                                                                    // get submitted value if it's valid
                                                                                                                                    if (isset($_SESSION['old-values']['check-agree']) && $_SESSION['old-values']['check-agree'] == 'true') {
                                                                                                                                        echo "checked";
                                                                                                                                    } elseif (isset($value['mail_status']) && $value['mail_status'] == 'true') {
                                                                                                                                        echo "checked";
                                                                                                                                    } else {
                                                                                                                                        echo "";
                                                                                                                                    } ?>>
                                <label class="form-check-label" for="check-agree">Recieve E-mails from us</label>
                            </div>
                            <button type="submit" name="update-submit-btn" class="btn btn-outline-primary">Update</button>
                    <?php
                        }
                    }
                    ?>
                </form>
                <!-- End registration form -->

            </div>
        </div>
        <!-- End register row -->



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