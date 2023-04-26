<?php
session_start();

require_once '../components/db_connect.php';

if (isset($_SESSION['USER'])) {
    header("Location: ../user/index_user.php");
    exit;
} 

if (!isset($_SESSION['USER']) && !isset($_SESSION['ADMIN'])) {
    header("Location: ../login.php");
    exit;
}
//print products
$sql_reviews = "SELECT * FROM recipe_reviews WHERE fk_recipe_id";

$result_reviews = mysqli_query($connect, $sql_reviews);
$tbody = "";

if ($result_reviews->num_rows > 0) {
    while ($row = $result_reviews->fetch_array(MYSQLI_ASSOC)) {
       
                $tbody .= 
                "<tr>
                    <td>" . $row['fk_recipe_id'] ."</td>
                    <td>" . $row['fk_user_id'] ." </td>
                    <td>" . $row['rating'] ."🌟 </td>
                    <td>
                    <a href='delete_reviews.php?id=" . $row['review_id'] . "'><button class='planner_del_btn' style='width: 21%;' type='button'>Delete</button></a>
                    </td>
                 </tr>";
            }
        } else {
            $tbody = "<tr><td colspan='5'><center> No Reviews Available </center></td></tr>";
    }

mysqli_close($connect); 
        
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <?php require_once '../components/boot.php'?>
    <?php require_once '../navbar/nav_admin_second.php'?>
    <?php require_once '../navbar/adm_footer.php'?>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <title>Tasty Food | Recipe Reviews</title>
    
    <style type="text/css">
        .img-thumbnail {
            width: 70px !important;
            height: 70px !important;
        }

        td {
            text-align: center;
            vertical-align: middle;
        }

        tr {
            text-align: center;
        }

        .userImage {
            width: 100px;
            height: auto;
        }
        #back{
            display: block;
            margin: auto;
            margin-top: 2rem;
            margin-bottom: 2rem;
        }
    </style>
</head>

<body class="bg-light">
    <br>
    <br>
    <h1 class="text-center">Recipe Reviews</h1>
    <br>
    <br>

    <table class='table table-striped' style="margin-bottom: -5.5%;">
                    <thead class="">
                        <tr>
                            <th>Recipe ID</th>
                            <th>User ID</th>
                            <th>Rating</th>
                            <th>Options</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?= $tbody ?>
                    </tbody>
                </table>
     <a href="index_admin.php"><button style="margin-right: 12%; margin-top: 8%;" type="button" class="create_back_btn_cr" id="back">Back to Dashboard</button></a>
     <button id="BackToTop" class="Button WhiteButton Indicator" type="button"><a href="">Back to Top</button>
     <?php require_once "../navbar/bottom_footer_admin.php"?>

</body>
</html>