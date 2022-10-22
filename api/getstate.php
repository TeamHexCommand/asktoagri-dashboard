<?php

require_once '../includes/database.php';

$data = [];
$state = [];

if($result = $con->query("SELECT SQL_NO_CACHE MONTHNAME(`createdAt`) monthName,count(*) as total FROM `hc_user` WHERE YEAR(`createdAt`) = YEAR(now()) GROUP BY MONTH(`createdAt`);")) {
    $row = mysqli_fetch_all($result, MYSQLI_ASSOC);
    $data["state"]["users"]["all"] = $row;
}

if($result = $con->query("SELECT SQL_NO_CACHE MONTHNAME(`createdAt`) monthName,count(*) as total FROM `hc_user` WHERE YEAR(`createdAt`) = YEAR(now()) AND `isExpert` = 0 GROUP BY MONTH(`createdAt`);")) {
    $row = mysqli_fetch_all($result, MYSQLI_ASSOC);
    $data["state"]["users"]["farmer"] = $row;
}

if($result = $con->query("SELECT SQL_NO_CACHE MONTHNAME(`createdAt`) monthName,count(*) as total FROM `hc_user` WHERE YEAR(`createdAt`) = YEAR(now()) AND `isExpert` = 1 GROUP BY MONTH(`createdAt`);")) {
    $row = mysqli_fetch_all($result, MYSQLI_ASSOC);
    $data["state"]["users"]["expert"] = $row;
}

if($result = $con->query("SELECT SQL_NO_CACHE MONTHNAME(`createdAt`) monthName,count(*) as total FROM `hc_user` WHERE YEAR(`createdAt`) = YEAR(now()) AND `isAdmin` = 1 GROUP BY MONTH(`createdAt`);")) {
    $row = mysqli_fetch_all($result, MYSQLI_ASSOC);
    $data["state"]["users"]["admin"] = $row;
}

if($result = $con->query("SELECT SQL_NO_CACHE MONTHNAME(`createdAt`) monthName,count(*) as total FROM `hc_query` WHERE YEAR(`createdAt`) = YEAR(now()) GROUP BY MONTH(`createdAt`);")) {
    $row = mysqli_fetch_all($result, MYSQLI_ASSOC);
    $data["state"]["query"]["all"]["time"] = $row;
}

if($result = $con->query("SELECT SQL_NO_CACHE c.name as category,count(*) as total FROM `hc_query` as h INNER JOIN `hc_category` as c ON c.id = h.category GROUP BY c.name;")) {
    $row = mysqli_fetch_all($result, MYSQLI_ASSOC);
    $data["state"]["query"]["all"]["category"] = $row;
}

if($result = $con->query("SELECT SQL_NO_CACHE c.name as crops,count(*) as total FROM `hc_query` as h INNER JOIN `hc_crops` as c ON c.id = h.crops GROUP BY c.name;")) {
    $row = mysqli_fetch_all($result, MYSQLI_ASSOC);
    $data["state"]["query"]["all"]["crops"] = $row;
}

if($result = $con->query("SELECT SQL_NO_CACHE c.name as category,count(*) as total FROM `hc_query` as h INNER JOIN `hc_category` as c ON c.id = h.category WHERE h.resolved = 0 GROUP BY c.name;")) {
    $row = mysqli_fetch_all($result, MYSQLI_ASSOC);
    $data["state"]["query"]["pending"]["category"] = $row;
}

if($result = $con->query("SELECT SQL_NO_CACHE c.name as crops,count(*) as total FROM `hc_query` as h INNER JOIN `hc_crops` as c ON c.id = h.crops WHERE h.resolved = 0 GROUP BY c.name;")) {
    $row = mysqli_fetch_all($result, MYSQLI_ASSOC);
    $data["state"]["query"]["pending"]["crops"] = $row;
}

if($result = $con->query("SELECT SQL_NO_CACHE MONTHNAME(`createdAt`) monthName,count(*) as total FROM `hc_query` WHERE YEAR(`createdAt`) = YEAR(now()) AND `resolved` = 0 GROUP BY MONTH(`createdAt`);")) {
    $row = mysqli_fetch_all($result, MYSQLI_ASSOC);
    $data["state"]["query"]["pending"]["time"] = $row;
}

if($result = $con->query("SELECT SQL_NO_CACHE c.name as category,count(*) as total FROM `hc_query` as h INNER JOIN `hc_category` as c ON c.id = h.category WHERE h.resolved = 1 GROUP BY c.name;")) {
    $row = mysqli_fetch_all($result, MYSQLI_ASSOC);
    $data["state"]["query"]["resolved"]["category"] = $row;
}

if($result = $con->query("SELECT SQL_NO_CACHE c.name as crops,count(*) as total FROM `hc_query` as h INNER JOIN `hc_crops` as c ON c.id = h.crops WHERE h.resolved = 1 GROUP BY c.name;")) {
    $row = mysqli_fetch_all($result, MYSQLI_ASSOC);
    $data["state"]["query"]["resolved"]["crops"] = $row;
}

if($result = $con->query("SELECT SQL_NO_CACHE MONTHNAME(`createdAt`) monthName,count(*) as total FROM `hc_query` WHERE YEAR(`createdAt`) = YEAR(now()) AND `resolved` = 1 GROUP BY MONTH(`createdAt`);")) {
    $row = mysqli_fetch_all($result, MYSQLI_ASSOC);
    $data["state"]["query"]["resolved"]["time"] = $row;
}

if($result = $con->query("SELECT SQL_NO_CACHE c.name as crops,count(*) as total FROM `hc_solution` as h INNER JOIN `hc_crops` as c ON c.id = h.crops GROUP BY c.name;")) {
    $row = mysqli_fetch_all($result, MYSQLI_ASSOC);
    $data["state"]["solution"]["all"]["crops"] = $row;
}

if($result = $con->query("SELECT SQL_NO_CACHE c.name as category,count(*) as total FROM `hc_solution` as h INNER JOIN `hc_category` as c ON c.id = h.category GROUP BY c.name;")) {
    $row = mysqli_fetch_all($result, MYSQLI_ASSOC);
    $data["state"]["solution"]["all"]["category"] = $row;
}

if($result = $con->query("SELECT SQL_NO_CACHE MONTHNAME(`createdAt`) monthName,count(*) as total FROM `hc_solution` WHERE YEAR(`createdAt`) = YEAR(now()) GROUP BY MONTH(`createdAt`);")) {
    $row = mysqli_fetch_all($result, MYSQLI_ASSOC);
    $data["state"]["solution"]["all"]["time"] = $row;
}

if($result = $con->query("SELECT SQL_NO_CACHE c.name as category,count(*) as total FROM `hc_solution` as h INNER JOIN `hc_category` as c ON c.id = h.category WHERE h.common = 1 GROUP BY c.name;")) {
    $row = mysqli_fetch_all($result, MYSQLI_ASSOC);
    $data["state"]["solution"]["common"]["category"] = $row;
}

if($result = $con->query("SELECT SQL_NO_CACHE c.name as crops,count(*) as total FROM `hc_solution` as h INNER JOIN `hc_crops` as c ON c.id = h.crops WHERE h.common = 1 GROUP BY c.name;")) {
    $row = mysqli_fetch_all($result, MYSQLI_ASSOC);
    $data["state"]["solution"]["common"]["crops"] = $row;
}

if($result = $con->query("SELECT SQL_NO_CACHE MONTHNAME(`createdAt`) monthName,count(*) as total FROM `hc_solution` WHERE YEAR(`createdAt`) = YEAR(now()) AND `common` = 1 GROUP BY MONTH(`createdAt`);")) {
    $row = mysqli_fetch_all($result, MYSQLI_ASSOC);
    $data["state"]["solution"]["common"]["time"] = $row;
}

if($result = $con->query("SELECT SQL_NO_CACHE c.name as category,count(*) as total FROM `hc_solution` as h INNER JOIN `hc_category` as c ON c.id = h.category WHERE h.common = 0 GROUP BY c.name;")) {
    $row = mysqli_fetch_all($result, MYSQLI_ASSOC);
    $data["state"]["solution"]["uncommon"]["category"] = $row;
}

if($result = $con->query("SELECT SQL_NO_CACHE c.name as crops,count(*) as total FROM `hc_solution` as h INNER JOIN `hc_crops` as c ON c.id = h.crops WHERE h.common = 0 GROUP BY c.name;")) {
    $row = mysqli_fetch_all($result, MYSQLI_ASSOC);
    $data["state"]["solution"]["uncommon"]["crops"] = $row;
}

if($result = $con->query("SELECT SQL_NO_CACHE MONTHNAME(`createdAt`) monthName,count(*) as total FROM `hc_solution` WHERE YEAR(`createdAt`) = YEAR(now()) AND `common` = 0 GROUP BY MONTH(`createdAt`);")) {
    $row = mysqli_fetch_all($result, MYSQLI_ASSOC);
    $data["state"]["solution"]["uncommon"]["time"] = $row;
}



header("Content-Type: application/json; charset=UTF-8");

echo json_encode($data, true);

?>