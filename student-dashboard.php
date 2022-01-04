<?php
session_start();
require_once "config.php";
$currentUser = $_SESSION['username'];
$dates = array();
$balance;
$sql = "SELECT balance FROM students WHERE username = '$currentUser'";
if ($result = $link -> query($sql)) {
  $balance = $result -> fetch_row()[0];
  $result -> free_result();
}
$sql = "SELECT date FROM transactions WHERE receiver = '$currentUser'";
if ($result = $link -> query($sql)) {
  while ($row = $result -> fetch_row()) {
    array_push($dates, $row[0]);
  }
  $result -> free_result();
}
$dates = array_reverse($dates);
$size = count($dates);
for ($i = 0; $i < $size; $i++) {
	$dates[$i] .= ":";
}
if (count($dates) < 9) {
    $difference = 9 - count($dates);
    $i = 0;
    while ($i <= $difference) {
        array_push($dates, " ");
        $i++;
    }
}
$senders = array();
$sql = "SELECT sender FROM transactions WHERE receiver = '$currentUser'";
if ($result = $link -> query($sql)) {
    while ($row = $result -> fetch_row()) {
      array_push($senders, $row[0]);
    }
  $result -> free_result();
}
$senders = array_reverse($senders);
if (count($senders) < 9) {
    $difference = 9 - count($senders);
    $i = 0;
    while ($i <= $difference) {
        array_push($senders, " ");
        $i++;
    }
}
$numbers = array();
$colors = array();
$sql = "SELECT number FROM transactions WHERE receiver = '$currentUser'";
if ($result = $link -> query($sql)) {
    while ($row = $result -> fetch_row()) {
      array_push($numbers, $row[0]);
    }
  $result -> free_result();
}
$numbers = array_reverse($numbers);
$i = 0;
while ($i <= count($numbers)-1) {
    if (str_contains($numbers[$i], '-')) {
        array_push($colors, "red");
    } else if (str_contains($numbers[$i], '+')) {
        array_push($colors, "green");
    }
    $i++;
}
if (count($numbers) < 9) {
    $difference = 9 - count($numbers);
    $i = 0;
    while ($i <= $difference) {
        array_push($numbers, " ");
        $i++;
    }
}

$tomorrowUnix = strtotime("+1 day");
$tomorrowDate = date("m/d/Y", $tomorrowUnix);

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
function email ($option, $user, $balance, $tomorrow) {
    require 'includes/PHPMailer.php';
    require 'includes/SMTP.php';
    require 'includes/Exception.php';

    $mail = new PHPMailer();
    $mail->isSMTP();
    $mail->Host = "smtp.gmail.com";
    $mail->SMTPAuth = true;
    $mail->SMTPSecure = "tls";
    $mail->Port = "587";
    $mail->Username = "gapointbuddy@gmail.com"; // PointBuddy System Email
    $mail->Password = "gapatriots1760"; // PointBuddy System Email Password
    $mail->Subject = "$user Point Redemption";
    $mail->setFrom('gapointbuddy@gmail.com'); // PointBuddy System Email
    $mail->isHTML(true);
    $mail->Body = "<p>Student Username: $user</p></br><p>Prize Selected: $option</p></br><p>Student's Current Balance: $balance Points</p></br></br></br>Expires On $tomorrow";
    $mail->addAddress("$user@germantownacademy.org");

    if ($mail->send()) {
    	echo "Points Redeemed";
    } else {
    	echo "Points couldn't be redeemed! Please try again later.";
    }
    $mail->smtpClose();
}

if(isset($_POST['sticker'])) {
    $balance;
    $sql = "SELECT balance FROM students WHERE username = '$currentUser'";
    if ($result = $link -> query($sql)) {
      $balance = $result -> fetch_row()[0];
      $result -> free_result();
    }
    if($balance - 5 >= 0) {
         $newBalance = $balance - 5;
         $sql = "UPDATE students SET balance = $newBalance WHERE username = '$currentUser'";
         $link -> query($sql);
         $todayUnix = strtotime("now");
         $today = date("m/d/Y", $todayUnix);
         $sql = "INSERT INTO transactions VALUES ('$currentUser', '$currentUser', '$today', '-5')";
         $link -> query($sql);
         email('Sticker', $currentUser, $balance, $tomorrowDate);
    }
    header('location: redirect.php');
    exit;
}
if(isset($_POST['jrancher'])) {
    $balance;
    $sql = "SELECT balance FROM students WHERE username = '$currentUser'";
    if ($result = $link -> query($sql)) {
      $balance = $result -> fetch_row()[0];
      $result -> free_result();
    }
    if($balance - 10 >= 0) {
         $newBalance = $balance - 10;
         $sql = "UPDATE students SET balance = $newBalance WHERE username = '$currentUser'";
         $link -> query($sql);
         $todayUnix = strtotime("now");
         $today = date("m/d/Y", $todayUnix);
         $sql = "INSERT INTO transactions VALUES ('$currentUser', '$currentUser', '$today', '-10')";
         $link -> query($sql);
         email('Jolly Rancher', $currentUser, $balance, $tomorrowDate);
    }
    header('location: redirect.php');
    exit;
}
if(isset($_POST['tencmg'])) {
    $balance;
    $sql = "SELECT balance FROM students WHERE username = '$currentUser'";
    if ($result = $link -> query($sql)) {
      $balance = $result -> fetch_row()[0];
      $result -> free_result();
    }
    if($balance - 10 >= 0) {
         $newBalance = $balance - 10;
         $sql = "UPDATE students SET balance = $newBalance WHERE username = '$currentUser'";
         $link -> query($sql);
         $todayUnix = strtotime("now");
         $today = date("m/d/Y", $todayUnix);
         $sql = "INSERT INTO transactions VALUES ('$currentUser', '$currentUser', '$today', '-10')";
         $link -> query($sql);
         email('10 Minutes on CoolMathGames', $currentUser, $balance, $tomorrowDate);
    }
    header('location: redirect.php');
    exit;
}
if(isset($_POST['fifteencmg'])) {
    $balance;
    $sql = "SELECT balance FROM students WHERE username = '$currentUser'";
    if ($result = $link -> query($sql)) {
      $balance = $result -> fetch_row()[0];
      $result -> free_result();
    }
    if($balance - 15 >= 0) {
         $newBalance = $balance - 15;
         $sql = "UPDATE students SET balance = $newBalance WHERE username = '$currentUser'";
         $link -> query($sql);
         $todayUnix = strtotime("now");
         $today = date("m/d/Y", $todayUnix);
         $sql = "INSERT INTO transactions VALUES ('$currentUser', '$currentUser', '$today', '-15')";
         $link -> query($sql);
         email('15 Minutes on CoolMathGames', $currentUser, $balance, $tomorrowDate);
    }
    header('location: redirect.php');
    exit;
}
if(isset($_POST['onehmwrk'])) {
    $balance;
    $sql = "SELECT balance FROM students WHERE username = '$currentUser'";
    if ($result = $link -> query($sql)) {
      $balance = $result -> fetch_row()[0];
      $result -> free_result();
    }
    if($balance - 30 >= 0) {
        $newBalance = $balance - 30;
        $sql = "UPDATE students SET balance = $newBalance WHERE username = '$currentUser'";
        $link -> query($sql);
        $todayUnix = strtotime("now");
        $today = date("m/d/Y", $todayUnix);
        $sql = "INSERT INTO transactions VALUES ('$currentUser', '$currentUser', '$today', '-30')";
        $link -> query($sql);
        email("Don't Have To Do 1 Homework Assignment", $currentUser, $balance, $tomorrowDate);
    }
    header('location: redirect.php');
    exit;
}
if(isset($_POST['twohmwrk'])) {
    $balance;
    $sql = "SELECT balance FROM students WHERE username = '$currentUser'";
    if ($result = $link -> query($sql)) {
      $balance = $result -> fetch_row()[0];
      $result -> free_result();
    }
    if($balance - 40 >= 0) {
         $newBalance = $balance - 40;
         $sql = "UPDATE students SET balance = $newBalance WHERE username = '$currentUser'";
         $link -> query($sql);
         $todayUnix = strtotime("now");
         $today = date("m/d/Y", $todayUnix);
         $sql = "INSERT INTO transactions VALUES ('$currentUser', '$currentUser', '$today', '-40')";
         $link -> query($sql);
         email("Don't Have To Do Any Homework For 1 Day", $currentUser, $balance, $tomorrowDate);
    }
    header('location: redirect.php');
    exit;
}
if(isset($_POST['classfive'])) {
    $balance;
    $sql = "SELECT balance FROM students WHERE username = '$currentUser'";
    if ($result = $link -> query($sql)) {
      $balance = $result -> fetch_row()[0];
      $result -> free_result();
    }
    if($balance - 50 < 0) {
        echo "You don't have enough points!";
    } else {
        $newBalance = $balance - 50;
        $sql = "UPDATE students SET balance = $newBalance WHERE username = '$currentUser'";
        $link -> query($sql);
        $todayUnix = strtotime("now");
        $today = date("m/d/Y", $todayUnix);
        $sql = "INSERT INTO transactions VALUES ('$currentUser', '$currentUser', '$today', '-50')";
        $link -> query($sql);
        $_SESSION["type"] = 'classfive';
        header("location: vote-form.php");
        exit;
    }
}

if(isset($_POST['gradefour'])) {
    $balance;
    $sql = "SELECT balance FROM students WHERE username = '$currentUser'";
    if ($result = $link -> query($sql)) {
      $balance = $result -> fetch_row()[0];
      $result -> free_result();
    }
    if($balance - 40 < 0) {
        echo "You don't have enough points!";
    } else {
        $newBalance = $balance - 40;
        $sql = "UPDATE students SET balance = $newBalance WHERE username = '$currentUser'";
        $link -> query($sql);
        $todayUnix = strtotime("now");
        $today = date("m/d/Y", $todayUnix);
        $sql = "INSERT INTO transactions VALUES ('$currentUser', '$currentUser', '$today', '-40')";
        $link -> query($sql);
        $_SESSION["type"] = 'gradefour';
        header("location: vote-form.php");
        exit;
    }
}

if(isset($_POST['gradeff'])) {
    $balance;
    $sql = "SELECT balance FROM students WHERE username = '$currentUser'";
    if ($result = $link -> query($sql)) {
      $balance = $result -> fetch_row()[0];
      $result -> free_result();
    }
    if ($balance - 55 < 0) {
        echo "You don't have enough points!";
    } else {
        $newBalance = $balance - 55;
        $sql = "UPDATE students SET balance = $newBalance WHERE username = '$currentUser'";
        $link -> query($sql);
        $todayUnix = strtotime("now");
        $today = date("m/d/Y", $todayUnix);
        $sql = "INSERT INTO transactions VALUES ('$currentUser', '$currentUser', '$today', '-55')";
        $link -> query($sql);
        $_SESSION["type"] = 'gradeff';
        header("location: vote-form.php");
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="dashboard.css">
    <meta charset="UTF-8">
    <title>GA Lower School PointBuddy | Student Dashboard</title>
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin="">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200&amp;display=swap" rel="stylesheet">
    <style>
        body {
            overflow: hidden;
            font-family: "Poppins", sans-serif;
        }
    </style>
</head>
<body>
<a href="logout.php">
    <button class="logout">Logout</button>
</a>
<h1 class="welcome">Hello, <?php echo $currentUser?></h1>
<h2 class="t">Transactions</h2>
<h2 class="b">Balance</h2>
<h2 class="p">Prizes</h2>
<div class="transactions">
    <div class="text">
        <h2 style="color: <?php echo $colors[0]?>"><?php echo $dates[0]?> <?php echo $senders[0]?> <?php echo $numbers[0]?></h2>
        <h2 style="color: <?php echo $colors[1]?>"><?php echo $dates[1]?> <?php echo $senders[1]?> <?php echo $numbers[1]?></h2>
        <h2 style="color: <?php echo $colors[2]?>"><?php echo $dates[2]?> <?php echo $senders[2]?> <?php echo $numbers[2]?></h2>
        <h2 style="color: <?php echo $colors[3]?>"><?php echo $dates[3]?> <?php echo $senders[3]?> <?php echo $numbers[3]?></h2>
        <h2 style="color: <?php echo $colors[4]?>"><?php echo $dates[4]?> <?php echo $senders[4]?> <?php echo $numbers[4]?></h2>
        <h2 style="color: <?php echo $colors[5]?>"><?php echo $dates[5]?> <?php echo $senders[5]?> <?php echo $numbers[5]?></h2>
        <h2 style="color: <?php echo $colors[6]?>"><?php echo $dates[6]?> <?php echo $senders[6]?> <?php echo $numbers[6]?></h2>
        <h2 style="color: <?php echo $colors[7]?>"><?php echo $dates[7]?> <?php echo $senders[7]?> <?php echo $numbers[7]?></h2>
        <h2 style="color: <?php echo $colors[8]?>"><?php echo $dates[8]?> <?php echo $senders[8]?> <?php echo $numbers[8]?></h2>
        <h2 style="color: <?php echo $colors[9]?>"><?php echo $dates[9]?> <?php echo $senders[9]?> <?php echo $numbers[9]?></h2>
    </div>
</div>
<div class="balance">
    <h2 class="points"><?php echo $balance?> Points</h2>
</div>
<div class="store">
    <form method="post">
        <ul>
            <li>
                <input type="submit" class="sticker" name="sticker" value="5 Points - Sticker"/>
            </li>
            <li>
                <input class="jrancher" type="submit" name="jrancher" value="10 Points - 1 Jolly Rancher"/>
            </li>
            <li>
                <input type="submit" class="tencmg" name="tencmg" value="10 Points - 10 Minutes on CoolMathGames"/>
            </li>
            <li>
                <input type="submit" name="fifteencmg" value="15 Points - 15 Minutes on CoolMathGames" class="fifteencmg"/>
            </li>
            <li>
                <input type="submit" name="onehmwrk" value="30 Points - Don't Have To Do 1 Assignment" class="onehmwrk"/>
            </li>
            <li>
                <input type="submit" name="twohmwrk" value="40 Points - Don't Have To Do Any Homework For 1 Day" class="twohmwrk"/>
            </li>
            <li>
                <input type="submit" name="classfive" value="2/3 of Students In Class 50 Points - 10 Extra Recess Minutes For Class" class="classfive"/>
            </li>
            <li>
                <input type="submit" name="gradefour" value="2/3 of Grade 40 Points - 15 Extra Recess Minutes For Grade" class="classfive"/>
            </li>
            <li>
                <input type="submit" name="gradeff" value="2/3 of Grade 55 Points - Extra Dessert Day" class="gradeff"/>
            </li>
        </ul>
    </form>
    <p class="vote">If you select a prize involving multiple people to have points, a vote will be sent to a poll. Then, if the entire class or 2/3 of the grade (depending on the prize) vote for it, the amount of points for the prize will be taken from each voter's account, and you will get the prize.</p>
</div>
</body>
</html>