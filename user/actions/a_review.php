<?php
session_start();

require_once '../../components/db_connect.php';

//  if (isset($_SESSION['USER']) != "") {
//     header("Location: ../../index.php");
//     exit;
// }

// if (!isset($_SESSION['ADMIN']) && !isset($_SESSION['USER'])) {
//     header("Location: ../../index.php");
//     exit;
// } 

// ubaceno da nakon dodatog reviewa vrati na taj recept

if ($_POST['recipe_id']) {
    $id = $_POST['recipe_id'];
$query = "SELECT * FROM recipes WHERE recipe_id = $id";
$result = mysqli_query($connect, $query);
$row = mysqli_fetch_assoc($result);

$id = $row['recipe_id'];


}
// ^


if ($_POST) {

   $recipe = $_POST['recipe_id'];          // povezano sa user/details poslednji deo <select class="form-select" name="rating , recipe_id, user_id (ista imena ovde <--)
   $rating = $_POST['rating'];
   $user = $_POST['user_id']; 
   $message = $_POST['message'];
   
    

    $sql = "INSERT INTO recipe_reviews (fk_recipe_id, rating, fk_user_id, message) 
            VALUES ('$recipe', '$rating', '$user', '$message')";



    if (mysqli_query($connect, $sql) === true) {
        $class = "";
        $message = "<h1 style='text-align: center; margin-top: 39.5%;'>Thank you, your review has been successfully sent <br></h1>";
          
    } else {
        $class = "";
        $message = "<h1>Error while sending a review. Try again:</h1> <br>" . $connect->error;
    }
    mysqli_close($connect);
} else {
    header("location: ../error.php");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Tasty Food | Review</title>
    <link rel="stylesheet" href="../../css/style.css">
    <?php require_once '../../components/boot.php' ?>
</head>

<body class="bg-light">
    <div class="container">
        <div class="mt-3 mb-3">
        </div>
        <div class="alert alert-<?= $class; ?>" role="alert">
            <p><?= ($message) ?? ''; ?></p>
            <p><?= ($uploadError) ?? ''; ?></p>
            <a href='../details.php?id=<?= $id ?>'><button class="btn-create-recipe" type='button'>Done</button></a>
        </div>
    </div>
</body>
</html>