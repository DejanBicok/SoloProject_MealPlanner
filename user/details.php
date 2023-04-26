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

// ubaceno zbog prof pic 

$query = "SELECT * FROM users WHERE user_id={$_SESSION['USER']}";
$result = mysqli_query($connect, $query);
$row = mysqli_fetch_assoc($result);

$id = $row['user_id'];
$username = $row['username'];
$photo = $row['photo'];


// ^

if ($_GET['id']) {
    $id = $_GET['id'];
    //display details from id recipes
    $sql = "SELECT * FROM recipes WHERE recipe_id = $id";
    $result = mysqli_query($connect, $sql);
if (mysqli_num_rows($result) == 1) {
    
    $data = mysqli_fetch_assoc($result);
    $name = $data['name'];
    $ingredients = $data['ingredients'];
    $meal_description = $data['meal_description'];
    $cooking_prep_time = $data['cooking_prep_time'];
    $calories = $data['calories'];
    $food_type =$data['food_type'];
    $picture = $data['picture'];
    $video = $data['video'];
    

}

}else{
    header("Location: ../error.php");
}


// taking info from a logged user

$sqluser = "SELECT * FROM users WHERE user_id = {$_SESSION['USER']}";
$resultuser = mysqli_query($connect, $sqluser);
$rowuser = mysqli_fetch_assoc($resultuser);
//display reviews
$sqlreview = "SELECT * FROM recipe_reviews WHERE fk_recipe_id = {$id}";
$resultreview = mysqli_query($connect, $sqlreview);

$sqlreview2 = "SELECT * FROM recipes WHERE recipe_id = {$id}";
$resultreview2 = mysqli_query($connect, $sqlreview2);
$tbody = '';


$tmessage = '';                           /* sqlreview2 deo je nov i ispod ovog komentara */



if (mysqli_num_rows($resultreview2) > 0) {
  while ($rowreview2 = mysqli_fetch_array($resultreview2, MYSQLI_ASSOC)) {
      //adding message to review
     $sqlmessage2 = "SELECT * FROM recipes RIGHT JOIN users ON recipes.fk_user_id = users.user_id WHERE recipe_id = {$rowreview2['recipe_id']}";
     $resultmessage2 = mysqli_query($connect, $sqlmessage2);
     $tmessage2 = '';

if (mysqli_num_rows($resultmessage2) > 0) {
while ($rowmessage2 = mysqli_fetch_array($resultmessage2, MYSQLI_ASSOC)) {
  $tmessage2 .= "<div class='card-text-posted' style='background-color: rgba(255, 255, 255);'>
  <p style='text-align:center;' class='card-text-posted-down'>" . $rowmessage2['username'] . "</p>
  
  </div>";

};
}
}
}

if (mysqli_num_rows($resultreview) > 0) {
    while ($rowreview = mysqli_fetch_array($resultreview, MYSQLI_ASSOC)) {
        //adding message to review
       $sqlmessage = "SELECT * FROM recipe_reviews RIGHT JOIN users ON recipe_reviews.fk_user_id = users.user_id WHERE review_id = {$rowreview['review_id']}";
       $resultmessage = mysqli_query($connect, $sqlmessage);
       $tmessage = '';

if (mysqli_num_rows($resultmessage) > 0) {
  while ($rowmessage = mysqli_fetch_array($resultmessage, MYSQLI_ASSOC)) {
    $tmessage .= "<div class='message border border-1' style='background-color: rgba(255, 255, 255);'>
    <p style='text-align:center;'> Recipe rated by: " . $rowmessage ['username'] . "</p>

    
    </div>";

  };
}

$tbody .= "<div id='review'>
<h4 style='text-align:center;'>Rating of: &nbsp;" . $rowreview['rating'] . " 🌟</h4>
</div><br>

<div id='message'>

    <h5 style='text-align:center;'> Comment: </h5> 
<br>
<p style='text-align:center;'>" . $rowreview['message'] . " </p>
<br>
" . $tmessage . " 
</div><br>

<form action='actions/a_message.php' method='post'>
<input type='hidden' name='fk_review_id' value=" . $rowreview['review_id'] . ">
<input type='hidden' name='fk_user_id' value=" . $_SESSION['USER'] . ">


</form>
";    

};

}else{
    $tbody = "<tr><td colspan='5'><center> This recipe has no reviews yet. </center></td></tr>";
}
  
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
    $video = $recipes['video'];

        
    $tbody2=
    "<tr>
        
       
    <td><a href='../user/user_recipes/add_recipe.php?recipe_id=" . $recipes['recipe_id'] . "'><button class='btn-add-planner' type='button'> Add to Meal Planner </button></a>

    
    </tr>";
};
  

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

    <title>Tasty Food | Recipe Details</title>
</head>

<body class="bg-light">
<h1 class="h1" style="text-align:center; color:#7D8F69;"> <b>'<?= $name ?>'</b></h1>
<section>
    <div>
      
      <div>
      <legend class=''><img class='img-thumbnail-details' src='../images/<?= $picture ?>' alt="<?= $name ?>">
      </div>

      <h1 style="text-align:center;"><b>Recipe Details</b></h1>

        <div class="mt-2" style="margin-left:20%;">
          <div class="card p-4 w-75" style="background-color: #cbcbcb;">
            <div class="row g-1">
            <div class="col-md-4 rounded">
        <h4 class="card-text p-3">Ingredients</h4><br><p><?= $ingredients ?></p>

        </div>
             
              <div class="col-md-8">
                <div class="card-body" style="margin-left:15%;">
                 <form>
                  <h4 class="card-text">Method </h4><br><p><?= $meal_description ?></p>
                  <p class="card-text">Cooking Preparation Time <br><?= $cooking_prep_time ?> min</p>
                  <p class="card-text">Calories <br><?= $calories ?> kcal</p>
                  <p class="card-text">Meal Type <br><?= $food_type ?></p>
                  <br>
                  </form>
                  <div><p><a href="<?= $video ?>" type="button" target="_blank" class="youtube-play">&nbsp; Open Video Recipe<br></a></p></div>
                </div><?= $tbody2; ?></div>
                  <br>
              <div><h4 class="card-text-posted-by">Recipe posted by: <br> <?= $tmessage2 ?></h4></div>

                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <br><br>


      <div style="margin-left:20%;">
      <form class="card p-5 w-75" style="background-color: #cbcbcb;" action="actions/a_review.php" method="post">
        <h1 style="text-align:center; color: whitesmoke;">Rate <?=$name?> Recipe!</h1>
        <label for="rating"></label>
        <select class="form-select" name="rating" id="">
          <option value="0">Select rating:</option>
          <option value="1">🌟</option>
          <option value="2">🌟🌟</option>
          <option value='3'>🌟🌟🌟</option>
          <option value="4">🌟🌟🌟🌟</option>
          <option value="5">🌟🌟🌟🌟🌟</option>
        </select>
        <br>
      <textarea class='form-select' name='message' id='' cols='15' rows='5'> </textarea> <!-- name message je u a_review-->

        <input type="hidden" name="recipe_id" value="<?= $id ?>">
        <input type="hidden" name="user_id" value=<?= $_SESSION['USER'] ?>>
        <button class='mt-4' style="background-color: #e7b15f; border-radius: 10px; padding: 5px;" type="submit">Send review</button>
      </form>
      </div>

      <br>

      <p class='fs-1 fw-bold p-3' style="text-align:center;"> <i>Reviews</i></p>
      <div class="manageProduct w-50  mt-3 mb-4 border border-5 rounded-5" style="margin-left:25%; margin-bottom: -5.9% !important; background-color: rgba(100, 100, 115, 0.5431372549);">
        <br/>
        <?= $tbody; ?>
        <br/>

      </div>
    </div>
  </section>

  <button id="BackToTop" class="Button WhiteButton Indicator" type="button">
  <a href=""> 
    Back to Top </a>
  </button>

  <?php require_once "../navbar/bottom_footer_user.php"?>
</body>
</html>