<?php
session_start();

require_once '../../components/db_connect.php';
require_once '../../components/file_upload.php';

$userinfo = mysqli_query($connect, "SELECT * FROM users WHERE user_id = {$_SESSION['USER']}");
$info = mysqli_fetch_array($userinfo, MYSQLI_ASSOC);

if ($info['user_block'] == 'blocked') {
    header('Location: ../../block.php');
    exit;
}

if (isset($_SESSION['ADMIN'])) {
    header ("Location: ../../admin/index_admin.php");
    exit;
}

if (!isset($_SESSION['USER']) && !isset($_SESSION['ADMIN'])) {
    header ("Location: ../../login.php");
    exit;
}

if ($_POST) {

    $day = $_POST['day'];
    $meal_date = $_POST['meal_date'];
    $meal_time = $_POST['meal_time'];
    $id = $_POST['id'];

{

    
    $sql = "UPDATE meal_planner SET day = '$day', meal_date = '$meal_date', meal_time = '$meal_time' WHERE planner_id = {$id}";

}

if (mysqli_query($connect, $sql) === TRUE) {
    $class = "";
    $message = "<h1 style='text-align: center; margin-top: 39.5%;'>Your plan has been successfully updated</h1>";
    
}else{
    $class = "";
    $message = "<h1>Failed to update your plan:</h1><br>" . mysqli_connect_error();
  
}

mysqli_close($connect);

}else{
    header("Location: ../..error.php");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/style.css">
    <?php require_once '../../components/boot.php'?>
    <title>Tasty Food | Update Meal Plan</title>
</head>
<body class="bg-light">
        <div class="container">
            <div class="mt-3 mb-3">
            </div>
            <div class="alert alert-<?= $class;?>" role="alert">
            <p><?= ($message) ?? ''; ?></p>
            <p><?= ($uploadError) ?? ''; ?></p>
            <a href='../../planner.php'><button class="btn-create-recipe" type="button">Done</button></a>
            </div>
        </div>
</body>
</html>