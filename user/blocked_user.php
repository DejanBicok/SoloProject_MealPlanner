<?php
// session_start();

// $userinfo = mysqli_query($connect, "SELECT * FROM users WHERE user_id={$_SESSION['USER']}");
// $info = mysqli_fetch_array($userinfo, MYSQLI_ASSOC);

// if($info['user_block']=='blocked'){
//     header('Location: ../block.php');
//     exit;
// }
// if (isset($_SESSION['ADMIN'])) {
//     header('Location: ../admin/index_admin.php');
//     exit;
// }
// if (!isset($_SESSION['ADMIN']) && !isset($_SESSION['USER'])) {
//     header('Location: ../login.php');
//     exit;
// }


// require_once '../components/db_connect.php';


// $query = "SELECT * FROM users WHERE user_id = {$_SESSION['USER']}";
// $result = mysqli_query($connect, $query);
// $row = mysqli_fetch_assoc($result);

// $id = $row['user_id'];
// $username = $row['username'];
// $first_name = $row['first_name'];
// $last_name = $row['last_name'];
// $email = $row['email'];
// $photo = $row['photo'];
// $status = $row['status'];
// $user_block = $row['user_block'];


// mysqli_close($connect);


// ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">  
    <?php require_once '../components/boot.php'?>
    <title>Tasty Food | Blocked <?= $username ?></title>
</head>
<body class="bg-light">
    <div class="container py-4 h100">
        <div class="row">
            <div class="col-lg-4">
                <div class="card-user mb-4">
                    <div class="card-body-user text-center rounded-3">
            <img src="../images/<? $photo ?>" alt="profile pic" class="rounded-circle img-fluid"> <!-- stil -->
        <h5 class="my-4"> Hello, <?=$username ?>!</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>