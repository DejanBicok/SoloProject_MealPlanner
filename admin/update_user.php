<?php
session_start();

require_once '../components/db_connect.php';
require_once '../components/file_upload_acc_update.php';

if (isset($_SESSION['USER'])) {
    header("Location: ../user/index_user.php");
    exit;
}
if (!isset($_SESSION['USER']) && !isset($_SESSION['ADMIN'])) {
    header("Location: ../login.php");
    exit;
}

if ($_GET['id']) {
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
    $status = $data['status'];
    $user_block = $data['user_block'];

    }
}

//update

$class = 'd-none';
if (isset($_POST["submit"])) {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $status = $_POST['status'];
    $user_block = $_POST['user_block'];
    $id = $_POST['id'];

    $uploadError = '';
    $photoArray = file_upload($_FILES['photo']); //file_upload !
    $photo = $photoArray->fileName;
if ($photoArray->error === 0) {
    ($_POST["photo"] == "avatar.png") ?: unlink("../images/{$_POST["photo"]}");
    $sql = "UPDATE users SET first_name = '$first_name', last_name = '$last_name', email = '$email', status = '$status', user_block = '$user_block' photo = '$photoArray->fileName' WHERE user_id = {$id}";
}else{
    $sql = "UPDATE users SET first_name = '$first_name', last_name = '$last_name', email = '$email', status = '$status', user_block = '$user_block' WHERE user_id = {$id}";
}
if (mysqli_query($connect, $sql) === true) {
    $class = "alert alert-success";
    $message = "User is successfully updated";
    $uploadError = ($photoArray->error != 0) ? $photoArray->ErrorMessage : '';
    header("refresh:3;url=update.php?id={$id}");
}else{
    $class = "alert alert-danger";
    $message = "Error while updating User : <br>" . $connect->error;
    $uploadError = ($photoArray->error != 0) ? $photoArray->ErrorMessage : '';
    header("refresh:3;url=update.php?id={$id}");
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
    <title>Tasty Food | Admin | Update User</title>
</head>
<body class="bg-light">

    <fieldset>
    <legend class="h2"> Update User Profile: <img class='img-thumbnail rounded-circle' src='../images/<?= $photo ?>' alt="<?= $name ?>"></legend>
        <form class="" action="actions/a_update_user.php" method="post" enctype="multipart/form-data">

            <table class="table">
            <tr>
                    <th>Username</th>
                    <td><input class="form-control" type="text" name="username" placeholder="Username" value="<?= $username ?>" /></td>
                </tr>
                <tr>
                    <th>First Name</th>
                    <td><input class="form-control" type="text" name="first_name" placeholder="User First Name" value="<?= $first_name ?>"/></td>
                </tr>
                <tr>
                    <th>Last Name</th>
                    <td><input class="form-control" type="text" name="last_name" placeholder="User Last Name" value="<?= $last_name ?>"/></td>
                </tr>
                <tr>
                    <th>Email</th>
                    <td><input class="form-control" type="text" name="email" placeholder="User Email" value="<?= $email ?>"/></td>
                </tr>
                <tr>
                    <th>Status</th>
                    <td><select class="form-select" name="status" aria-label="Default select example">
                            <option value="<?= $status ?>">Choose a status:</option>

                            <option value='USER'>USER</option>
                            <option value='ADMIN'>ADMIN</option>
                        </select>
                    </td>
                </tr>

                <tr>
                    <th>Blocked?</th>
                    <td><select class="form-select" name="user_block" aria-label="Default select example">
                            <option value="<?= $block ?>">Choose an option:</option>
                        
                            <option value='blocked'>Blocked</option>
                            <option value='unblocked'>Unblocked</option>
                    </select>
                </td>
                </tr>

                <tr>
                    <th>Photo</th>
                    <td><input class="form-control" type="file" name="photo" value="<?= $photo ?>"/></td>
                </tr>

                <input type="hidden" name="id" value="<?= $data['user_id'] ?>"/>

                <tr class="">
                    <td><button class="btn btn-success" type="submit"> Save Changes </button></td>
                    <td><a href="index_admin.php"><button class="btn btn-dark" type="button">Dashboard</button></a></td>
                    <td><a class="btn btn-danger" href="delete_user.php?id=<?= $data['user_id'] ?>">Delete User</a></td>
                </tr>
            </table>
        </form>
    </fieldset>
    
</body>
</html>