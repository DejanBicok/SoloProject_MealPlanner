<?php
session_start();

require_once '../../components/db_connect.php';
require_once '../../components/file_upload.php';

if (isset($_SESSION['USER'])) {
    header ("Location: ../../user/index_user.php");
    exit;
}

if (!isset($_SESSION['USER']) && !isset($_SESSION['ADMIN'])) {
    header ("Location: ../../login.php");
    exit;
}

if ($_POST) {
    $availability = $_POST['availability'];
    $day = $_POST['day'];
    $meal_date = $_POST['meal_date'];
    $meal_time = $_POST['meal_time'];
    $id = $_POST['id'];
   

{

    
    $sql = "UPDATE meal_planner SET availability = '$availability', day = '$day', meal_date = '$meal_date', meal_time = '$meal_time' WHERE planner_id = {$id}";

}

if (mysqli_query($connect, $sql) === TRUE) {
    $class = "success";
    $message = "The Planner has been successfully updated.";
    
}else{
    $class = "danger";
    $message = "Failed to update the Planner: <br>" . mysqli_connect_error();
  
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
    <title>Tasty Food | Action Planner Update</title>
</head>

<body class="bg-light">
        <div class="container">
            <div class="mt-3 mb-3">
                <h1>Meal Plan "<?= $fk_recipe_name?>" response:</h1>

            </div>
            <div class="alert alert-<?= $class;?>" role="alert">
            <p><?= ($message) ?? ''; ?></p>
            <p><?= ($uploadError) ?? ''; ?></p>
            <a href='../update_planner_admin.php?planner_id=<?= $id; ?>'><button class="btn btn-warning" type="button"> Back </button></a>
            <a href='../planner_admin.php'><button class="btn btn-success" type="button">Meal Planner</button></a>
            </div>
        </div>
</body>
</html>