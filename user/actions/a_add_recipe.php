<?php
session_start();

require_once '../../components/db_connect.php';

$userinfo = mysqli_query($connect, "SELECT * FROM users WHERE user_id = {$_SESSION['USER']}");
$info = mysqli_fetch_array($userinfo, MYSQLI_ASSOC);

if ($info['user_block'] == 'blocked') {
    header('Location: ../../block.php');
    exit;
}

if (!isset($_SESSION['ADMIN']) && !isset($_SESSION['USER'])) {
    header("Location: ../../index.php");
    exit;
}


require_once '../../components/file_upload.php';


if ($_POST) {
    $user_id = $_SESSION['USER'];
    $recipe_id = $_POST['recipe_id'];
    $day = $_POST['day'];
    $meal_date = $_POST['meal_date'];
    
    $sql= "SELECT * FROM recipes WHERE recipe_id={$recipe_id}";
    $result = mysqli_query($connect, $sql);
    $row = mysqli_fetch_assoc($result);

    if (mysqli_num_rows($result)  > 0) {
            $recipe_id = $row['recipe_id'];
            $name = $row['name'];
            $food_type = $row['food_type'];
            $picture = $row['picture'];
            $ingredients = $row['ingredients'];
            $meal_description = $row['meal_description'];
    

        $sql = "INSERT INTO meal_planner (fk_user_id, fk_recipe_id, recipe_name, food_type, day, picture, ingredients, meal_description) 
                VALUES ('$user_id', '$recipe_id', '$name', '$food_type','$day','$picture','$ingredients','$meal_description')";

        // $sql = "INSERT INTO days (day_of_week) VALUES ('$day')";
    };

    if (mysqli_query($connect, $sql) === true) {
        $class = "";
        echo
        $message = "<h2 style='text-align: center; margin-top: 22%; color: #7D8F69 !important;'>'$name' recipe has been successfuly added to '$day' in your Meal Planner!<br>
            <table class='table w-50'><tr></tr></h2>";
            }
        mysqli_close($connect);

} else {
    header("location: ../../error.php");   }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Tasty Food | Add Meal </title>
    <link rel="stylesheet" href="../../css/style.css">
    <?php require_once '../../components/boot.php' ?>
</head>
<body class="bg-light">
    

<a href="../../planner.php"><button class="planner_back_btn" style="width: 7%; font-size: 20px; margin-top: 2%;" type="button">Done</button></a>
</body>
</html>