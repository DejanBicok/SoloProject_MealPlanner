<?php
session_start();

require_once 'components/db_connect.php';

$userinfo = mysqli_query($connect, "SELECT * FROM users WHERE user_id = {$_SESSION['USER']}");
$info = mysqli_fetch_array($userinfo, MYSQLI_ASSOC);

if ($info['user_block'] == 'blocked') {
    header('Location: block.php');
    exit;
}

if (isset ($_SESSION['ADMIN'])) {
    header("Location: admin/index_admin.php");
    exit;
}

if (!isset ($_SESSION['USER']) && !isset($_SESSION['ADMIN'])) {
    header("Location: login.php");
    exit;
}

require_once 'components/file_upload.php';



$class = 'd-none';
if ($_GET['planner_id']) {
    $planner_id = $_GET['planner_id'];
    $sql = "SELECT * FROM meal_planner WHERE planner_id = {$planner_id}";
    $result = mysqli_query($connect, $sql);
    $data = mysqli_fetch_assoc($result);
    
if (mysqli_num_rows($result) == 1) {

    $planner_id = $data['planner_id'];
    $fk_recipe_name = $data['recipe_name'];
    $picture = $data['picture'];                      /* da izvuce picture iz baze i prikaze na delete */


    }
}

if ($_POST) {
    $planner_id = $_POST['id'];
    $sql = "DELETE FROM meal_planner WHERE planner_id = {$planner_id}";
if ($connect->query($sql) === TRUE) {
    $class = "h1";
    $message = "Your meal plan has been successfully deleted.";
    header("refresh:1;url=planner.php");
}else{
    $class = "h1";
    $message = "Your meal plan was not deleted due to: <br>" . $connect->error;
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
    <link rel="stylesheet" href="css/style.css">
    <?php require_once 'components/boot.php'?>
    <title>Tasty Food | Delete Meal Plan</title>
</head>
<body class="bg-light">
    <div class="<?= $class; ?>" role="alert">
        <p><?= ($message) ?? ''; ?></p>
    </div>

    <fieldset>
        <legend class='h2 mb-3' style="margin-top: 16.2%;">You have selected the recipe:<br><?= "$fk_recipe_name" ?> <img class='img-thumbnail rounded-circle' src='images/<?= $picture ?>' alt="<?= $fk_recipe_name ?>">
        </legend>
        <div class="container" style="text-align:center;">

        
        <h5 class="mb-4">Delete this recipe from your Planner?</h5>
    <form method="post">
        <input type="hidden" name="id" value="<?= $planner_id ?>" />
        <button class="planner_del_btn" type="submit">Yes</button>
        <a href="planner.php"><button class="planner_back_btn" type="button"> No, go back</button></a>
    </form>
    </fieldset>

</body>
</html>