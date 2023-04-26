<?php
session_start();

require_once '../components/db_connect.php';

if (isset($_SESSION['USER'])) {
    header("Location: ../user/index_user.php");
    exit;
}

// if session is not set this will redirect to login page

if (!isset($_SESSION['ADMIN']) && !isset($_SESSION['USER'])) {
    header("Location:  ../login.php");
    exit;
}

require_once '../components/file_upload.php';


//initial bootstrap class for the confirmation message
$class = 'd-none';
//the GET method will show the info from the user to be deleted
if ($_GET['id']) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM users WHERE user_id = {$id}";
    $result = mysqli_query($connect, $sql);
    $data = mysqli_fetch_assoc($result);
if (mysqli_num_rows($result) == 1) {
    $username = $data['username'];
    $first_name = $data['first_name'];
    $last_name = $data['last_name'];
    $email = $data['email'];
    $photo = $data['photo'];
    
    }
}
//the POST method will delete the user permanently

if ($_POST) {
    $id = $_POST['id'];
    $photo = $_POST['photo'];
    ($photo == "avatar.png") ?: unlink("../images/$photo");

    $sql = "DELETE FROM users WHERE user_id = {$id}";

if ($connect->query($sql) === TRUE) {
    $class = "alert-alert-success";
    $message = "User successfully deleted.";
    header("refresh:1;url=index_admin.php");
}else{
    $class = "alert alert-danger";
    $message = "The entry was not deleted due to: <br>" . $connect->error;
    }
}

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
    <title>Tasty Food | Delete User</title>
</head>
<body class="bg-light">
    <div class="<?= $class; ?>" role="alert">
        <p><?= ($message) ?? ''; ?></p>
    </div>

<fieldset>
        <legend class='h2 mb-3'> Delete user: <?= "$first_name $last_name" ?><br> <img class='img-thumbnail rounded-circle' src='../images/<?= $photo ?>' alt="<?= $username ?>"></legend>
        <div class="container" style="text-align:center;">
    <h3 class="mb-4"> Delete this user? </h3>
<form method="post">
    <input type="hidden" name="id" value="<?= $id ?>" />
    <input type="hidden" name="photo" value="<?= $photo ?>" />
    <button class="btn btn-danger" type="submit">Yes, delete this user.</button>
    <a href="index_admin.php"><button class="btn btn-warning" type="button">No, go back.</button></a>
</form>

</fieldset>
</div>
</body>
</html>    