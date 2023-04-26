<?php
session_start();

require_once '../../components/db_connect.php';

$userinfo = mysqli_query($connect, "SELECT * FROM users WHERE user_id = {$_SESSION['USER']}");
$info = mysqli_fetch_array($userinfo, MYSQLI_ASSOC);

if ($info['user_block'] == 'blocked') {
    header('Location: ../../block.php');
    exit;
}

if (isset($_SESSION['ADMIN'])) {
    header("Location: ../../user/index_admin.php");
    exit;
}

if (!isset($_SESSION['USER']) && !isset($_SESSION['ADMIN'])) {
    header("Location: ../../login.php");
    exit;
}

require_once '../../components/file_upload_recipe.php';


$query2 = "SELECT * FROM users WHERE user_id = {$_SESSION['USER']}";
$result2 = mysqli_query($connect, $query2);
$row2 = mysqli_fetch_assoc($result2);

$id = $row2['user_id'];
$username = $row2['username'];

$sqlreview2= "SELECT * FROM recipes WHERE recipe_id";
$resultreview2 = mysqli_query($connect, $sqlreview2);
$row3 = mysqli_fetch_assoc($resultreview2);

$recipe_id = $row3['recipe_id'];
$name = $row3['name'];

if ($_POST) {
    $user_id = $_SESSION['USER'];

    $sql = "INSERT INTO recipes (fk_user_id, fk_recipe_id) 
            VALUES ('$user_id', '$recipe_id')";                        /* ovaj deo je nov i row3 */

if ($_POST) {
    $name = $_POST['name'];
    $ingredients = $_POST['ingredients'];
    $meal_description = $_POST['meal_description'];
    $cooking_prep_time = $_POST['cooking_prep_time'];
    $calories = $_POST['calories'];
    $food_type = $_POST['food_type'];
    $video = $_POST['video'];

    $id = $row2['user_id'];


    
    $uploadError = '';
    $picture = file_upload($_FILES['picture'], 'recipes');

$sql = "INSERT INTO recipes (name, ingredients, meal_description, cooking_prep_time, calories, food_type, picture, video, fk_user_id, fk_recipe_id)     /* ubacen fk user id za posebnog usera koji pravi recept sa $id dole */
        VALUES ('$name', '$ingredients', '$meal_description', '$cooking_prep_time', '$calories', '$food_type', '$picture->fileName', '$video', '$id', '$recipe_id')"; 

if (mysqli_query($connect, $sql) === true) {
    $message = "<h1 style='text-align: center; margin-top: 35%;'>Recipe has been successfully created</h1> <br>
        <table class='table w-50'><tr>
        <h2 class='h2' style='text-align: center;'> $name </h2>
        
        </tr></table><hr>";
}else{
   
    $message = "<h1 style='text-align: center; margin-top: 35%;'>Failed to create a recipe. Try again:</h1> <br>";
    
    }

    mysqli_close($connect);
    
}else{
    header("location: ../../error.php");

}


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
    <title>Tasty Food | Create Recipe</title>
</head>
<body class="bg-light">
    <div class="container">
        <div class="mt-3 mb-3">
        </div>
    <div class="alert alert-<?= $class; ?>" role="alert">
        <p><?= ($message) ?? ''; ?></p>
        <p><?= ($uploadError) ?? ''; ?></p>
        <a href='../index_user.php'><button class="btn-create-recipe" type='button'>Done</button></a>
        </div> 
    </div>
</body>
</html>