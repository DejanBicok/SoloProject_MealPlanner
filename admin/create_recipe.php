<?php
session_start();

require_once '../components/db_connect.php';

if (isset($_SESSION['USER'])) {
    header("Location: ../user/index_user.php");
    exit;
}

if (!isset($_SESSION['USER']) && !isset($_SESSION['ADMIN'])) {
    header("Location: ../login.php");
    exit;
}

require_once '../components/file_upload_recipe.php';


$sql = "SELECT * FROM recipes ";
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
    <link rel="stylesheet" href="../css/style.css">
    <?php require_once '../components/boot.php'?>
    <?php require_once '../navbar/nav_admin_second.php'?>
    <?php require_once '../navbar/adm_footer.php'?>
    <title>Tasty Food | Create New Recipe</title>
</head>

<body class="bg-light">


        <h1 class="h1" style="color: #7D8F69"> Create New Recipe </h1>
<div class="container-create-rec border rounded-3 p-4 w-50 mt-4 mb-5" style="margin-bottom: -5% !important;">
            <form action="actions/a_create.php" method="post" enctype="multipart/form-data">
                <table class='table'>
                    <tr>
                        <th>Name</th>
                        <td><input class="form-control" type="text" name="name" placeholder="Recipe Name" /></td>
                    </tr>
                    <tr>
                        <th>Ingredients</th>
                        <td><textarea rows="5" cols="35" class="form-control" type="text" name="ingredients" placeholder="Ingredients" ></textarea></td>
                    </tr>
                    <tr>
                        <th>Method</th>
                        <td><textarea rows="5" cols="35" class="form-control" type="text" name="meal_description" placeholder="Meal Description" ></textarea></td>
                    </tr>
                    <tr>
                        <th>Cooking Preparation Time</th>
                        <td><input class="form-control" type="number" name="cooking_prep_time" placeholder="Cooking Preparation Time" step="any" /></td> 
                    </tr>
                    <tr>
                        <th>Calories</th>
                        <td><input class="form-control" type="number" name="calories" placeholder="How much calories?" step="any" /></td> 
                    </tr>
                    <tr>
                        <th>Food/Meal Type</th>
                        <td>
                            <select class="create-food-type-rec" name="food_type" aria-label="Default select example">
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
                        <td><input class="form-control" type="text" name="video" placeholder="Video URL" /></td>
                    </tr>
<!-- da li treba vegan i vegeterijanski dodati, nova tabela ili samo ovde???? -->
                    
                    <tr>
                        <td><button class="create_save_btn_cr" type="submit"> Create New Recipe </button></td>
                        <td><a href="index_admin.php"><button class='create_back_btn_cr' type="button"> Back </button></a></td>
                    </tr>

                    
                </table>
            </form>
</div>
        <?php require_once "../navbar/bottom_footer_admin.php"?>

</body>
</html>