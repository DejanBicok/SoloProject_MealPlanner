<?php
session_start();

require_once 'components/db_connect.php';

if (isset($_SESSION['USER'])) {
    header("Location: user/home_user.php");
    exit;
}

if (isset($_SESSION['ADMIN'])) {
    header("Location: admin/index_admin.php");
    exit;
}

$error = false;
$email = $password = $emailError = $passwordError = '';

if (isset($_POST['login'])) {

    $email = trim($_POST['email']);
    $email = strip_tags($email);
    $email = htmlspecialchars($email);

    $password = trim($_POST['password']);
    $password = strip_tags($password);
    $password = htmlspecialchars($password);

if (empty($email)) {
    $error = true;
    $emailError = "Please enter your Email address.";
}

if (empty($password)) {
    $error = true;
    $passwordError = "Please enter your password.";
}

if (!$error) {

    $password = hash('sha256', $password);

    $sql = "SELECT user_id, status, password FROM users WHERE email = '$email'";
    $result = mysqli_query($connect, $sql);
    $row = mysqli_fetch_assoc($result);
    $count = mysqli_num_rows($result);
if ($count == 1 && $row['password'] == $password) {
if ($row['status'] == 'ADMIN') {
    $_SESSION['ADMIN'] = $row['user_id'];
    header("Location: admin/index_admin.php");
} if ($row['status'] == 'USER'){
    $_SESSION['USER'] = $row['user_id'];
    header("Location: user/home_user.php");
}
} else {
    $errMSG = "Incorrect, please try again!";
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
    <link rel="stylesheet" href="css/style.css">
    <?php require_once 'components/boot.php'?>
    <?php require_once 'navbar/nav_login.php'?>
    <?php require_once 'navbar/main_footer.php'?>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <title>Tasty Food | Log in</title>
</head>
<body class='bg-light'>
    
<div class="container mt-4 mb-5">
<form class="cont1 container border rounded rounded-3 p-4 w-50 mb-5" style="" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" autocomplete="off">

<h1 class="log"> Log in </h1>
<p>You must be logged in to continue.</p>
<?php 
if (isset($errMSG)){
    echo $errMSG;
}
?>

<div>
    <input class="username-button" type="text" name="email" placeholder="Email Address" value="<?= $email;?>" maxlength="50"/>
    <span class="text-danger"><?= $emailError;?></span>
<hr>
    <input class="password-button" type="password" name="password" placeholder="Password" maxlength="20"/>
    <span class="text-danger"><?= $passwordError;?></span>
<hr>
    <button class="login-button" type="submit" name="login">Log in</button>
<br>
<br>
    <a class="" href="register.php">New to Tasty Food? Register now</a>
</div>
</div>
</form>
<?php require_once "navbar/bottom_footer.php"?>

</body>
</html>