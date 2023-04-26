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

if (!isset($_SESSION['USER']) && !isset($_SESSION['ADMIN'])) {
    header("Location: ../../login.php");
    exit;
}

require_once '../../components/file_upload_recipe.php';

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

$sql = "SELECT * FROM recipes";
$recipes = "";
$result = mysqli_query($connect, $sql);

while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
    $recipes .=
        "<option value='{$row['recipe_id']}'>{$row['name']}</option>";
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <title>Tasty Food | Create New Recipe</title>
</head>
<body class="bg-light">


        <h1 class="h1" style="color: #7D8F69"> Create New Recipe </h1>
<div class="container-create-rec border rounded-3 p-4 w-50 mt-4 mb-5">

            <form action="../actions/a_create_recipe.php" method="post" enctype="multipart/form-data">
                <table class='table'>
                    <tr>
                        <th>Name</th>
                        <td><input class="upd-username" type="text" name="name" placeholder="Recipe Name" /></td>
                    </tr>
                    <tr>
                        <th>Ingredients</th>
                        <td><textarea rows="5" cols="35" class="upd-username" type="text" name="ingredients" placeholder="Ingredients" ></textarea></td>
                    </tr>
                    <tr>
                        <th>Method</th>
                        <td><textarea rows="5" cols="35" class="upd-username" type="text" name="meal_description" placeholder="Meal Description" ></textarea></td>
                    </tr>
                    <tr>
                        <th>Cooking Preparation Time</th>
                        <td><input class="upd-username" type="number" name="cooking_prep_time" placeholder="Cooking Preparation Time" step="any" /></td> 
                    </tr>
                    <tr>
                        <th>Calories</th>
                        <td><input class="upd-username" type="number" name="calories" placeholder="How much calories?" step="any" /></td> 
                    </tr>
                    <tr>
                        <th>Food/Meal Type</th>
                        <td>
                            <select class="upd-username" name="food_type" aria-label="Default select example">
                                <option selected value='Breakfast'>Breakfast</option>
                                <option selected value='Lunch'>Lunch</option>
                                <option selected value='Dinner'>Dinner</option>
                                <option selected value='Vegan'>Vegan</option>
                                <option selected value='Vegeterian'>Vegeterian</option>
                            </select>
                        </td>
                    </tr>

                    <tr>
                        <th>Picture</th>
                        <td><input class="create-photo" type="file" name="picture" /></td> 
                    </tr>
                    <tr>
                        <th>Video</th>
                        <td><input class="upd-username" type="text" name="video" placeholder="Video URL" /></td>
                    </tr>
                    
<!-- da li treba vegan i vegeterijanski dodati, nova tabela ili samo ovde???? -->
                    
                    <tr>
                        <td><button class="create_save_btn_cr" type="submit"> Create New Recipe </button></td>
                        <td><a href="../index_user.php"><button class='create_back_btn_cr' type="button" style="width: 21%;"> Back </button></a></td>
                    </tr>

                    
                </table>
            </form>
</div>
        <?php require_once "../../navbar/bottom_footer_user_recipes.php"?>

</body>
</html>