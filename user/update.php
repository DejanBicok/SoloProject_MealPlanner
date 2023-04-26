<?php
session_start();

require_once '../components/db_connect.php';
require_once '../components/file_upload_acc_update.php';


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

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM users WHERE user_id = {$id}";
    $result = mysqli_query($connect, $sql);
if (mysqli_num_rows($result) == 1) {
    $data = mysqli_fetch_assoc($result);
    $username = $data['username'];
    $first_name = $data['first_name'];
    $last_name = $data['last_name'];
    $email = $data['email'];
    $photo = $data['photo'];
    
} else {
    header('Location: ../error.php');
}

}else{
    header('Location: ../error.php');
}


$class = 'd-none';
if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $photo = $_POST['photo'];
    $id = $_POST['user_id'];
    
    $uploadError = '';
    $photoArray = file_upload($_FILES['photo']);
    $photo = $photoArray->fileName;
if ($photoArray->error === 0) {
    ($_POST["photo"] == "avatar.png") ?: unlink("../images/{$_POST["photo"]}");

$sql = "UPDATE users SET username = '$username', first_name = '$first_name', last_name = '$last_name', email = '$email', photo = '$photoArray->fileName' WHERE user_id = {$id}";

}else{

$sql = "UPDATE users SET username = '$username', first_name = '$first_name', last_name = '$last_name', email = '$email' WHERE user_id = {$id}";

    }

if (mysqli_query($connect, $sql) === true) {
    $class = "alert alert-success";
    $message = "Successfully updated";
    $uploadError = ($photoArray->error != 0) ? $photoArray->ErrorMessage : '';
    header("refresh:3;url=update.php?id={$id}");
}else{
    $class = "alert alert-danger";
    $message = "Error while updating user : <br>" . $connect->error;
    $uploadError = ($photoArray->error != 0) ? $photoArray->ErrorMessage : '';
    header("refresh:3;url=update.php?id={$id}");
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
    <link rel="stylesheet" href="../css/style.css">
    <?php require_once '../components/boot.php'?>
    <?php require_once '../navbar/nav_user.php'?>
    <?php require_once '../navbar/footer.php'?>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    
    <title>Tasty Food | Account Update</title>
</head>

<body class="bg-light">
<h1 class="h1" style="color: #7D8F69"> Update your account </h1>
<div class="container-user">


    <div class="container-upd-acc border rounded-3 p-4 w-50 mt-4 mb-5">
        <img class='rounded-circle img-fluid' style="margin-left: 40%;" src='../images/<?= $data['photo'] ?>' alt="<?= $username ?>">
        <form class="cont1-upd"method="post" enctype="multipart/form-data" action="actions/a_update.php">
            <table class="table">
                <tr>
                    <th>Username</th>
                    <td><input class="upd-username" type="text" name="username" placeholder="Your Username" value="<?= $username ?>" /></td>
                </tr>
                <tr>
                    <th>First Name</th>
                    <td><input class="upd-fname" type="text" name="first_name" placeholder="Your First Name" value="<?= $first_name ?>" /></td>
                </tr>
                <tr>
                    <th>Last Name</th>
                    <td><input class="upd-lname" type="text" name="last_name" placeholder="Your Last Name" value="<?= $last_name ?>" /></td>
                </tr>
                <tr>
                    <th>Email</th>
                    <td><input class="upd-email" type="text" name="email" placeholder="Your Email" value="<?= $email ?>" /></td>
                </tr>
                <tr>
                    <th>Photo</th>
                    <td><input class="upd-photo" type="file" name="photo" /></td>
                </tr>

          
                <input type="hidden" name="id" value="<?= $data['user_id'] ?>" />
                <input type="hidden" name="photo" value="<?= $photo ?>" />
                
         
            </table>
            <button name="submit" class="upd_save_button" type="submit" style="width: 21.5%;">Save Changes</button>
    <a href="user.php<?php $backBtn ?>"><button class="upd_back_button" type="button">Back</button></a>

        </form>
        
    </div>
    </div>

    <?php require_once "../navbar/bottom_footer_user.php"?>

</body>
</html>
