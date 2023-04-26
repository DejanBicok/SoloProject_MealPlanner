<?php
session_start();

require_once '../components/db_connect.php';

if (isset($_SESSION['USER'])) {
    header("Location: ../user/index_user.php");
    exit;
}

if (!isset($_SESSION['ADMIN']) && !isset($_SESSION['USER'])) {
    header("Location: ../login.php");
    exit;
}


require_once '../components/file_upload.php';

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
    header("location: ../error.php");
}
    mysqli_close($connect);
// } else {
// header("location: ../error.php");
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
    <title>Tasty Food | Admin | Update Recipe</title>
</head>
<body class="bg-light">
    <fieldset>
        <legend class="h2">(Admin) Update Recipe: <img class='img-thumbnail rounded-circle' src='../images/<?= $picture ?>' alt="<?= $name ?>"></legend>
        <form class="" action="actions/a_update_recipe.php" method="post" enctype="multipart/form-data">
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
                        <select class="form-select" name="food_type" aria-label="Default select example">
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
                    <td><input class="form-control" type="file" name="picture" value="<?= $picture ?>"/></td>
                </tr>
                <tr>
                        <th>Video</th>
                        <td><input class="form-control" type="text" name="video" placeholder="Video URL" value="<?= $video ?>" /></td>
                </tr>
                <tr class="">
                    <input type="hidden" name="id" value="<?= $data['recipe_id'] ?>"/>
                    <input type="hidden" name="picture" value="<?= $data['picture'] ?>"/>
                    <td><button class="btn btn-success" type="submit"> Save Changes </button></td>
                    <td><a href="index_admin.php"><button class="btn btn-dark" type="button">Dashboard</button></a></td>
                    <td><a class="btn btn-danger" href="delete_recipe.php?id=<?= $data['recipe_id'] ?>">Delete</a></td>
                </tr>
                
            </table>
        </form>
    </fieldset>
</body>
</html>