<?php
session_start();

require_once '../components/db_connect.php';

if (isset($_SESSION['USER'])) {
    header("Location: ../user/index_user.php");
    exit;
}

if (!isset($_SESSION['ADMIN']) && !isset($_SESSION['USER'])) {
    header("Location: ../login.php");
    exit;
}


require_once '../components/file_upload.php';

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
    

} else {
    header("location: ../error.php");
}
    mysqli_close($connect);
// } else {
// header("location: ../error.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <?php require_once '../components/boot.php'?>
    <title>Tasty Food | Admin | Update Planner</title>
</head>
<body class="bg-light">
    <fieldset>
        <legend class="h2">(Admin) Update Planner: <img class='img-thumbnail rounded-circle' src='../images/<?= $picture ?>'></legend>
        <form class="" action="actions/a_update_planner.php" method="post" enctype="multipart/form-data">
            <table class="table">
            <tr>
                    <th>Day of the Week</th>
                <td><select class="form-select" name="day" aria-label="Default select example">
                    <option value='select'>Choose:</option>
                    
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
                    <th>Availability</th>
                    <td><select class="form-select" name="availability" aria-label="Default select example">
                        <option value="<?= $availability ?>"><?= $availability ?></option>
                        <option value='available'>Available</option>
                        <option value='unavailable'>Unavailable</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <th>Meal Date</th>
                    <td><input class="form-control" type="date" name="meal_date" placeholder="Meal Date" value="<?= $meal_date ?>"/></td>
                </tr>
                <tr>
                    <th>Meal Time</th>
                    <td><input class="form-control" type="time" name="meal_time" placeholder="Meal Time" value="<?= $meal_time ?>"/></td>
                </tr>
                <tr>

                <tr class="">
                    <input type="hidden" name="id" value="<?= $data['planner_id'] ?>"/>
                    <td><button class="btn btn-success" type="submit"> Save Changes </button></td>
                    <td><a href="planner_admin.php"><button class="btn btn-dark" type="button">Back to Admin Meal Planner</button></a></td>
                    <td><a class="btn btn-danger" href="delete_planner_admin.php?id=<?= $data['planner_id'] ?>">Delete Planner</a></td>
                </tr>
                
            </table>
        </form>
    </fieldset>
</body>
</html>