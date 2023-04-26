<?php
session_start();

require_once '../../components/db_connect.php';

if (isset($_SESSION['USER'])) {
    header("Location: ../../user/index_user.php");
    exit;
}

if (!isset($_SESSION['USER']) && !isset($_SESSION['ADMIN'])) {
    header("Location: ../../login.php");
    exit;
}

require_once '../../components/file_upload_recipe.php';

// <td> $picture = ['picture']</td>                <-------------------- dodati ispod $name


if ($_POST) {
    $name = $_POST['name'];
    $ingredients = $_POST['ingredients'];
    $meal_description = $_POST['meal_description'];
    $cooking_prep_time = $_POST['cooking_prep_time'];
    $calories = $_POST['calories'];
    $food_type = $_POST['food_type'];
    $video = $_POST['video'];
    
    $uploadError = '';
    $picture = file_upload($_FILES['picture'], 'recipes');

$sql = "INSERT INTO recipes (name, ingredients, meal_description, cooking_prep_time, calories, food_type, video, picture)
        VALUES ('$name', '$ingredients', '$meal_description', '$cooking_prep_time', '$calories', '$food_type', '$video', '$picture->fileName')";

if (mysqli_query($connect, $sql) === true) {
    $class = "success";
    $message = "The recipe has been successfully created <br>
        <table class='table w-50'><tr>
        <td> $name = ['name']</td>
        
        </tr></table><hr>";
    $uploadError = ($picture->error != 0) ? $picture->ErrorMessage : '';
}else{
    $class = "danger";
    $message = "Failed to create a recipe. Try again: <br>" . $connect->error;
    $uploadError = ($picture->error != 0) ? $picture->ErrorMessage : '';
    }
    
    mysqli_close($connect);
}else{
    header("location: ../../error.php");
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
    <title>Tasty Food | Action Create</title>
</head>

<body class="bg-light">
    <div class="container">
        <div class="mt-3 mb-3">
            <h1>Create Recipe</h1>
        </div>
    <div class="alert alert-<?= $class; ?>" role="alert">
        <p><?= ($message) ?? ''; ?></p>
        <p><?= ($uploadError) ?? ''; ?></p>
        <a href='../index_admin.php'><button class="btn btn-primary" type='button'>Home</button></a>
        </div> 
    </div>
</body>
</html>