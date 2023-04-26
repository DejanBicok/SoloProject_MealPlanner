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

$class = 'd-none';
if ($_GET['id']) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM recipe_reviews WHERE review_id = {$id}";
    $result = mysqli_query($connect, $sql);
    $data = mysqli_fetch_assoc($result);
    if (mysqli_num_rows($result) == 1) {

        $review = $data['review_id'];
        $rating = $data['rating'];
    }
}
//the POST method will delete the rating permanently
if ($_POST) {
    $id = $_POST['id'];
    $sql = "DELETE FROM recipe_reviews WHERE review_id = {$id}";
    if ($connect->query($sql) === TRUE) {
        $class = "alert alert-success";
        $message = "Rating Successfully Deleted!";
        header("refresh:1;url=index_admin.php");
    } else {
        $class = "alert alert-danger";
        $message = "The rating was not deleted due to: <br>" . $connect->error;
    }
}

mysqli_close($connect);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tasty Food | Admin | Delete Review</title>
    <link rel="stylesheet" href="css/style.css">
    <?php require_once '../components/boot.php'?>
    <style type="text/css">
        fieldset {
            margin: auto;
            margin-top: 100px;
            width: 70%;
        }

        .img-thumbnail {
            width: 70px !important;
            height: 70px !important;
        }
    </style>
</head>

<body class="bg-light">
    <div class="<?php echo $class; ?>" role="alert">
        <p><?php echo ($message) ?? ''; ?></p>
    </div>
    <fieldset>
        <legend class='h2 mb-3'>Delete review request</legend>
        <h5>You have selected the review below:</h5>
        <table class="table w-75 mt-3">
            <tr>
                <td><?php echo "$review" ?></td>
            </tr>
            <tr>
                <td><?php echo "$rating" ?>⭐</td>
            </tr>
        </table>
        <h3 class="mb-4">Do you really want to delete this review?</h3>
        <form method="post">
            <input type="hidden" name="id" value="<?php echo $id ?>" />
            <button class="btn btn-danger" type="submit">Yes, delete it.</button>
            <a href="reviews.php"><button class="btn btn-warning" type="button">No, go back.</button></a>
        </form>
    </fieldset>
</body>
</html>