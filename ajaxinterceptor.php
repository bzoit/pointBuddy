<?php
    require_once "config.php";
    $points = $_REQUEST["p"];
    $names = $_REQUEST["r"];

    $usernames = explode(' ', $names);
    $numStudents = count($usernames) - 1;

    for ($i = 0; $i <= $numStudents; $i++) {
        $currentUser = $usernames[$i];
        $balance;
        $sql = "SELECT balance FROM students WHERE username = '$currentUser'";
        if ($result = $link -> query($sql)) {
          $balance = $result -> fetch_row()[0];
          $result -> free_result();
        }
        $newBalance = intval($balance) + intval($points);
        $link -> query("UPDATE students SET balance = '$newBalance' WHERE username = '$currentUser'");
    }
?>