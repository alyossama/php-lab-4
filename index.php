<?php
// Start the session to receive the validation errors and old values
session_start();

require_once("./app/Models/User.php");

$usersObject = new User;
$result = $usersObject->read();
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

    <title>Users - Homepage</title>

</head>
<!-- start body -->

<body>
    <div class="container">
        <div class="row my-5">
            <p class="h1 text-center">Users table</p>
        </div>

        <div class="row justify-content-center">
            <div class="col-10">
                <?php
                if (isset($_SESSION['add-success'])) { ?>
                    <div class="row justify-content-center">
                        <div class="col-6">
                            <div class="alert alert-success"><?= $_SESSION['add-success'] ?></div>
                        </div>
                    </div>
                <?php } ?>
                <?php
                if (isset($_SESSION['delete-success'])) { ?>
                    <div class="row justify-content-center">
                        <div class="col-6">
                            <div class="alert alert-success"><?= $_SESSION['delete-success'] ?></div>
                        </div>
                    </div>
                <?php } ?>
                <?php
                if (isset($_SESSION['update-success'])) { ?>
                    <div class="row justify-content-center">
                        <div class="col-6">
                            <div class="alert alert-success"><?= $_SESSION['update-success'] ?></div>
                        </div>
                    </div>
                <?php } ?>
                <div class="my-2"><a href="./add-user.php" class="btn btn-success text-decoration-none text-white">Add new user</a></div>
                <?php
                if ($result) {
                    $users = $result->fetch_all(MYSQLI_ASSOC);
                ?>
                    <table class="table table-info table-inverse table-responsive">
                        <thead class="thead-secondary text-center">
                            <tr>

                                <?php
                                // Looping over only one student to get the array keys
                                foreach ($users[0] as $key => $val) {
                                ?>
                                    <th><?= $key ?></th>
                                <?php }
                                ?>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody class="text-center">
                            <tr>
                                <?php
                                //Looping over the users array to break down arrays
                                foreach ($users as $index => $details) {
                                    //looping over each array simultaneously to get values from it
                                    foreach ($details as $detail => $value) {

                                ?>
                                        <td scope="row" class="text-center"><?= $value ?></td>
                                    <?php
                                    }
                                    ?>
                                    <td scope="row" class="text-center">
                                        
                                        <div class="row justify-content-center">
                                            <div class="col-3">
                                                <form action="./app/Requests/UsersRequest.php"  method="post">
                                                    <input type="hidden" name="id" value="<?= $details['id'] ?>">

                                                    <input type="submit" value="Show" class="btn btn-outline-info" name="show-by-id-form">
                                                </form>
                                            </div>
                                            
                                            <div class="col-3">
                                                <form action="./app/Requests/UsersRequest.php"  method="post">
                                                    <input type="hidden" name="id" value="<?= $details['id'] ?>">

                                                    <input type="submit" value="Edit" class="btn btn-outline-warning" name="update-form">
                                                </form>
                                            </div>

                                            <div class="col-3">
                                                <form action="./app/Requests/UsersRequest.php"  method="post">
                                                    <input type="hidden" name="id" value="<?= $details['id'] ?>">
                                                    
                                                    <input type="submit" value="Delete" class="btn btn-outline-danger" name="delete-form">
                                                </form>
                                            </div>
                                        </div>


                                    </td>
                            </tr>
                        </tbody>
                    <?php
                                }


                    ?>
                    </table>
            </div>
        <?php
                } else {
        ?>
            <div class="col-12 text-center">
                <p class="h1 text-muted">No Items to Show!</p>
            </div><?php
                }
                    ?>

        </div>

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