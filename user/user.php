<?php
session_start();

require_once '../components/db_connect.php';

$userinfo = mysqli_query($connect, "SELECT * FROM users WHERE user_id = {$_SESSION['USER']}");
$info = mysqli_fetch_array($userinfo, MYSQLI_ASSOC);

if ($info['user_block'] == 'blocked') {
    header('Location: ../block.php');
    exit;
}

if (isset($_SESSION['ADMIN'])) {
    header('Location: ..admin/index_admin.php');
    exit;
}

if (!isset($_SESSION['ADMIN']) && !isset($_SESSION['USER'])) {
    header('Location: ../login.php');
    exit;
}

$query = "SELECT * FROM users WHERE user_id={$_SESSION['USER']}";
$result = mysqli_query($connect, $query);
$row = mysqli_fetch_assoc($result);

$id = $row['user_id'];
$username = $row['username'];
$first_name = $row['first_name'];
$last_name = $row['last_name'];
$email = $row['email'];
$photo = $row['photo'];
$status = $row['status'];

mysqli_close($connect);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <?php require_once '../components/boot.php'?>
    <?php require_once '../navbar/nav_user.php'?>
    <?php require_once '../navbar/footer.php'?>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    
    <title>Tasty Food | Your Account</title>
</head>

<body class="bg-light">
    <h1 class="h1" style="color: #7D8F69"> Your Account </h1>
    <div class="container-user">

    <div class="container-upd border rounded-3 p-4 w-50 mt-4 mb-5">
        <div class="row">
            <div class="col-lg-15">
                <div class="card-user mb-4">
                    <div class="card-body-user text-center rounded-3">
                        <img src="../images/<?= $photo ?>" alt="profile pic" class="rounded-circle img-fluid" style="margin-left: 1.8%;">
                        
                        <h5 class="my-4">Your personal info, <?= $username ?>.</h5>
                        <div class="d-flex justify-content-center mb-2">
                            <a class="user_upd_button" href="update.php?id=<?= $_SESSION['USER'] ?>"> Update your account</a>
                           

                    </div>
                </div>
            </div>
        </div>
    <div class="col-lg-20 p-4">
        <div class="card-body rounded-3 p-4">

        <div class="row">
                        <div class="col-sm-9">
                            <p class="mb-0">Username</p>
                        </div>
                        <div class="col-sm-9">
                            <p class="text-muted mb-0"><?= $username ?></p>
                        </div>
                    </div>
                    <hr>
                     <div class="row">
                        <div class="col-sm-9">
                            <p class="mb-0">First name</p>
                        </div>
                        <div class="col-sm-9">
                            <p class="text-muted mb-0"><?= $first_name ?></p>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-9">
                            <p class="mb-0">Last name</p>
                        </div>
                        <div class="col-sm-9">
                            <p class="text-muted mb-0"><?= $last_name ?></p>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-9">
                            <p class="mb-0">Email</p>
                        </div>
                        <div class="col-sm-9">
                            <p class="text-muted mb-0"><?= $email ?></p>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-9">
                            <p class="mb-0">Status</p>
                        </div>
                        <div class="col-sm-9">
                            <p class="text-muted mb-0"><?= $status ?></p>
                        </div>
                        
                    </div>
                    <hr>
                    <div class="d-flex justify-content-center mb-2">
                            <a class="user_back_button" href="../index.php">Back</a>

                    </div>
                   
                    </div>
                  
            </div>
        </div>
    </div>

</div>

<?php require_once "../navbar/bottom_footer_user.php"?>

</body>
</html>