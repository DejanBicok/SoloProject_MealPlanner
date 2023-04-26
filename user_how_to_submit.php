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
  header('Location: main_how_to_submit.php');
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
    <title>Tasty Food | Tips Submitting a Recipe</title>
</head>

<body class="bg-light">

    <div class="container" style="text-align: justify; background-color: #cacaca !important; margin: auto;" >
        <div>
            <div>
                
    <article class="user_main_user_about">
        
     <div class="main_submit_pic_h1">
    
        <h1 class="h1_main_tips"> Tips </h1>
        <h5 class="h5_main_tips">We have healthy and tasty recipes,
        <br> meal ideas, and many more cooking tips,
        <br> plus ways to see tasty recipes from other users. </h5>
      
    </div>
    
    <div><br>
        <h1 class="h1"> Tips for Submitting Your Recipe to Tasty Food </h1>
    </div><br>

    <div class="user-faqs-both">
        <h3 class="user_faqs">FAQs</h3>
        <ul class="ul_user_about">
            <li><a href="#recipe_n" style="color:black;">Recipe Name</a></li>
            <li><a href="#description" style="color:black;">Description</a></li>
            <li><a href="#ingredients" style="color:black;">Ingredients</a></li>
            <li><a href="#time" style="color:black;">Time</a></li>
            <li><a href="#calories" style="color:black;">Calories</a></li>
            <li><a href="#photo_tip" style="color:black;">Photo</a></li>
        
        </ul>
    </div>
<br>
<br>

    <div>
        <h5 id="tips_h5">You're probably reading this because you enjoy cooking and sharing food with others.<br>
         Posting one of your own recipes on Tasty Food is a great way to share your creations with others!
        <br>Here are some tips to help your recipe stand out from the crowd and get published on the site for everyone to find, try, and review!</h5>
    </div>

    <br>
    <br>

<div id="tips_div">
    <div>
        <h4 id="recipe_n" style="color:black;">Recipe Name</h4>
        <p>Choose most unique name that tells the cook what to expect and includes search-friendly words.</p>
    </div>
    <br>

    <div>
        <h4 id="description" style="color:black;">Description</h4>
        <p>Include a short but detailed sentence describing the dish that will get the cook excited and tell them what to expect.
           To help your recipe editor, please stick to basic text and avoid italics, bold type, excess punctuation, and emojis.</p>
    </div>
    <br>

    <div>
        <h4 id="ingredients" style="color:black;">Ingredients</h4>
        <h6><b>Include measurements</b></h6>
          <p>  For other cooks to get the same result you did, it's helpful for ingredients to be as exact and descriptive as possible. 
            Instead of "cheese, parsley to taste, and garlic," write "1 cup shredded Cheddar cheese; ¼ cup chopped fresh parsley, or to taste; and 1 clove garlic, crushed."</p> 
           <h6><b>List ingredients in order</b></h6>
          <p>To make a recipe easy to follow, list the ingredients in the order they are used in the recipe.</p>
        <br>
        
        <h4 id="time" style="color:black;">Time</h4>
        <p>Always add a preparation/cook time when submitting your recipe. If your recipe doesn't require cooking, put a 0 in the cook time section.</p>
        <br>
        
        <h4 id="calories" style="color:black;">Calories</h4>
        <p>Calories are important as well, include how many calories are in your recipe.</p>
        <br>
        <h4 id="photo_tip" style="color:black;">Photo</h4>
        <p>A photo of your dish is always a good idea, take a photo of it and show everyone how appetizing it is!</p>
        <br>
        <h4 id="share" style="color:black;">Share your culinary skills</h4>
            <p></p>
    </div>
    
        <p>You're ready to share your recipe with other members!
        <br>Click on the Create Recipe in your toolbar and get going. 
        <br>If you have any questions along the way, contact <a href="mailto:bicokd@hotmail.com" class="mail" style="color: rgb(174, 128, 0);">bicokd@hotmail.com</a></p>
    </div>
</div>
    </article>
    </div>
    </div>
    </div>
<button id="BackToTop" class="Button WhiteButton Indicator" type="button"><a href="user_about.php"> Back to Top</button>

<?php require_once "navbar/bottom_footer_user_planner.php"?>
    
</body>
</html>