<?php
session_start();

require_once '../../components/db_connect.php';

$userinfo = mysqli_query($connect, "SELECT * FROM users WHERE user_id = {$_SESSION['USER']}");
$info = mysqli_fetch_array($userinfo, MYSQLI_ASSOC);

if ($info['user_block'] == 'blocked') {
    header('Location: ../../block.php');
    exit;
}

if (isset ($_SESSION['ADMIN'])) {
    header("Location: ../../admin/index_admin.php");
    exit;
}

if (!isset ($_SESSION['USER']) && !isset($_SESSION['ADMIN'])) {
    header("Location: ../../login.php");
    exit;
}

require_once '../../components/file_upload.php';


$class = 'd-none';
if ($_GET['recipe_id']) {
    $id = $_GET['recipe_id'];
    $sql = "SELECT * FROM recipes WHERE recipe_id = {$id}";
    $result = mysqli_query($connect, $sql);
    $data = mysqli_fetch_assoc($result);
if (mysqli_num_rows($result) == 1) {
    $name = $data['name'];
    $picture = $data['picture'];
    }
}

if ($_POST) {
    $id = $_POST['id'];
    $sql = "DELETE FROM recipes WHERE recipe_id = {$id}";
if ($connect->query($sql) === TRUE) {
    $class = "h1";
    $message = "Your recipe has been successfully deleted.";
    header("refresh:2;url=../index_user.php");
}else{
    $class = "h1";
    $message = "Your recipe was not deleted due to: <br>" . $connect->error;
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
    <link rel="stylesheet" href="../../css/style.css">
    <?php require_once '../../components/boot.php'?>
    <title>Tasty Food | Recipe Delete</title>
</head>
<body class="bg-light">
    <div class="<?= $class; ?>" role="alert">
        <p><?= ($message) ?? ''; ?></p>
    </div>

    <fieldset>

        <legend class='h2' style='margin-left: 35.1%; margin-top: 15%;'>Delete this recipe? <br><br><?= "$name" ?><br> <img class='img-thumbnail rounded-circle' src='../../images/<?= $picture ?>' alt="<?= $name ?>">
        </legend>
        <div class="container" style="text-align:center;">
        
        </table>
    <form method="post">
        <input type="hidden" name="id" value="<?= $id ?>" />
        <button class="planner_del_btn" type="submit">Yes</button>
        <a href="../index_user.php"><button class="planner_back_btn" type="button"> No, go back</button></a>
    </form>
    </fieldset>
</div>
</body>
</html>