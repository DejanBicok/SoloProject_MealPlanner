<?php
session_start();

require_once '../components/db_connect.php';

$userinfo = mysqli_query($connect, "SELECT * FROM users WHERE user_id = {$_SESSION['USER']}");
$info = mysqli_fetch_array($userinfo, MYSQLI_ASSOC);

if ($info['user_block'] == 'blocked') {
    header('Location: ../block.php');
    exit;
}

if (isset($_SESSION['ADMIN'])) {
    header('Location: ../admin/index_admin.php');
   exit;
}
  if (!isset($_SESSION['ADMIN']) && !isset($_SESSION['USER'])) {
  header('Location: ../login.php');
  exit;
}


$query = "SELECT * FROM users WHERE user_id = {$_SESSION['USER']}";
$result = mysqli_query($connect, $query);
$row = mysqli_fetch_assoc($result);

$id = $row['user_id'];
$username = $row['username'];
$photo = $row['photo'];




$sql_recipes = "SELECT * FROM recipes WHERE fk_user_id = $id";
$result_recipes = mysqli_query($connect, $sql_recipes);
$tbody = '';

if (mysqli_num_rows($result_recipes) > 0) {
     while ($row = mysqli_fetch_array($result_recipes, MYSQLI_ASSOC)) {
        
        $tbody .=
        "<div class='card-product-my-recipe'>

        <div class='card-head-product-my-recipe'><a href='../details.php?id=" . $row['recipe_id'] . "'>
          <img src='../images/" . $row['picture'] . "' class='product-img-product-my-recipe' alt='" . $row['name'] . "'>
          <div class='back-text-product'>
          " . $row['food_type'] . "
          </div>
          <div class='product-detail-product'>
          
     
            
            <h2>" . $row['name'] . "</h2> 
            
<br>
<br>
    
            <td><a href='user_recipes/update_recipe.php?recipe_id=" . $row['recipe_id'] . "'><button class='my_recipe_back_btn' 
            type='button'>Edit</button></a>
            <a href='user_recipes/delete_recipe.php?recipe_id=" . $row['recipe_id'] . "'><button class='my_recipe_del_btn' 
            type='button'>Delete</button></a></td>
   
            </span>
           
          </div>
          
        </div>
          
      </div>";


    // if (mysqli_num_rows($resultreview) > 0) {
    //     while ($rowreview = mysqli_fetch_array($resultreview, MYSQLI_ASSOC)) {
    //         //adding message to review
    //        $sqlmessage = "SELECT * FROM recipes RIGHT JOIN users ON recipes.fk_user_id = users.user_id WHERE recipe_id = {$rowreview['recipe_id']}";
    //        $resultmessage = mysqli_query($connect, $sqlmessage);



    //     }
    // }

    };

}else{
    $tbody = "<tr><td colspan='8'><center class='no_made_recipe'> You haven't made any recipe yet! </center></td></tr>";

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
    <?php require_once '../navbar/nav_user.php'?>
    <?php require_once '../navbar/footer.php'?>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    
    <title>Tasty Food | Your Recipes</title>
</head>

<body class="bg-light">

<div class="container">

<br>
<h1 class="h1"> Your Recipes, <?= $username ?>. </h1>
<br>

<main>
    <div class="manageProduct_index_user w-100 mt-2">
    <div class="row w-200" style="margin-right: 2%;">
        <div class="container-product-index-user d-flex flex-wrap mb-5 w-200 m-auto">
        
        <?= $tbody; ?>
        
        </div>
    </div>
    </div>

</main>
</div>

<button id="BackToTop" class="Button WhiteButton Indicator" type="button"><a href="index_user.php"> Back to Top</button>

    <?php require_once "../navbar/bottom_footer_user.php"?>

</body>
</html>