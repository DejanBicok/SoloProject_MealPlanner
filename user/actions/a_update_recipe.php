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
    $name = $_POST['name'];
    $ingredients = $_POST['ingredients'];
    $meal_description = $_POST['meal_description'];
    $cooking_prep_time = $_POST['cooking_prep_time'];
    $calories = $_POST['calories'];
    $food_type = $_POST['food_type'];
    $id = $_POST['id'];
    $video = $_POST['video'];

    $uploadError = '';

    $picture = file_upload($_FILES['picture'], 'noimage');

if ($picture->error === 0) {
    ($_POST['picture'] = "noimage.jpg") ?: unlink("../../images/$_POST[picture]");
    $sql = "UPDATE recipes SET name = '$name', picture = '$picture->fileName' WHERE recipe_id = {$id}";
}else{
    $sql = "UPDATE recipes SET name = '$name', ingredients = '$ingredients', meal_description = '$meal_description', 
    cooking_prep_time = '$cooking_prep_time', calories = '$calories', food_type = '$food_type', video = '$video' WHERE recipe_id = {$id}";
}

if (mysqli_query($connect, $sql) === TRUE) {
    $class = "";
    $message = "<h1 style='text-align: center; margin-top: 39.5%;'>The recipe has been successfully updated</h1>";
}else{
    $class = "";
    $message = "<h1>Failed to update a recipe:</h1> <br>" . mysqli_connect_error();
    $uploadError = ($picture->error != 0) ? $picture->ErrorMessage : '';
}

mysqli_close($connect);

}else{
    header("Location: ../../error.php");
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
    <title>Tasty Food | Update Recipe</title>
</head>
<body class="bg-light">
        <div class="container">
            <div class="mt-3 mb-3">
            </div>
            <div class="alert alert-<?= $class;?>" role="alert">
            <p><?= ($message) ?? ''; ?></p>
            <p><?= ($uploadError) ?? ''; ?></p>
            <a href='../index_user.php'><button class="btn-create-recipe" type="button">Done</button></a>
            </div>
        </div>
</body>
</html>