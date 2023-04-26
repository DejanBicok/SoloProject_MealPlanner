<?php
session_start();

require_once '../components/db_connect.php';

if (isset($_SESSION['USER'])) {
    if ($_GET['id']) {
        $id = $_GET['id'];
    header("Location: user/details.php?id=" . $id);
    exit;
    }
}

if ($_GET['id']) {
    $id = $_GET['id'];       //////////// promeniti id ????
    //display reviews

    $sqlreview = "SELECT * FROM recipe_reviews WHERE fk_recipe_id = {$id}";
    $resultreview = mysqli_query($connect, $sqlreview);
    $tbody = '';
if (mysqli_num_rows($resultreview) > 0) {
    while ($rowreview = mysqli_fetch_array($resultreview, MYSQLI_ASSOC)) {
        $tbody .= "<div id='review'>
        <h5>Rating " . $rowreview['rating'] . "🌟</h5>
        <p>" . $rowreview['message'] . "</p>
        </div>";

    };


}else{
    $tbody = "<tr><td colspan='5'><center> This Recipe has no reviews! </center></td></tr>";
}
    

$sql = "SELECT * FROM recipes WHERE recipe_id = {$id}";
$result = mysqli_query($connect, $sql);
if (mysqli_num_rows($result) == 1) {
    $data = mysqli_fetch_assoc($result);

    $name = $data['name'];
    $ingredients = $data['ingredients'];
    $meal_description = $data['meal_description'];
    $cooking_prep_time = $data['cooking_prep_time'];
    $calories = $data['calories'];
    $food_type = $data['food_type'];
    $picture = $data['picture'];
    $video = $data['video'];

    }
}else{
    header("Location: error.php");
}


// taking info from a logged user

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
<p style='text-align:center;'>" . $rowreview['message'] . " </p>
<br>
" . $tmessage . " 
</div><br>

<form action='actions/a_message.php' method='post'>
<input type='hidden' name='fk_review_id' value=" . $rowreview['review_id'] . ">


</form>
";    

};

}else{
  $tbody = "<tr><td colspan='5'><center> No Reviews Available </center></td></tr>";
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
    <?php require_once '../navbar/nav_admin_second.php'?>
    <?php require_once '../navbar/adm_footer.php'?>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Tasty Food | Recipe Details Main</title>
    </head>

<body class="bg-light">
<h1 class="h1" style="text-align:center; color:#7D8F69;"> <b>'<?= $name ?>'</b></h1>

<section>
<section>
    <div>
      <div>
      <legend class=''><img class='img-thumbnail-details' src='../images/<?= $picture ?>' alt="<?= $name ?>">


              </div>
      <p class="fs-1 fw-bold mt-4" style="text-align:center;">Recipe Details</p>

      <div class="mt-2" style="margin-left:20%;">
        <div class="card p-4 w-75" style="background-color: #cbcbcb;">
            <div class="row g-0">
            <div class="col-md-4 rounded mt-3">
        <p class="card-text p-3">Ingredients <br><?= $ingredients ?></p>

        </div>
             
              <div class="col-md-8">
                <div class="card-body p-3" style="margin-left:15%;">
                 
                  <p class="card-text p-3" style="color:gray;">Method <br><?= $meal_description ?></p>
                  <p class="card-text p-3">Cooking Preparation Time <br><?= $cooking_prep_time ?> min</p>
                  <p class="card-text p-3">Calories <br><?= $calories ?> kcal</p>
                  <p class="card-text p-3">Meal Type <br><?= $food_type ?></p>
                  </form>

                  <div><p><a href="<?= $video ?>" type="button" target="_blank" class="youtube-play">&nbsp; Open Video Recipe<br></a></p></div>
                </div></div>
                  <br>
              <div><h4 class="card-text-posted-by">Recipe posted by: <br> <?= $tmessage2 ?></h4></div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      

      </form>
      </div>

 

      <p class='fs-1 fw-bold p-3' style="text-align:center;"> <i>Reviews</i></p>
      <div class="manageProduct w-50  mt-3 mb-4 border border-5 rounded-5" style="margin-left:25%; background-color: rgba(100, 100, 115, 0.5431372549);">
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

  <?php require_once "../navbar/bottom_footer_admin.php"?>
</body>
</html>