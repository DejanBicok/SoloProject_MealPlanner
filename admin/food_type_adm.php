<?php
session_start();

require_once '../components/db_connect.php';

if(isset($_SESSION['USER'])) {
    header("Location: ../user/index_user.php");
    exit;
}

if (!isset($_SESSION['USER']) && !isset($_SESSION['ADMIN'])) {
    header("Location: ../login.php");
    exit;
}

//print recipes

$food_type = $_GET['food_type'];
$sql_recipes = "SELECT * FROM recipes WHERE food_type = {$food_type}";
$result_recipes = mysqli_query($connect, $sql_recipes);
$tbody = "";

if ($result_recipes->num_rows >0) {
    while ($row = $result_recipes->fetch_array(MYSQLI_ASSOC)) {
        $tbody .= 
        "<div class='card-product'>
        <div class='card-head-product'><a href='recipe_details_admin.php?id=" . $row['recipe_id'] . "'>
          <img src='../images/" . $row['picture'] . "' class='product-img-product' alt='" . $row['name'] . "'>
          
          <div class='back-text-product'>
          " . $row['food_type'] . "
          </div>
          
          <div class='product-detail-product'>
          
         
            <h2>" . $row['name'] . "</h2> 
            
            <span class='cook-time-img'>
            &nbsp; &nbsp; &nbsp; &nbsp;
            Min:&nbsp;
               <span class='cooktime'>" . $row['cooking_prep_time'] . "</span>
    
            <span class='cook-kcal-img'>
            &nbsp; &nbsp; &nbsp; &nbsp;
            Kcal:&nbsp;
               <span class='kcal'>" . $row['calories'] . "</span>
            </span>
           
          </div>
          
            
          </div>
          
        </div>";
    }

}else{
    $tbody = "<tr><td colspan='7'><center>No Recipes Available</center</td></tr>";
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
    <title>Tasty Food | Admin | Categories</title>
</head>

<body class="bg-light">

<div class="container">

<br>
<br>
    <h1 class="text-center"><?= $food_type ?></h1>
<br>


 <main>
    <div class="manageProduct w-100 mt-3" style="margin-bottom: -14%;">
      <div class="row w-200">
        <div class="container-product d-flex flex-wrap mb-5 w-100 m-auto">

<aside>
    <div id="buttons">
    <ul class="f-categ">
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="home_user.php" role="button" data-bs-toggle="dropdown" aria-expanded="false"> Food Categories </a>
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

          <?= $tbody; ?>
        
        </div>   
      </div>
    </div>
 </main>
</div>
<button id="BackToTop" class="Button WhiteButton Indicator" type="button"><a href="">Back to Top</button>
<?php require_once "../navbar/bottom_footer_admin.php"?>                <!-- ?????      subscribe button -->

</body>
</html>