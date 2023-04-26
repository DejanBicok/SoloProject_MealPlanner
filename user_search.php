<?php

session_start();

require_once 'components/db_connect.php';

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

// ^

$search = $_GET['search'];
$s_recipes = "SELECT * FROM recipes WHERE name LIKE '%$search%'";
$result = mysqli_query($connect, $s_recipes);
$s_result = "";
$tbody = "";

if(mysqli_num_rows($result) == 0) {
    $tbody="<h3 style='font-size: 25px; text-align: center; padding-right: 30%; padding-top: 10%;'> 0 results found </h3>";}
    else{
        while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            if(empty($search)){
            echo "";}
           else{
            
           $tbody .=
    "<div class='card-product'>

    <div class='card-head-product'><a href='details.php?id=" . $row['recipe_id'] . "'>
      <img src='images/" . $row['picture'] . "' class='product-img-product' alt='" . $row['name'] . "'>
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
        }
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
    <title>Tasty Food | Search Results</title>
</head>

<body class="bg-light">
    
    <div class="container">
    <br>

        <h1 class="h1" style="text-align: center;"> Search results: </h1>
        <br>

 <main>
 <div class="manageProduct w-100 mt-2">
      <div class="row w-200">
        <div class="container-product d-flex flex-wrap mb-5 w-200 m-auto">
    

          <?= $tbody; ?>

         </div>
        </div>   
      </div>
    </div>
 </main>
<?php require_once "navbar/bottom_footer_user_planner.php"?> <!-- ?????      subscribe button -->

</body>
</html>