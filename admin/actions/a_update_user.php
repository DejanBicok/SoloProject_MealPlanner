<?php
session_start();

require_once '../../components/db_connect.php';

if (isset($_SESSION['USER'])) {
    header("Location: ../user/index_user.php");
    exit;
}

if (!isset($_SESSION['USER']) && !isset($_SESSION['ADMIN'])) {
    header("Location: ../../login.php");
    exit;
}
require_once '../../components/file_upload_acc_update.php';


if ($_POST) {
    $username = $_POST['username'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $status = $_POST['status'];
    $user_block = $_POST['user_block'];
    $id = $_POST['id'];

    $photo = file_upload($_FILES['photo']);

if ($photo->error === 0) {
    ($_POST["photo"] = "avatar.png") ?: unlink("../../images/$_POST[photo]");
    $sql = "UPDATE users SET username = '$username', first_name = '$first_name', last_name = '$last_name', photo = '$photo->fileName' WHERE user_id = {$id}";
} else {
    $sql = "UPDATE users SET username = '$username', first_name = '$first_name', last_name = '$last_name', status = '$status', user_block = '$user_block' WHERE user_id = {$id}";
}
if (mysqli_query($connect, $sql) === TRUE) {
    $class = "success";
    $message = "User info is successfully updated.";
    $uploadError = ($photo->error != 0) ? $photo->ErrorMessage : '';
} else {
    $class = "danger";
    $message = "Error updating User info : <br>" . mysqli_connect_error();
    $uploadError = ($photo->error != 0) ? $photo->ErrorMessage : '';
}
mysqli_close($connect);

} else {
    header("Location: ../../error.php");

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <?php require_once '../../components/boot.php'?>
    <title>Tasty Food | Update User</title>
</head>

<body class="bg-light">
    <div class="container">
        <div class="mt-3 mb-3">
            <h1> User "<?= $username?>" response:</h1>
        </div>
        <div class="alert alert-<?= $class;?>" role="alert">
        <p><?= ($message) ?? ''; ?></p>
        <a href='../update_user.php?id=<?=$id;?>'><button class="btn btn-warning" type='button'>Back</button></a>
        <a href='../index_admin.php'><button class="btn btn-success" type='button'>Admin Dashboard</button></a>
        </div>
    </div>
    
</body>
</html>