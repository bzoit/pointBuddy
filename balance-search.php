<?php
    require_once("config.php");
    $username = $_POST["u"];
    $balance;
    $sql = "SELECT balance FROM students WHERE username = '$username'";
    if ($result = $link -> query($sql)) {
        $balance = $result -> fetch_row()[0];
        $result -> free_result();
    }
    echo $balance;
?>