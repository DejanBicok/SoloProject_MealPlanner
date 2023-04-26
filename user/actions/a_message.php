<?php
session_start();

// if (isset($_SESSION['USER']) != "") {
//     header("Location: ../../index.php");
//     exit;
// }

// if (!isset($_SESSION['ADMIN']) && !isset($_SESSION['USER'])) {
//     header("Location: ../../login.php");
//     exit;
// }

require_once '../../components/db_connect.php';

if ($_POST) {
    $rowmessage = $_POST['message'];
    $fk_review_id = $_POST['fk_review_id'];
    $user = $_POST['fk_user_id'];
   
    $message = '';

    $sql = "INSERT INTO review_message (message, fk_review_id, fk_user_id) VALUES ('$rowmessage', '$fk_review_id', '$user')";

if (mysqli_query($connect, $sql) === true) {
    $class = "success";
    $message = "The review is successfully sent <br>";

}else{

    $class = "danger";
    $message = "Error while sending a message. Please try again: <br>" . $connect->error;
}
    mysqli_close($connect);

}else{
    header("Location: ../../error.php");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/style.css">
    <?php require_once '../../components/boot.php'?>
    <title>Tasty Food | Message Request</title>
</head>
<body class="bg-light">
    <div class="container">
        <div class="mt-3 mb-3">
        <h1> Message Request </h1>
        </div>
        <div class="alert alert-<?= $class; ?>" role="alert">
            <p><?= ($message) ?? ''; ?></p>
            <p><?= ($uploadError) ?? ''; ?></p>
            <a href='../index_user.php'><button class="btn btn-primary" type='button'> Dashboard</button></a>

        </div>
    </div>
</body>
</html>