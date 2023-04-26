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
if (isset($_SESSION['ADMIN'])) {
    header("location: ../../admin/index_admin.php");
    exit;
}

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

        $recipes = mysqli_fetch_assoc($result);
        
        $name = $recipes['name'];
        $ingredients = $recipes['ingredients'];
        $meal_description = $recipes['meal_description'];
        $cooking_prep_time = $recipes['cooking_prep_time'];
        $calories = $recipes['calories'];
        $food_type = $recipes['food_type'];
        $picture = $recipes['picture'];


    } else {
        header("location: ../../error.php");
    }
    mysqli_close($connect);
    

}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Tasty Food | Add Meal </title>
    <link rel="stylesheet" href="../../css/style.css">
    <?php require_once '../../components/boot.php'?>
    <?php require_once '../../navbar/nav_user_user_recipes.php'?>
    <?php require_once '../../navbar/footer_user_user_recipes.php'?>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</head>
<body class="bg-light">
   
    <fieldset>
    <h1 class="h1" style="color: #7D8F69"> Add recipe to your Meal Planner? </h1>
        <div class="container-create-rec border rounded-3 p-4 w-50 mt-4 mb-5" style="margin-left: 36.5%; width: 27% !important; margin-bottom: 1.5% !important;">

        <legend class='h2 mb-3' style="margin-left: 34%;"> <img class='img-thumbnail rounded-circle' src='../../images/<?php echo $picture ?>' alt="<?php echo "{$name}" ?>"></legend>
        
        <form action="../actions/a_add_recipe.php" method="post" enctype="multipart/form-data">
        <div class="col-lg-20 p-4">
        <div class="card-body rounded-3 p-4">

        <div class="row">
            <tr>
                <input type="hidden" name="recipe_id" value="<?= $recipes['recipe_id'] ?>" />
            </tr>
            
                
            <div class="row">
                        <div class="col-sm-9">
                            <p class="mb-0">Recipe Name</p>
                        </div>
                        <div class="col-sm-9">
                            <p class="text-muted mb-0"><?= $name ?></p>
                        </div>
                    </div>
                    <hr>

                    <div class="row">
                        <div class="col-sm-9">
                            <p class="mb-0">Meal Type:</p>
                        </div>
                        <div class="col-sm-9">
                            <p class="text-muted mb-0"><?= $food_type ?></p>
                        </div>
                    </div>
                    <hr>

                    <div class="row">
                        <div class="col-sm-9">
                            <p class="mb-0">Add to (Day):</p>
                        </div>
                        <div class="col-sm-9">
                            <p class="text-muted mb-0">
                            <select class="upd-username" name="day" aria-label="Default select example">
                                <option selected value='Monday'>Monday</option>
                                <option selected value='Tuesday'>Tuesday</option>
                                <option selected value='Wednesday'>Wednesday</option>
                                <option selected value='Thursday'>Thursday</option>
                                <option selected value='Friday'>Friday</option>
                                <option selected value='Saturday'>Saturday</option>
                                <option selected value='Sunday'>Sunday</option>
                            </select>
              
                        </div>
                    </div>
                    <hr>
                
                    
        </div>
        </div>
        </div>
            
            <td><button class="planner_edit_btn" style="margin-left: 0%; width: 20%;" type="submit">Confirm</button></td>
            <td><a href="../../user/home_user.php"><button class="planner_back_btn" style="float: right; width: 20%;" type="button">Back</button></a></td>
        
        </form>
    </fieldset>
                </table>
                <?php require_once "../../navbar/bottom_footer_user_recipes.php"?>

    </body>
</html>
    