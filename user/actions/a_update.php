<?php

require_once '../../components/db_connect.php';
require_once '../../components/file_upload_acc_update.php';

// $userinfo = mysqli_query($connect, "SELECT * FROM users WHERE user_id = {$_SESSION['USER']}");
// $info = mysqli_fetch_array($userinfo, MYSQLI_ASSOC);

// if ($info['user_block'] == 'blocked') {
//     header('Location: ../../block.php');
//     exit;
// }

if ($_POST) {
    $username = $_POST['username'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $id = $_POST['id'];

    $uploadError = '';
    $photoArray = file_upload($_FILES['photo']);

if ($photoArray->error === 0) {
    ($_POST["photo"] == "avatar.png") ?: unlink("../../images/$_POST[photo]");
    $sql = "UPDATE users SET username = '$username', first_name = '$first_name', last_name = '$last_name', email = '$email', photo = '$photoArray->fileName' WHERE user_id = {$id}";
}else{
    $sql = "UPDATE users SET username = '$username', first_name = '$first_name', last_name =  '$last_name', email = '$email' WHERE user_id = {$id}";
}
if (mysqli_query($connect, $sql)) {
    $class = "";
    $message = "<h1 style='text-align: center; margin-top: 39.5%;'>Your account has been updated successfully</h3>";

}else{

    $class = "";
    $message = "<h1>Error while updating your account : </h1><br>" . mysqli_connect_error();
    $uploadError = ($photoArray->error != 0) ? $photoArray->ErrorMessage : '';
    }

}
$backBtn = '';
mysqli_close($connect);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/style.css">
    <?php require_once '../../components/boot.php'?>
    <title>Tasty Food | Update User Account</title>
</head>
<body class="bg-light">
    <div class="container">
        <div class="mt-3 mb-3">
        </div>
        <div class="alert alert-<?= $class; ?>" role="alert">

            <p><?= ($message) ?? ''; ?></p>
            <p><?= ($uploadError) ?? ''; ?></p>
            <a href='../update.php?id=<?= $id ?>'><button class="btn-create-recipe" type='button'>Done</button></a>

        </div>
    </div>
</body>
</html>


