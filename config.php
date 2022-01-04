<?php
define('DB_SERVER', '192.168.0.140'); // MySQL IP
define('DB_USERNAME', 'wilsont'); // MySQL Username
define('DB_PASSWORD', 'B0zzMan137!'); // MySQL Password
define('DB_NAME', 'pointSystem'); // MySQL Schema

$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
function searchData($name, $link) {
    $query = "SELECT username from students WHERE username LIKE '%$name%'";
    $result = $link -> query($query);
    $data = $result->fetch_all(MYSQLI_ASSOC);
    return $data;
}
?>