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
    header("Location: ../../admin/index_admin.php");
    exit;
}

if (!isset($_SESSION['ADMIN']) && !isset($_SESSION['USER'])) {
    header("Location: ../login.php");
    exit;
}


require_once '../../components/file_upload.php';

// ubaceno zbog prof pic 

$query = "SELECT * FROM users WHERE user_id={$_SESSION['USER']}";
$result = mysqli_query($connect, $query);
$row = mysqli_fetch_assoc($result);

$id = $row['user_id'];
$username = $row['username'];
$first_name = $row['first_name'];
$last_name = $row['last_name'];
$email = $row['email'];
$photo = $row['photo'];
$status = $row['status'];

// ^

if ($_GET['recipe_id']) {
    $id = $_GET['recipe_id'];
    $sql = "SELECT * FROM recipes WHERE recipe_id = {$id}";
    $result = mysqli_query($connect, $sql);
if (mysqli_num_rows($result) == 1) {
$data = mysqli_fetch_assoc($result);

    $name = $data['name'];
    $ingredients = $data['ingredients'];
    $meal_description = $data['meal_description'];
    $cooking_prep_time = $data['cooking_prep_time'];
    $calories = $data['calories'];
    $food_type = $data['food_type'];
    $picture = $data['picture'];
    $video = $data['video'];

} else {
    header("location: ../../error.php");
}
    mysqli_close($connect);
// } else {
// header("location: ../../error.php");
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
    <?php require_once '../../navbar/nav_user_user_recipes.php'?>
    <?php require_once '../../navbar/footer_user_user_recipes.php'?>
    <title>Tasty Food | Update Your Recipe</title>
</head>
<body class="bg-light">

<br>
<br>
        <h1 class="h1" style="color: #7D8F69">Update your recipe</h1>
<br>
<div class="container-create-rec border rounded-3 p-4 w-50 mt-4 mb-5">


        <legend class="h2"><img style="float:left; margin-left:-130%;" class='img-thumbnail rounded-circle' src='../../images/<?= $picture ?>' alt="<?= $name ?>"></legend>
        <form action="../actions/a_update_recipe.php" method="post" enctype="multipart/form-data">
            <table class="table">
                <tr>
                    <th>Name</th>
                    <td><input class="form-control" type="text" name="name" placeholder="Name" value="<?= $name ?>" /></td>
                </tr>
                <tr>
                    <th>Ingredients</th>
                    <td><input class="form-control" type="text" name="ingredients" placeholder="Ingredients" value="<?= $ingredients ?>"/></td>
                </tr>
                <tr>
                    <th>Method</th>
                    <td><input class="form-control" type="text" name="meal_description" placeholder="Meal Description" value="<?= $meal_description ?>"/></td>
                </tr>
                <tr>
                    <th>Cooking Preparation Time</th>
                    <td><input class="form-control" type="number" name="cooking_prep_time" placeholder="Cooking Preparation Time" value="<?= $cooking_prep_time ?>"/></td>
                </tr>
                <tr>
                    <th>Calories</th>
                    <td><input class="form-control" type="number" name="calories" placeholder="How much calories?" value="<?= $calories ?>"/></td>
                </tr>
                <tr>
                    <th>Food/Meal Type</th>
                    <td>
                        <select class="update-food-type-rec" name="food_type" aria-label="Default select example">
                            <option value="<?= $food_type ?>"><?= $food_type ?></option>
                            <option value='Breakfast'>Breakfast</option>
                            <option value='Lunch'>Lunch</option>
                            <option value='Dinner'>Dinner</option>
                            <option value='Vegan'>Vegan</option>
                            <option value='Vegaterian'>Vegeterian</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <th>Picture</th>
                    <td><input class="update-photo-rec" type="file" name="picture" value="<?= $picture ?>"/></td>
                </tr>
                <tr>
                        <th>Video</th>
                        <td><input class="form-control" type="text" name="video" placeholder="Video URL" value="<?= $video ?>" /></td>
                </tr>
                
            
                
            <tr>
                    <input type="hidden" name="id" value="<?= $data['recipe_id'] ?>"/>
                    <input type="hidden" name="picture" value="<?= $data['picture'] ?>"/>
                    <td><button class="upd-my-rec-save-btn" type="submit"> Save Changes </button></td>
                    <td><a href="../index_user.php"><button class="back-my-rec-myrec-btn" type="button">My Recipes</button></a></td>
                </tr>
            </table>

        </form>
</div>

    <?php require_once "../../navbar/bottom_footer_user_recipes.php"?>
</body>
</html>