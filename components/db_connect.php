<?php

$localhost = "173.212.235.205";
$username = "dejancodefactory_admin";
$password = "dejanadmin1!";
$dbname = "dejancodefactory_meal_planner";

// create connection
$connect = new mysqli($localhost, $username, $password, $dbname);

// check connection
if ($connect->connect_error) {
    die("Connection failed: " . $connect->connect_error);
// }else{
//     echo "Successfully Connected";
}