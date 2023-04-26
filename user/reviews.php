<?php
session_start();
require_once '../components/db_connect.php' ;

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

if (isset($_SESSION['ADMIN']) && !isset($_SESSION['USER'])) {
    header('Location: ../login.php');
    exit;

}

//$id=$_GET['id'];
//must change 3 by get id
$sql = "SELECT * FROM recipe_reviews WHERE fk_recipe_id = 3";
$result = mysqli_query($connect, $sql);
$sql2 = "SELECT * FROM recipes WHERE recipe_id = 3";     ///////////   zasto br.  3 ?
$result2 = mysqli_query($connect, $sql2);
$row2 = mysqli_fetch_array($result2, MYSQLI_ASSOC);
$tbody = ''; 
if (mysqli_num_rows($result)  > 0) {
  while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
      $tbody .= 
      
      "<div id='review'>
      <h1>Review" .$row2['name']."</h1>
      <h3>Rating ".$row['rating']."</h3>
      </div>" ;
  };
} else {
  $tbody =  "<tr><td colspan='5'><center>No Data Available </center></td></tr>" ;
}

mysqli_close($connect);

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta  charset="UTF-8">
  <meta name="viewport"  content="width=device-width, initial-scale=1.0">
  <title>Tasty Food | Reviews <?= $row2['name']?></title>
    <link rel="stylesheet" href="../css/style.css">
    <?php require_once '../components/boot.php'?>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>

  <style>
    #review{
        border: solid 2px;
        padding: 1rem;
    }
  </style>
</head>

<body class="bg-light">
  
  <div class= "manageProduct w-75 mt-3">
      <p class='h2'> Reviews </p>
      
              <?=$tbody;?>
  </div>
  <form action="actions/a_review.php" method="post">
    <h1>Add review for <?= $row2['name']?></h1>
    <label for="review">Your review</label>
    <label for="rating">Rating</label>
    <select class="form-select" name="rating" id="">
      
        <option value="0">Select rating:</option>
        <option value="1">🌟</option>
        <option value="2">🌟🌟</option>
        <option value='3'>🌟🌟🌟</option>
        <option value="4">🌟🌟🌟🌟</option>
        <option value="5">🌟🌟🌟🌟🌟</option>
    </select>
    <input type="hidden" name="name" value="<?=$row2['name']?>">
    <input type="hidden" name="user" value="">
    <button class='btn btn-success' type="submit">Send Review!</button>
  </form>

</body>
</html> 