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
  header('Location: about.php');
  exit;
}
if (isset($_SESSION['ADMIN'])) {
  header('Location: admin/index_admin.php');
  exit;
}

$query = "SELECT * FROM users WHERE user_id = {$_SESSION['USER']}";
$result = mysqli_query($connect, $query);
$row = mysqli_fetch_assoc($result);

$id = $row['user_id'];
$username = $row['username'];
$photo = $row['photo'];

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
    <title>Tasty Food | About</title>
</head>

<body class="bg-light">

    <div class="container" style="text-align: justify; background-color: #cacaca !important; margin: auto;" >
        <div>
            <div>
                
    <article class="user_main_user_about">
        
     <div class="user_about_h1">
    
        <h1 class="h1_user_about"> About Tasty Food </h1>
        <h5 class="h5_user_about">We have healthy and tasty recipes,
        <br> meal ideas, and many more cooking tips,
        <br> plus ways to see tasty recipes from other users. </h5>
      
    </div>
    
    <div><br>
        <h1 class="h1"> Thanks for visiting Tasty Food </h1>
    </div><br>

    <div class="user-faqs-both">
        <h3 class="user_faqs">FAQs</h3>
        <ul class="ul_user_about">
            <li><a href="#general" style="color:black;">General</a></li>
            <li><a href="#meal_planner" style="color:black;">What is meal planner?</a></li>
            <li><a href="#get_started" style="color:black;">How do I get started?</a></li>
            <li><a href="#own_recipe" style="color:black;">Creating your own recipe?</a></li>
            <li><a href="#edit_plan" style="color:black;">How do I edit my meal plan?</a></li>
            <li><a href="#contact" style="color:black;">Contact us</a></li>
            <li><a href="#soc_media" style="color:black;">Social Media</a></li>
        
        </ul>
    </div>
<br>
    <div>
        <h4 id="general" style="color:black;">General</h4>
        <p>Meal planner is a handy online tool to help you find recipe ideas and organise your weekly meal plans, all in one easy place.
        <br>With <b>Tasty Food</b>, you can plan and create countless, super tasty meals and learn how to make your own food.
        <br>It's always hard to know what's the right food to eat and when. Planning and organizing them in advance sometimes becomes a nightmare.
        <br>This site is to make effective nutrition strategies available to everyone, especially people who are too busy to get started on their own.
        <br>A Meal Planner that can help you organise and choose meals for a short period of time.</p>
        <br><p>Like a recipe? Please share your comments on recipes in the review section of the recipe.</p>
    </div>
    <br>

    <div>
        <h4 id="meal_planner" style="color:black;">What is meal planner?</h4>
        <p>Our meal planner is a handy online tool to help you plan meals ahead of time. Our meal planner saves delicious recipes for you to try over 5 or 7 days based on your likes and dislikes.
        <br>You can swap recipes in and out of your meal plan as you go, so if there's anything you don't fancy or want to add in to your week it can be easily added or taken away.</p>
    </div>
    <br>

    <div>
        <h4 id="get_started" style="color:black;">How do I get started?</h4>
        <p>Start by looking available recipes here: <a href="user/home_user.php" style="text-decoration:underline !important; color:rgb(174, 128, 0);"><!--Create a meal plan-->Recipe List.</a>
        <br>Or easily insert your preferences in our search section to find a wanted meal, depending on what are your appetite needs.
        <br>Here you can see your Meal Planner and all recipes you've added: <a href="planner.php" style="text-decoration:underline !important; color:rgb(174, 128, 0);">Meal Planner.</a>
        <br>All meal plans can be edited, saved and customised to suit your needs.</p>
        <br>
        
        <h4 id="own_recipe" style="color:black;">Creating your own recipe?</h4>
        <p>Users can easily <a href="user/user_recipes/create_recipe.php" style="text-decoration:underline !important; color:rgb(174, 128, 0);"> Create </a> and publish their own recipes on 'Tasty Food' and share them with other members.</p>
        <br>
        
        <h4 id="edit_plan" style="color:black;">How do I edit my meal plan?</h4>
        <p>You can edit your meal plan at any time by clicking on 'Edit' in the meal planner located on the right side of it.
        <br>You can even try swapping recipes around by dragging them into different slots in your meal plan. You may also like to give your meal plan a unique name - simply click the 'My meal plan' title to change it.</p> <!-- da li ovo ostaviti -->
        <br>
        <h4 id="contact" style="color:black;">Contact us</h4>
        <p>Have something you'd like to let us know? Whether you have a comment on a recipe or an idea to share, we would love to hear from you: <a style="color:rgb(174, 128, 0);" href="mailto:bicokd@hotmail.com" class="mail">bicokd@hotmail.com</a></p>
        <br>
        <div class="soc_media_links">
        <h4 id="soc_media" style="color:black;">Find us on social media:</h4>
            <p style="font-size: 14px;">(examples)</p>
            <p><b>Facebook : </b><a href="https://www.facebook.com">Tasty Food</a>
            <br><b>Instagram : </b><a href="https://www.instagram.com">@tastyfood</a> 
            <br><b>Twitter : </b><a href="https://www.twitter.com">@tastyfood</a></p>
    </div>
    <br>
        <p>Every product we make is meant to inspire moments of joy and discovery. To help you get started, we've compiled a few of our favorite recipes and will continue to add more each month. </p>
    </div>
    
    </article>
    
    </div>
    </div>
    </div>
<button id="BackToTop" class="Button WhiteButton Indicator" type="button"><a href="user_about.php"> Back to Top</button>

<?php require_once "navbar/bottom_footer_user_planner.php"?>
    
</body>
</html>