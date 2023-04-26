<?php
session_start();

require_once 'components/db_connect.php';

$userinfo = mysqli_query($connect, "SELECT * FROM users WHERE user_id = {$_SESSION['USER']}");
$info = mysqli_fetch_array($userinfo, MYSQLI_ASSOC);

if ($info['user_block'] == 'blocked') {
    header('Location: block.php');
    exit;
}

if (isset($_SESSION['ADMIN'])) {
    header("Location: admin/index_admin.php");
    exit;
}

if (!isset($_SESSION['ADMIN']) && !isset($_SESSION['USER'])) {
    header("Location: login.php");
    exit;
}


require_once 'components/file_upload.php';

// ubaceno zbog prof pic 

$query = "SELECT * FROM users WHERE user_id={$_SESSION['USER']}";
$result = mysqli_query($connect, $query);
$row = mysqli_fetch_assoc($result);

$id = $row['user_id'];
$username = $row['username'];
$first_name = $row['first_name'];
$last_name = $row['last_name'];
$email = $row['email'];
$photo = $row['photo'];
$status = $row['status'];

// ^


if ($_GET['planner_id']) {
    $id = $_GET['planner_id'];
    $sql = "SELECT * FROM meal_planner WHERE planner_id = {$id}";
    $result = mysqli_query($connect, $sql);
if (mysqli_num_rows($result) == 1) {
$data = mysqli_fetch_assoc($result);
    
    $availability = $data['availability'];
    $day = $data['day'];
    $meal_date = $data['meal_date'];
    $meal_time = $data['meal_time'];
    $picture = $data['picture'];                      /* da izvuce picture iz baze i prikaze*/

    }
}

$class = 'd-none';
if (isset($_POST["submit"])) {
    $availability = $_POST['availability'];
    $day = $_POST['day'];
    $meal_date = $_POST['meal_date'];
    $meal_time = $_POST['meal_time'];

$sql = "UPDATE meal_planner SET availability = '$availability', day = '$day', meal_date = '$meal_date', meal_time = '$meal_time' WHERE planner_id = {$id}";

if (mysqli_query($connect, $sql) === true) {
    $class = "success";
    $message = "The Planner has been successfully updated.";


} else {
    header("location: ../error.php");
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
    <?php require_once 'navbar/nav_planner.php'?>
    <?php require_once 'navbar/footer_planner.php'?>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Tasty Food | Meal Update</title>
</head>

<body class="bg-light">
<h1 class="h1" style="color: #7D8F69"> Update your meal plan </h1>
<div class="container-upd-planner border rounded-3 p-4 w-50 mt-4 mb-5">

    <fieldset class="upd-planner-field">
        <legend class="h2" style="margin-left: 35.5%"><img class='img-thumbnail rounded-circle' src='images/<?= $picture ?>'></legend>
        <form class="" action="user/actions/a_update_planner.php" method="post" enctype="multipart/form-data">
            <table class="table">
                <tr>
                    <th>Day of the Week</th>
                <td><select class="day-of-the-week-upd" name="day" aria-label="Default select example">
                    <option value="<?= $day ?>">Choose:</option>
                    
                    <option value='Monday'>Monday</option>
                    <option value='Tuesday'>Tuesday</option>
                    <option value='Wednesday'>Wednesday</option>
                    <option value='Thursday'>Thursday</option>
                    <option value='Friday'>Friday</option>
                    <option value='Saturday'>Saturday</option>
                    <option value='Sunday'>Sunday</option>
                </select>
                </td>
                </tr>

             
                <tr>
                    <th>Meal Date</th>
                    <td><input class="day-of-the-week-upd" type="date" name="meal_date" placeholder="Meal Date" value="<?= $meal_date ?>"/></td>
                </tr>
                <tr>
                    <th>Meal Time</th>
                    <td><input class="day-of-the-week-upd" type="time" name="meal_time" placeholder="Meal Time" value="<?= $meal_time ?>"/></td>
                </tr>

                
                
            </table>
            <tr class="">
                    <input type="hidden" name="id" value="<?= $data['planner_id'] ?>"/>
                    <td><button class="planner_edit_btn" style="margin-left: 0%; margin-top: 15% !important; width: 32.9%;"type="submit"> Save Changes </button></td>
                    <td><a href="planner.php"><button class="planner_back_btn" style="width: 28%; margin-top: 15% !important; float: right;" type="button">Back</button></a></td>
            </tr>
        </form>
    </fieldset>
</div>
       <?php require_once "navbar/bottom_footer_user_planner.php"?>
</body>
</html>