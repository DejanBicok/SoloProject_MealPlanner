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

/** da izvuce admin username **/

$query = "SELECT * FROM users WHERE user_id = {$_SESSION['ADMIN']}";
$result = mysqli_query($connect, $query);
$row = mysqli_fetch_assoc($result);               


$sqladmin = "SELECT * FROM users WHERE status != {$_SESSION['ADMIN']}";
$resultadmin = mysqli_query($connect, $sqladmin);
if ($resultadmin->num_rows > 0) {
    $rowadmin = $resultadmin->fetch_array(MYSQLI_ASSOC);

$username = $rowadmin['username'];
$username = $row['username'];

}
$user_id = $_SESSION['ADMIN'];
$status = 'ADMIN';

$sql = "SELECT * FROM users";



$result = mysqli_query($connect, $sql);

$tbody = '';

if ($result->num_rows > 0) {
    while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
        $tbody .= 
    "<tr>
        <td><img class='rounded-circle' src='../images/" . $row['photo'] . "' alt='profile pic'></td>
        <td>" . $row['username'] . "</td>
        <td>" . $row['first_name'] . " " . $row['last_name'] . "</td>
        <td>" . $row['email'] . "</td>
        <td>" . $row['status'] . "</td>
        <td>" . $row['user_block'] . "</td>

        <td><a href='update_user.php?id=" . $row['user_id'] . "'><button class='create_save_btn_cr' style='width: 31%;'
        type='button'>Edit</button></a>
        <a href='delete_user.php?id=" . $row['user_id'] . "'><button class='planner_del_btn' style='width: 30%;' 
        type='button'>Delete</button></a></td>

    </tr>";

    }
    }else{
        $tbody = "<tr><td colspan='5'><center>No data available. </center</td></tr>";
}

// recipes

$sql_recipes = "SELECT * FROM recipes";
$result_recipes = mysqli_query($connect, $sql_recipes);
$tbody2 = '';
if (mysqli_num_rows($result) > 0) {
     while ($row2 = mysqli_fetch_array($result_recipes, MYSQLI_ASSOC)) {
        
         $tbody2 .=
         "<tr>
         <td><img class='img-thumbnail' src='../images/" . $row2['picture'] . "' alt='recipe img'></td>
         <td>" . $row2['name'] . "</td>
         <td>" . $row2['ingredients'] . "</td>
         <td>" . $row2['meal_description'] . "</td>
         <td>" . $row2['cooking_prep_time'] . "</td>
         <td>" . $row2['calories'] . "</td>
         <td>" . $row2['food_type'] . "</td>
        

         <td><a href='update_recipe.php?recipe_id=" . $row2['recipe_id'] . "'><button class='create_save_btn_cr' style='width: 110%;'
         type='button'>Edit</button></a>
         <a href='delete_recipe.php?recipe_id=" . $row2['recipe_id'] . "'><button class='planner_del_btn' style='width: 110%;' 
         type='button'>Delete</button></a></td>

    </tr>";
    
    }
    
    } else {
    $tbody2 = "<tr><td colspan='9'><center>No Data Available </center></td></tr>";
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
    <?php require_once '../navbar/nav_admin.php'?>
    <?php require_once '../navbar/adm_footer.php'?>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <title>Tasty Food | Admin | Dashboard</title>
</head>

<body class="bg-light">
<aside style="margin-left: 3%;">
    <div id="buttons">
    <ul class="f-categ">
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="food_type_admin.php" role="button" data-bs-toggle="dropdown" aria-expanded="false"> Food Categories </a>
      <ul class="dropdown-menu" id="food_cat_dropdown">
        <li><a class="dropdown-item" href="food_type_adm.php?food_type='Breakfast'">Breakfast</a></li>
        <li><a class="dropdown-item" href="food_type_adm.php?food_type='Lunch'">Lunch</a></li>
        <li><a class="dropdown-item" href="food_type_adm.php?food_type='Dinner'">Dinner</a></li>
        <li><a class="dropdown-item" href="food_type_adm.php?food_type='Vegan'">Vegan</a></li>
        <li><a class="dropdown-item" href="food_type_adm.php?food_type='Vegeterian'">Vegeterian</a></li>
    </ul>
  </li>
</ul>
</div>
</aside>

<br>
<br>
        <div class="row" style="margin-bottom: -7.5%;">
            <div class="col-2">

            </div>
            <div class="col-8 mt-2">
                <h1 style="text-align: center;">Users</h1>
                <br>
                <br>

                <table class='table table-striped'>
                    <thead class="">
                        <tr>
                            <th>Photo</th>
                            <th>Username</th>
                            <th>Full Name</th>
                            <th>Email</th>
                            <th>Status</th>
                            <th>Block?</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?= $tbody ?>
                    </tbody>
                </table>
<br>
<br>
<br>
<br>
                <h2>Recipe List</h2>
                <table class='table table-striped'>
                    <thead class="">
                        <tr>
                            <th>Picture</th>
                            <th>Name</th>
                            <th>Ingredients</th>
                            <th>Method</th>
                            <th>Cooking Preparation Time</th>
                            <th>Calories</th>
                            <th>Food/Meal Type</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                            <?= $tbody2 ?>
                        </tbody>
                </table>
            </div>
        </div>
    </div>
    <button id="BackToTop" class="Button WhiteButton Indicator" type="button"><a href="">Back to Top</button>

    <?php require_once "../navbar/bottom_footer_admin.php"?>

</body>
</html>