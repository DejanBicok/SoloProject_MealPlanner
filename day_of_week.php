<?php

require_once 'components/db_connect.php';

session_start();


$userinfo = mysqli_query($connect, "SELECT * FROM users WHERE user_id = {$_SESSION['USER']}");
$info = mysqli_fetch_array($userinfo, MYSQLI_ASSOC);

if ($info['user_block'] == 'blocked') {
    header('Location: block.php');
    exit;
}

if (!isset($_SESSION['USER']) && !isset($_SESSION['ADMIN'])) {
  header('Location: index.php');
  exit;
}
if (isset($_SESSION['ADMIN'])) {
  header('Location: admin/index_admin.php');
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

//////////////////////

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



$day = $_GET['day'];
$sql_recipes = "SELECT * FROM meal_planner WHERE day = $day";
$sql_recipes2 = "SELECT * FROM meal_planner WHERE fk_user_id = $id";
$result_recipes2 = mysqli_query($connect, $sql_recipes2);
$tbody2 = '';

if (mysqli_num_rows($result_recipes2) > 0) {
    while ($row2 = mysqli_fetch_array($result_recipes2, MYSQLI_ASSOC)) {

        
$tbody2 .= 

"  
<div class='column' style='background-color:rgb(240, 240, 240); box-shadow: 0px 0px 5px 5px #cacaca; border-radius: 5px;'>

<tr>
<h2><td>" . $row2['day'] . "</td></h2>
<td><img class='img-thumbnail' src='/images/" . $row2['picture'] . "' alt='recipe img'></td>

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
";


$day = $_GET['day'];
$sql_recipes = "SELECT * FROM meal_planner WHERE day = {$day}";
$result_recipes = mysqli_query($connect, $sql_recipes);
$tbody = "";

if ($result_recipes->num_rows >0) {
    while ($row = $result_recipes->fetch_array(MYSQLI_ASSOC)) {
        $tbody .= 
        "  
  
        
        <div class='float-container'>
        
        <div class='float-child'>
        <h3 class='h3-day'><td>" . $row['food_type'] . "</td></h3>
        <td><img class='img-thumbnail' src='/images/" . $row['picture'] . "' alt='recipe img'></td>
        
        <h4><td>" . $row['recipe_name'] . "</td></h4>
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
    
  }
}
}else{
    $tbody = "<h5><center><br><br><br>No planned meals.</center></h5>";
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
    <?php require_once 'navbar/nav_user.php'?>
    <?php require_once 'navbar/footer.php'?>       <!-- ?????      nema footer -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    
    <title>Tasty Food | Meal Planner</title>
</head>

<body class="bg-light">

<br>
<br>
<br>
<h1 style="text-align: center;"> Your Meal Planner, <?= $username ?>. </h1>
<br>
<br>


    <div class="container">
    <div class="row" style="background-color:rgb(255, 255, 255);">

      <div class="col-sm">
      <a class="" href="day_of_week.php?day='Monday'">Monday</a>
      </div>
      
      <div class="col-sm">
      <a class="" href="day_of_week.php?day='Tuesday'">Tuesday</a>
      </div>

      <div class="col-sm">
      <a class="" href="day_of_week.php?day='Wednesday'">Wednesday</a>
      </div>

      <div class="col-sm">
      <a class="" href="day_of_week.php?day='Thursday'">Thursday</a>
      </div>

      <div class="col-sm">
      <a class="" href="day_of_week.php?day='Friday'">Friday</a>
      </div>

      <div class="col-sm">
      <a class="" href="day_of_week.php?day='Saturday'">Saturday</a>
      </div>

      <div class="col-sm">
      <a class="" href="day_of_week.php?day='Sunday'">Sunday</a>
      </div>
     
    <div>

</div>
</div>
</div>

<main>
    <div class="manageProduct-day w-300 mt-2 bg-light" style="margin-bottom: -81.5px !important;">
      <div class="row-day w-200">
        <div class="container-product-day flex-wrap mb-5 w-200 m-auto">



        <h2 class="text-center-day"><?= $day ?></h2>


<div class="row">


  <tbody>
          <?= $tbody; ?>
  </tbody>
          </div>
        </div>
      </div>
    </div>
    
</main>
<button id="BackToTop" class="Button WhiteButton Indicator" type="button"><a href="">Back to Top</button>

 <?php require_once "navbar/bottom_footer_user.php"?>                <!-- ?????      subscribe button -->
</body>
</html>