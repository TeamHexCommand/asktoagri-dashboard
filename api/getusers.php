<?php

require_once '../includes/database.php';

// if($_SERVER['HTTP_REFERER'] !== $_SERVER['BASE_HOST']){
//     die('Unauthorized access');
// }

$data = [];

$id = 0;

$query = "SELECT SQL_NO_CACHE id,mobile,isExpert,createdAt FROM `hc_user` ORDER BY `id` DESC LIMIT 50;";

if(isset($_GET["id"]) && $_GET["id"] != 0) {
    $id = $_GET["id"];
    $query = "SELECT SQL_NO_CACHE id,mobile,isExpert,createdAt FROM `hc_user` WHERE `id` < {$id} ORDER BY `id` DESC LIMIT 50;";
}

if($result = $con->query($query)) {
    $row = mysqli_fetch_all($result, MYSQLI_ASSOC);
    $data["users"] = $row;
}

$data["host"] = $_SERVER['HTTP_REFERER'];

header("Content-Type: application/json; charset=UTF-8");

echo json_encode($data, true);

?>