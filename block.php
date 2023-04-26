<?php
session_start();

require_once 'components/db_connect.php';

if (isset($_SESSION['ADMIN'])) {
    header('Location: admin/index_admin.php');
    exit;
}

if (!isset($_SESSION['ADMIN']) && !isset($_SESSION['USER'])) {
    header('Location: login.php');
    exit;
}


$query = "SELECT * FROM users WHERE user_id = {$_SESSION['USER']}";
$result = mysqli_query($connect, $query);
$row = mysqli_fetch_assoc($result);

$id = $row['user_id'];
$username = $row['username'];
$photo = $row['photo'];

mysqli_close($connect);

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
    <title>Tasty Food | BLOCKED</title>
</head>
<body style="background-color: #b92500;">
    <div id="blocked">
<div>
    <h1 id="blocked_h1">Hi "<?= $username ?>",<br><br> your account has been blocked! </h1>

    <h2><a id="blocked_h2" href="logout.php?logout"> Ok </a></h2>
</div>
    </div>
<?php require_once "navbar/bottom_footer_user_planner.php"?>

</body>
</html>
