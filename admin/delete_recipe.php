<?php
session_start();

require_once '../components/db_connect.php';

if (isset ($_SESSION['USER'])) {
    header("Location: ../user/index_user.php");
    exit;
}

if (!isset ($_SESSION['USER']) && !isset($_SESSION['ADMIN'])) {
    header("Location: ../login.php");
    exit;
}

require_once '../components/file_upload.php';


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
    $class = "alert alert-success";
    $message = "Recipe successfully deleted.";
    header("refresh:1;url=index_admin.php");
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
    <title>Tasty Food | Admin | Recipe Delete</title>
</head>

<body class="bg-light">
    <div class="<?= $class; ?>" role="alert">
        <p><?= ($message) ?? ''; ?></p>
    </div>

    <fieldset>

        <legend class='h2 mb-3'>You have selected the recipe: <br><?= "$name" ?> <img class='img-thumbnail rounded-circle' src='../images/<?= $picture ?>' alt="<?= $name ?>">
        </legend>
        <div class="container" style="text-align:center;">
        
        </table>
        <h5 class="mb-4">Delete this recipe?</h5>
    <form method="post">
        <input type="hidden" name="id" value="<?= $id ?>" />
        <button class="btn btn-danger" type="submit">Yes, delete this recipe.</button>
        <a href="index_admin.php"><button class="btn btn-warning" type="button"> No, go back.</button></a>
    </form>
    </fieldset>
</div>
</body>
</html>