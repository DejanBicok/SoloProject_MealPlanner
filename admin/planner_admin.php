<?php
session_start();

require_once '../components/db_connect.php';


if (isset($_SESSION['USER'])) {
    header('Location: user/index_user.php');
   exit;
}
  if (!isset($_SESSION['ADMIN']) && !isset($_SESSION['USER'])) {
  header('Location: ../login.php');
  exit;
}

$sql_recipes3 = "SELECT * FROM recipes WHERE recipe_id";
$result_recipes3 = mysqli_query($connect, $sql_recipes3);
$row3 = mysqli_fetch_assoc($result_recipes3);

$id = $row3['recipe_id'];
$food_type = $row3['food_type'];
$name = $row3['name'];



$query = "SELECT * FROM users WHERE user_id = {$_SESSION['ADMIN']}";
$result = mysqli_query($connect, $query);
$row = mysqli_fetch_assoc($result);

$id = $row['user_id'];
$username = $row['username'];
$photo = $row['photo'];



// $sql_recipes2 = "SELECT * FROM recipes";
// $result_recipes2 = mysqli_query($connect, $sql_recipes2);
// $tbody2 = '';

// if (mysqli_num_rows($result_recipes2) > 0) {
//     while ($row2 = mysqli_fetch_array($result_recipes2, MYSQLI_ASSOC)) {

// $tbody2 .= 

// "<tr>

// <td>" . $row2['name'] . "</td>
// <td>" . $row2['picture'] . "</td>


// <td>

// <a href='delete_planner.php?planner_id=" . $row2['recipe_id'] . "'><button class='btn btn-danger btn-sm' 
// type='button'>Delete</button></a></td>

// </tr>";


//     }
// }



$sql_recipes = "SELECT * FROM meal_planner";
$result_recipes = mysqli_query($connect, $sql_recipes);
$tbody = '';

if (mysqli_num_rows($result_recipes) > 0) {
     while ($row = mysqli_fetch_array($result_recipes, MYSQLI_ASSOC)) {
        
        
        $tbody .= 

        "<tr>
       
        <td>" . $row['fk_recipe_name'] . "</td>
        <td>" . $row['planner_id'] . "</td>
        <td>" . $row['fk_recipe_id'] . "</td>
        <td>" . $row['availability'] . "</td>
        <td>" . $row['day'] . "</td>
        <td>" . $row['meal_date'] . "</td>
        <td>" . $row['meal_time'] . "</td>

        <td>
        <a href='update_planner_admin.php?planner_id=" .$row['planner_id'] . "'><button class='btn btn-primary btn-sm' type='button'>Update</button></a>
        <a href='delete_meal.php?delete_meal_id=" . $row['planner_id'] . "'><button class='btn btn-danger btn-sm' type='button'>Delete</button></a></td>
        
        </tr>";
    }
}else{
    $tbody = "<tr><td colspan='2'><center> No Data Available </center></td></tr>";

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
    <?php require_once '../navbar/nav_admin_second.php'?>
    <?php require_once '../navbar/adm_footer.php'?>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    
    <title>Tasty Food | Admin | Meal Planner</title>
</head>

<body class="bg-light">
<h1 class="text-center"> (Admin) Meal Planner </h1>

<aside>
    <div id="buttons">
    <ul class="f-categ">
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="../user/index_user.php" role="button" data-bs-toggle="dropdown" aria-expanded="false"> Food Categories </a>
      <ul class="dropdown-menu" id="food_cat_dropdown">
        <li><a class="dropdown-item" href="../food_type_adm.php?food_type='Breakfast'">Breakfast</a></li>
        <li><a class="dropdown-item" href="../food_type_adm.php?food_type='Lunch'">Lunch</a></li>
        <li><a class="dropdown-item" href="../food_type_adm.php?food_type='Dinner'">Dinner</a></li>
        <li><a class="dropdown-item" href="../food_type_adm.php?food_type='Vegan'">Vegan</a></li>
        <li><a class="dropdown-item" href="../food_type_adm.php?food_type='Vegeterian'">Vegeterian</a></li>
    </ul>
  </li>
</ul>
</div>
</aside>

    <div class="container">
        <div class="row">
         
            <div class="col-8 mt-2">
                <p class='h2'>Meals list:</p>

                <table class='table table-striped'>
                    <thead class="table-info text-secondary">
                        <tr>
                            <th>Recipe Name</th>
                            <th>Planner ID</th>
                            <th>Recipe ID</th>
                            <th>Availability</th>
                            <th>Day</th>
                            <th>Meal Date</th>
                            <th>Meal Time</th>
                            <th>Options</th>

                            
                        </tr>
                    </thead>
                   

                    <tbody>
                        <?= $tbody ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <button id="BackToTop" class="Button WhiteButton Indicator" type="button"><a href="">Back to Top</button>

    <?php require_once "../navbar/bottom_footer_admin.php"?>

</body>
</html>