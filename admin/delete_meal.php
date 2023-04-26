<?php
session_start();

require_once '../components/db_connect.php';

if (isset ($_SESSION['USER'])) {
    header("Location: user/index_user.php");
    exit;
}

if (!isset ($_SESSION['USER']) && !isset($_SESSION['ADMIN'])) {
    header("Location: login.php");
    exit;
}

require_once '../components/file_upload.php';


$class = 'd-none';
if ($_GET['planner_id']) {
    $planner_id = $_GET['planner_id'];
    $sql = "SELECT * FROM meal_planner WHERE planner_id = {$planner_id}";
    $result = mysqli_query($connect, $sql);
    $data = mysqli_fetch_assoc($result);
if (mysqli_num_rows($result) == 1) {

    $planner_id = $data['planner_id'];

    }
}

if ($_POST) {
    $planner_id = $_POST['id'];
    $sql = "DELETE FROM meal_planner WHERE planner_id = {$planner_id}";
if ($connect->query($sql) === TRUE) {
    $class = "alert alert-success";
    $message = "Recipe from Planner successfully deleted.";
    header("refresh:1;url=planner_admin.php");
}else{
    $class = "alert alert-danger";
    $message = "The recipe was not deleted due to: <br>" . $connect->error;
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
    <title>Tasty Food | Admin | Delete Meal Plan</title>
</head>

<body class="bg-light">
    <div class="<?= $class; ?>" role="alert">
        <p><?= ($message) ?? ''; ?></p>
    </div>

    <fieldset>
        <legend class='h2 mb-3'>Delete request <img class='img-thumbnail rounded-circle' src='../images/<?= $picture ?>' alt="<?= $planner_id ?>">
        </legend>

        <h5> You have selected the recipe below: </h5>
        
        <table class="table w-75 mt-3">
            <tr>
                <td><?= "$planner_id" ?></td>
            </tr>
        </table>
        <h3 class="mb-4">Delete this recipe from your Planner?</h3>
    <form method="post">
        <input type="hidden" name="id" value="<?= $planner_id ?>" />
        <button class="btn btn-danger" type="submit">Yes</button>
        <a href="planner_admin.php"><button class="btn btn-warning" type="button"> No, go back</button></a>
    </form>
    </fieldset>

</body>
</html>