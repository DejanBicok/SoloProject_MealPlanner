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

// $query = "SELECT * FROM users WHERE user_id={$_SESSION['USER']}"; //////// ??????????? da li ili izbrisati?



$sqlplanner = "SELECT * FROM meal_planner";
$resultplanner = mysqli_query($connect, $sqlplanner);
$tbody2 = '';
if (mysqli_num_rows($resultplanner) > 0) {
    while ($row2 =mysqli_fetch_array($resultplanner, MYSQLI_ASSOC)) {

      $tbody2 .="
      
          <span>
            " . $row2['availability'] . "
          </span>
      </div>
      ";
    }
}

$sql = "SELECT * FROM recipes";
$result = mysqli_query($connect, $sql);
$tbody = '';
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
        
  $tbody .="
  
  <div class='card-product-video'>

  <div class='card-head-product-video'>
  
   <a href='" . $row['recipe_id'] . "' type='button' target='_blank'>
   
    <img src='images/" . $row['picture'] . "' class='product-img-product-video'></a>
    <h2 class='video-name'>" . $row['name'] . "</h2> 


    </div>
    <span class='product-detail-product-video'>
    <a href='" . $row['video'] . "' type='button' target='_blank' class='youtube-play-video'></a>

    </span>
    

    
</div>";
    
};
} else {
    $tbody = "<tr><td colspan='9'><center>No Data Available </center></td></tr>";
            
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
    
    <title>Tasty Food | Recipe Videos</title>
</head>

<body class="bg-light">

  <div class="container">

    <br>
    <h1 class="h1"> Recipe Videos </h1>
    <br>
    
<main>
    <div class="manageProduct-video w-100 mt-2">
      <div class="row w-200">
        <div class="container-product d-flex flex-wrap mb-5 w-200 m-auto">
          
          <?= $tbody; ?>
          <?= $tbody2; ?>
        
        </div>
      </div>
    </div>
    
</main>
</div>

<button id="BackToTop" class="Button WhiteButton Indicator" type="button">
  <a href=""> 
    Back to Top </a>
</button>

<?php require_once "navbar/bottom_footer_user_planner.php"?>

</body>

</html>


