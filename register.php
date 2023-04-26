<?php
session_start();

require_once 'components/db_connect.php';

if (isset($_SESSION['USER']) != "") {
    header("Location: index.php");
    exit;
}
if (isset($_SESSION['ADMIN']) != "") {
    header("Location: admin/index_admin.php");
    exit;
}

require_once 'components/file_upload.php';

$error = false;
$username = $first_name = $last_name = $password = $email = $photo = '';
$usernameError = $nameError = $passwordError = $emailError = $photoError = '';

if (isset($_POST['btn-signup'])) {

    $email = trim ($_POST['email']);
    $email = strip_tags ($email);
    $email = htmlspecialchars($email);

    $username = trim ($_POST['username']);
    $username = strip_tags ($username);
    $username = htmlspecialchars($username);

    $first_name = trim ($_POST['first_name']);
    $first_name = strip_tags ($first_name);
    $first_name = htmlspecialchars($first_name);
    
    $last_name = trim ($_POST['last_name']);
    $last_name = strip_tags ($last_name);
    $last_name = htmlspecialchars($last_name);

    $password = trim ($_POST['password']);
    $password = strip_tags ($password);
    $password = htmlspecialchars ($password);

    $uploadError = '';
    $photo = file_upload($_FILES['photo']);


//basic name validation

if (empty($first_name) || empty($last_name)) {
    $error = true;
    $nameError = "Please enter your full name.";
} elseif (strlen($first_name) < 3 || strlen($last_name) < 3) {
    $error = true;
    $nameError = "Name must have at least 3 characters.";
} elseif (!preg_match("/^[a-zA-Z]+$/", $first_name) || !preg_match("/^[a-zA-Z]+$/", $last_name)) {
    $error = true;
    $nameError = "Name must contain only letters.";
}


// basic email validation

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $error = true;
    $emailError = "Please enter a valid Email address.";
} else {
// checks whether the email exists or not
    $query = "SELECT email FROM users WHERE email='$email'";
    $result = mysqli_query($connect, $query);
    $count = mysqli_num_rows($result);
if ($count != 0) {
    $error = true;
    $emailError = "Email address is already in use.";
  }
}


// password validation

if (empty($password)) {
    $error = true;
    $passwordError = "Please enter your password.";
}elseif (strlen($password) < 7) {
    $error = true;
    $passwordError = "Password must have at least 7 characters.";
}

    $password = hash ('sha256', $password);

if (!$error) {
    $query = "INSERT INTO users (email, username, first_name, last_name, password, photo)
              VALUES('$email', '$username', '$first_name', '$last_name', '$password', '$photo->fileName')";
    $res = mysqli_query($connect, $query);

if ($res) {
    $errTyp = "success";
    $errMSG = "Successfully registered, you may log in now!";
    $uploadError = ($photo->error != 0) ? $photo->ErrorMessage : '';
}else{
    $errTyp = "danger";
    $errMSG = "Something went wrong, please try again.";
    $uploadError = ($photo->error != 0) ? $photo->ErrorMessage : '';
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
    <?php require_once 'navbar/nav_registration.php'?>
    <?php require_once 'navbar/main_footer.php'?>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Tasty Food | Registration</title>
</head>

<body class="bg-light">

    <div class="container-reg mt-4 mb-5">
    <form class="cont1-reg container border rounded-3 p-5 w-50" style="" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" autocomplete="off" enctype="multipart/form-data">

    <h1 class="reg">Registration</h1>

<?php
if (isset($errMSG)) {         /////////// ?????????????????????????????
?>
    <div class="alert alert-<?php echo $errTyp ?>">
    <p><?php echo $errMSG; ?></p>
    <p><?php echo $uploadError; ?></p>
    </div>

    <?php
    } ///////////////////////////////////////////// promeniti php tagove !
    ?>
<input class="email-reg" type="text" name="email" placeholder="Email Address" maxlenght="50" value="<?= $email ?>" />
    <span class="text-danger"><?= $emailError; ?> </span>
    <hr/>

<input class="username-button-reg" type="text" name="username" placeholder="Username" maxlenght="50" value="<?= $username ?>" />
    <span class="text-danger"><?= $usernameError; ?> </span>
    <hr/>

<input class="first-name-reg" type="text" name="first_name" placeholder="First Name" maxlenght="50" value="<?= $first_name ?>" />
    <span class="text-danger"><?= $nameError; ?> </span>
    <hr/>


<input class="last-name-reg" type="text" name="last_name" placeholder="Last Name" maxlenght="50" value="<?= $last_name ?>" />
    <span class="text-danger"><?= $nameError; ?> </span>
<hr/>

<input class="password-reg" type="password" name="password" placeholder="Password" maxlenght="20" value="<?= $password ?>" />
    <span class="text-danger"><?= $passwordError; ?> </span>

<hr/>
<input class="photo-reg" type="file" name="photo" />
    <span class="text-danger"><?= $photoError; ?> </span>
<hr/>

    <button class="register-button" type="submit" name="btn-signup">Register</button>
<br>
<br>
    <a href="login.php" class="">Already a user?<br>Log in</a>


            </form>
        </div>
<?php require_once "navbar/bottom_footer.php"?>

    </body>
</html>