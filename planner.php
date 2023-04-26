<?php
session_start();

require_once 'components/db_connect.php';

$userinfo = mysqli_query($connect, "SELECT * FROM users WHERE user_id = {$_SESSION['USER']}");
$info = mysqli_fetch_array($userinfo, MYSQLI_ASSOC);

if ($info['user_block'] == 'blocked') {
    header('Location: block.php');
    exit;
}

if (isset($_SESSION['ADMIN'])) {
    header('Location: admin/index_admin.php');
   exit;
}
  if (!isset($_SESSION['ADMIN']) && !isset($_SESSION['USER'])) {
  header('Location: login.php');
  exit;
}



$sql_recipes3 = "SELECT * FROM recipes WHERE recipe_id";
$result_recipes3 = mysqli_query($connect, $sql_recipes3);
$row3 = mysqli_fetch_assoc($result_recipes3);

$id = $row3['recipe_id'];
$food_type = $row3['food_type'];
$name = $row3['name'];




$query = "SELECT * FROM users WHERE user_id = {$_SESSION['USER']}";
$result = mysqli_query($connect, $query);
$row = mysqli_fetch_assoc($result);

$id = $row['user_id'];
$username = $row['username'];
$photo = $row['photo'];




$sql_recipes2 = "SELECT * FROM meal_planner WHERE fk_user_id = $id";
$result_recipes2 = mysqli_query($connect, $sql_recipes2);
$tbody2 = '';

if (mysqli_num_rows($result_recipes2) > 0) {
    while ($row2 = mysqli_fetch_array($result_recipes2, MYSQLI_ASSOC)) {

        
$tbody2 .= 

"  
<div class='float-container' style='background-color:rgb(255, 255, 255); box-shadow: 0px 0px 5px 5px #cacaca; border-radius: 5px;'>
        
        <div class='float-child'>

<h2 class='text-center-day'></h2><td>'" . $row2['day'] . "</td></h2>
<td><img class='img-thumbnail' src='/images/" . $row2['picture'] . "' alt='recipe img'></td>
<p><td>" . $row2['ingredients'] . "</td></p>

<p><td>" . $row2['recipe_name'] . "</td></p>
<p><td>" . $row2['food_type'] . "</td></p>



<p>Date: &nbsp; <td>" . $row2['meal_date'] . "</td></p>
<p>Time: &nbsp; <td>" . $row2['meal_time'] . "</td>

<br>
<br>
      
<td>
<a href='update_planner.php?planner_id=" .$row2['planner_id'] . "'><button class='planner_edit_btn' type='button'>Edit Plan</button></a>

<a href='delete_planner.php?planner_id=" . $row2['planner_id'] . "'><button class='planner_del_btn' 
type='button'>Delete Plan</button></a>
</td>

</tr>
</div>
</div>
";




    }
}






$sql_recipes = "SELECT * FROM meal_planner WHERE fk_user_id = $id";
$result_recipes = mysqli_query($connect, $sql_recipes);
$tbody = '';

if (mysqli_num_rows($result_recipes) > 0) {
     while ($row = mysqli_fetch_array($result_recipes, MYSQLI_ASSOC)) {
        
        
        $tbody .= 
        "  
  
        
        <div class='float-container'>
        
        <div class='float-child'>
        <h2 class='text-center-day'><td>" . $row['day'] . "</td></h2>
        <h3 class='h3-day'><td>" . $row['food_type'] . "</td></h3>
        <td><img class='img-thumbnail' src='images/" . $row['picture'] . "' alt='recipe img'></td>
        
        <h4><td>" . $row['recipe_name'] . "</td></h4>
        <br>

        <p>Date: &nbsp; <td>" . $row['meal_date'] . "</td></p>
        <p>Time: &nbsp; <td>" . $row['meal_time'] . "</td>
        <br>
        <br>

        <h5>Ingredients</h5><td>" . $row['ingredients'] . "</td>
        <br>
        <br>
        <br>
        <h5>Method</h5><td>" . $row['meal_description'] . "</td>
        
      

        
        <br>
        <br>
              
        <td>
        <a href='update_planner.php?planner_id=" .$row['planner_id'] . "'><button class='my_planner_edit_btn' style='width: 30%;' type='button'>Edit</button></a>
        
        <a href='delete_planner.php?planner_id=" . $row['planner_id'] . "'><button class='my_planner_del_btn' style='width: 28%;'
        type='button'>Delete</button></a>
        </td>
        
        </tr>
        </div>
        </div>

        ";
        
    }
}else{
    $tbody2 = "<tr><td colspan='2'><center> No planned meals. </center></td></tr>";

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
    <?php require_once 'navbar/nav_planner.php'?>
    <?php require_once 'navbar/footer_planner.php'?>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Tasty Food | Meal Planner</title>
</head>

<body>

<h1 class="h1" style="text-align: center; color: #7D8F69;"> Your Meal Planner, <?= $username ?>. </h1>


<main>
    <div class="manageProduct-day-planner w-300 mt-2 bg-light">
      <div class="row-day w-200">
        <div class="container-product-day flex-wrap mb-5 w-200 m-auto">
<br>
<br>
<br>

  <div class="row">

  <tbody>
          <?= $tbody; ?>
  </tbody>

        </div>
      </div>
    </div>
  </div>
   
</main>
<button id="BackToTop" class="Button WhiteButton Indicator" type="button">
  <a href=""> 
    Back to Top </a>
  </button>
        <?php require_once "navbar/bottom_footer_user_planner.php"?>
</body>
</html>