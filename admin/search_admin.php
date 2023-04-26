<?php

require_once '../components/db_connect.php';

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
    <link rel="stylesheet" href="../css/style.css">
    <?php require_once '../components/boot.php'?>
    <?php require_once '../navbar/nav_admin_second.php'?>
    <?php require_once '../navbar/adm_footer.php'?>      <!-- ?????      nema footer  zbog id?-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Tasty Food | Search Results</title>
</head>

<body class="bg-light">
    
    <div class="container">

        <br>
        <h1 style="text-align: center;"> Search results: </h1>
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
 <button id="BackToTop" class="Button WhiteButton Indicator" type="button"><a href="">Back to Top</button>

 <?php require_once "../navbar/bottom_footer_admin.php"?> <!-- ?????      subscribe button -->

</body>
</html>