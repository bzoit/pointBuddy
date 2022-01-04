<?php
    header('Content-Type: application/json; charset=utf-8');
    require_once('config.php');
    $name = $_POST["name"];
    $data = searchData($name, $link);
    echo json_encode($data);
?>