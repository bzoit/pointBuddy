<?php
    require_once "config.php";
    function email ($option, $class, $teacher) {
        require 'includes/PHPMailer.php';
        require 'includes/SMTP.php';
        require 'includes/Exception.php';

        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = "smtp.gmail.com";
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = "tls";
        $mail->Port = "587";
        $mail->Username = "wilsonswolfpack@gmail.com"; // PointBuddy System Email
        $mail->Password = "B0zzMan137!"; // PointBuddy System Email Password
        $mail->Subject = "$class Point Redemption";
        $mail->setFrom('wilsonswolfpack@gmail.com'); // PointBuddy System Email
        $mail->isHTML(true);
        $mail->Body = "<p>Prize Selected: $option</p></br><p>For Homeroom: $class</p>";
        $mail->addAddress("wilsontheobald9@gmail.com"); // Sue's Email
        $mail->addAddress("$teacher@germantownacademy.org");

        $mail->send();
        $mail->smtpClose();
    }
    function email5 ($option, $teacher1, $teacher2, $teacher3, $teacher4) {
        require 'includes/PHPMailer.php';
        require 'includes/SMTP.php';
        require 'includes/Exception.php';

        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = "smtp.gmail.com";
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = "tls";
        $mail->Port = "587";
        $mail->Username = "wilsonswolfpack@gmail.com"; // PointBuddy System Email
        $mail->Password = "B0zzMan137!"; // PointBuddy System Email Password
        $mail->Subject = "5th Grade Point Redemption";
        $mail->setFrom('wilsonswolfpack@gmail.com'); // PointBuddy System Email
        $mail->isHTML(true);
        $mail->Body = "<p>Prize Selected: $option</p></br><p>For Grade: 5th</p>";
        $mail->addAddress("wilsontheobald9@gmail.com"); // Sue's Email
        $mail->addAddress("$teacher1@germantownacademy.org");
        $mail->addAddress("$teacher2@germantownacademy.org");
        $mail->addAddress("$teacher3@germantownacademy.org");
        $mail->addAddress("$teacher4@germantownacademy.org");

        $mail->send();
        $mail->smtpClose();
    }
    function email4 ($option, $teacher1, $teacher2, $teacher3) {
        require 'includes/PHPMailer.php';
        require 'includes/SMTP.php';
        require 'includes/Exception.php';

        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = "smtp.gmail.com";
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = "tls";
        $mail->Port = "587";
        $mail->Username = "wilsonswolfpack@gmail.com"; // PointBuddy System Email
        $mail->Password = "B0zzMan137!"; // PointBuddy System Email Password
        $mail->Subject = "4th Grade Point Redemption";
        $mail->setFrom('wilsonswolfpack@gmail.com'); // PointBuddy System Email
        $mail->isHTML(true);
        $mail->Body = "<p>Prize Selected: $option</p></br><p>For Grade: 4th</p>";
        $mail->addAddress("wilsontheobald9@gmail.com"); // Sue's Email
        $mail->addAddress("$teacher1@germantownacademy.org");
        $mail->addAddress("$teacher2@germantownacademy.org");
        $mail->addAddress("$teacher3@germantownacademy.org");

        $mail->send();
        $mail->smtpClose();
    }
    $sql = "SELECT username from polls WHERE type='classfive' and class='5G'";
    $temp = array();
    if ($result = $link -> query($sql)) {
      while ($row = $result -> fetch_row()) {
        array_push($temp, $row[0]);
      }
      $result -> free_result();
    }
    array_unique($temp);
    $fgClassVotes = count($temp);
    if($fgClassVotes == 12)  {   // 12 = 3/4 of 5G Students
        email('10 Extra Recess Minutes for Class', '5G', 'wtheo29'); // wtheo29 = Mr. Martin's Email Name
        $link -> query("DELETE FROM polls WHERE class='5G' and type='classfive'");
    } else {
        $i = 0;
        while ($i <= $fgClassVotes) {
            $todayUnix = strtotime("now");
            $today = date("m/d/Y", $todayUnix);
            $sql = "INSERT INTO transactions VALUES ('$temp[$i]', 'system', '$today', '+50')";
            $link -> query($sql);
            $balance;
            $sql = "SELECT balance from students WHERE username='$temp[$i]'";
            if ($result = $link -> query($sql)) {
              $balance = $result -> fetch_row()[0];
              $result -> free_result();
            }
            $newBalance = $balance + 50;
            $sql = "UPDATE students SET balance = $newBalance WHERE username = '$temp[$i]'";
            $link -> query($sql);
        }
    }
    $sql = "SELECT username from polls WHERE type='classfive' and class='5L'";
    $temp = array();
    if ($result = $link -> query($sql)) {
      while ($row = $result -> fetch_row()) {
        array_push($temp, $row[0]);
      }
      $result -> free_result();
    }
    array_unique($temp);
    $fgClassVotes = count($temp);
    if($fgClassVotes == 12) {    // 12 = 3/4 of 5L Students
        email('10 Extra Recess Minutes for Class', '5L', 'wtheo29');  // wtheo29 = Ms. Legos' Email Name
        $link -> query("DELETE FROM polls WHERE class='5L' and type='classfive'");
    } else {
        $i = 0;
        while ($i <= $fgClassVotes) {
            $todayUnix = strtotime("now");
            $today = date("m/d/Y", $todayUnix);
            $sql = "INSERT INTO transactions VALUES ('$temp[$i]', 'system', '$today', '+50')";
            $link -> query($sql);
            $balance;
            $sql = "SELECT balance from students WHERE username='$temp[$i]'";
            if ($result = $link -> query($sql)) {
              $balance = $result -> fetch_row()[0];
              $result -> free_result();
            }
            $newBalance = $balance + 50;
            $sql = "UPDATE students SET balance = $newBalance WHERE username = '$temp[$i]'";
            $link -> query($sql);
        }
    }
    $sql = "SELECT username from polls WHERE type='classfive' and class='5V'";
    $temp = array();
    if ($result = $link -> query($sql)) {
      while ($row = $result -> fetch_row()) {
        array_push($temp, $row[0]);
      }
      $result -> free_result();
    }
    array_unique($temp);
    $fgClassVotes = count($temp);
    if($fgClassVotes == 12) {   // 12 = 3/4 of 5V Students
        email('10 Extra Recess Minutes for Class', '5V', 'wtheo29'); // wtheo29 = Ms. Vanin's Email Name
        $link -> query("DELETE FROM polls WHERE class='5V' and type='classfive'");
    } else {
        $i = 0;
        while ($i <= $fgClassVotes) {
            $todayUnix = strtotime("now");
            $today = date("m/d/Y", $todayUnix);
            $sql = "INSERT INTO transactions VALUES ('$temp[$i]', 'system', '$today', '+50')";
            $link -> query($sql);
            $balance;
            $sql = "SELECT balance from students WHERE username='$temp[$i]'";
            if ($result = $link -> query($sql)) {
              $balance = $result -> fetch_row()[0];
              $result -> free_result();
            }
            $newBalance = $balance + 50;
            $sql = "UPDATE students SET balance = $newBalance WHERE username = '$temp[$i]'";
            $link -> query($sql);
        }
    }
    $sql = "SELECT username from polls WHERE type='classfive' and class='5W'";
    $temp = array();
    if ($result = $link -> query($sql)) {
      while ($row = $result -> fetch_row()) {
        array_push($temp, $row[0]);
      }
      $result -> free_result();
    }
    array_unique($temp);
    $fgClassVotes = count($temp);
    if($fgClassVotes == 12) {   // 12 = 2/4 of 5W Students
        email('10 Extra Recess Minutes for Class', '5W', 'wtheo29'); // wtheo29 = Mr. Wetzel's Email Name
        $link -> query("DELETE FROM polls WHERE class='5W' and type='classfive'");
    } else {
        $i = 0;
        while ($i <= $fgClassVotes) {
            $todayUnix = strtotime("now");
            $today = date("m/d/Y", $todayUnix);
            $sql = "INSERT INTO transactions VALUES ('$temp[$i]', 'system', '$today', '+50')";
            $link -> query($sql);
            $balance;
            $sql = "SELECT balance from students WHERE username='$temp[$i]'";
            if ($result = $link -> query($sql)) {
              $balance = $result -> fetch_row()[0];
              $result -> free_result();
            }
            $newBalance = $balance + 50;
            $sql = "UPDATE students SET balance = $newBalance WHERE username = '$temp[$i]'";
            $link -> query($sql);
        }
    }
    $sql = "SELECT username from polls WHERE type='classfive' and class='4N'";
    $temp = array();
    if ($result = $link -> query($sql)) {
      while ($row = $result -> fetch_row()) {
        array_push($temp, $row[0]);
      }
      $result -> free_result();
    }
    array_unique($temp);
    $fgClassVotes = count($temp);
    if($fgClassVotes == 12) {   // 12 = 2/4 of 4N Students
        email('10 Extra Recess Minutes for Class', '4N', 'wtheo29'); // wtheo29 = Mr. Nagel's Email Name
        $link -> query("DELETE FROM polls WHERE class='4N' and type='classfive'");
    } else {
        $i = 0;
        while ($i <= $fgClassVotes) {
            $todayUnix = strtotime("now");
            $today = date("m/d/Y", $todayUnix);
            $sql = "INSERT INTO transactions VALUES ('$temp[$i]', 'system', '$today', '+50')";
            $link -> query($sql);
            $balance;
            $sql = "SELECT balance from students WHERE username='$temp[$i]'";
            if ($result = $link -> query($sql)) {
              $balance = $result -> fetch_row()[0];
              $result -> free_result();
            }
            $newBalance = $balance + 50;
            $sql = "UPDATE students SET balance = $newBalance WHERE username = '$temp[$i]'";
            $link -> query($sql);
        }
    }
    $sql = "SELECT username from polls WHERE type='classfive' and class='4B'";
    $temp = array();
    if ($result = $link -> query($sql)) {
      while ($row = $result -> fetch_row()) {
        array_push($temp, $row[0]);
      }
      $result -> free_result();
    }
    array_unique($temp);
    $fgClassVotes = count($temp);
    if($fgClassVotes == 12) {  // 12 = 2/4 of 4N Students
        email('10 Extra Recess Minutes for Class', '4B', 'wtheo29'); // wtheo29 = Ms. Blumerich's Email Name
        $link -> query("DELETE FROM polls WHERE class='4B' and type='classfive'");
    } else {
        $i = 0;
        while ($i <= $fgClassVotes) {
            $todayUnix = strtotime("now");
            $today = date("m/d/Y", $todayUnix);
            $sql = "INSERT INTO transactions VALUES ('$temp[$i]', 'system', '$today', '+50')";
            $link -> query($sql);
            $balance;
            $sql = "SELECT balance from students WHERE username='$temp[$i]'";
            if ($result = $link -> query($sql)) {
              $balance = $result -> fetch_row()[0];
              $result -> free_result();
            }
            $newBalance = $balance + 50;
            $sql = "UPDATE students SET balance = $newBalance WHERE username = '$temp[$i]'";
            $link -> query($sql);
        }
    }
    $sql = "SELECT username from polls WHERE type='classfive' and class='4R'";
    $temp = array();
    if ($result = $link -> query($sql)) {
      while ($row = $result -> fetch_row()) {
        array_push($temp, $row[0]);
      }
      $result -> free_result();
    }
    array_unique($temp);
    $fgClassVotes = count($temp);
    if($fgClassVotes == 12) {   // 12 = 2/4 of 4N Students
        email('10 Extra Recess Minutes for Class', '4R', 'wtheo29'); // wtheo29 = Ms. Ro's Email Name
        $link -> query("DELETE FROM polls WHERE class='4R' and type='classfive'");
    } else {
        $i = 0;
        while ($i <= $fgClassVotes) {
            $todayUnix = strtotime("now");
            $today = date("m/d/Y", $todayUnix);
            $sql = "INSERT INTO transactions VALUES ('$temp[$i]', 'system', '$today', '+50')";
            $link -> query($sql);
            $balance;
            $sql = "SELECT balance from students WHERE username='$temp[$i]'";
            if ($result = $link -> query($sql)) {
              $balance = $result -> fetch_row()[0];
              $result -> free_result();
            }
            $newBalance = $balance + 50;
            $sql = "UPDATE students SET balance = $newBalance WHERE username = '$temp[$i]'";
            $link -> query($sql);
        }
    }



    $sql = "SELECT username from polls WHERE type='gradefour' and grade='5'";
    $temp = array();
    if ($result = $link -> query($sql)) {
      while ($row = $result -> fetch_row()) {
        array_push($temp, $row[0]);
      }
      $result -> free_result();
    }
    array_unique($temp);
    $fGradeVotes = count($temp);
    if($fGradeVotes == 52) {
        email5('15 Extra Recess Minutes for Grade', 't1', 't2', 't3', 't4'); // t1, t2, t3, t4 = The 4 5th Grade Teachers' Email Names
        $link -> query("DELETE FROM polls WHERE grade='5' and type='gradefour'");
    } else {
        $i = 0;
        while ($i <= $fGradeVotes) {
            $todayUnix = strtotime("now");
            $today = date("m/d/Y", $todayUnix);
            $sql = "INSERT INTO transactions VALUES ('$temp[$i]', 'system', '$today', '+40')";
            $link -> query($sql);
            $balance;
            $sql = "SELECT balance from students WHERE username='$temp[$i]'";
            if ($result = $link -> query($sql)) {
              $balance = $result -> fetch_row()[0];
              $result -> free_result();
            }
            $newBalance = $balance + 40;
            $sql = "UPDATE students SET balance = $newBalance WHERE username = '$temp[$i]'";
            $link -> query($sql);
        }
    }
    $sql = "SELECT username from polls WHERE type='gradefour' and grade='4'";
    $temp = array();
    if ($result = $link -> query($sql)) {
      while ($row = $result -> fetch_row()) {
        array_push($temp, $row[0]);
      }
      $result -> free_result();
    }
    array_unique($temp);
    $fGradeVotes = count($temp);
    if($fGradeVotes == 52) {
        email5('15 Extra Recess Minutes for Grade', 't1', 't2', 't3'); // t1, t2, t3 = The 3 4th Grade Teachers' Email Names
        $link -> query("DELETE FROM polls WHERE grade='4' and type='gradefour'");
    } else {
        $i = 0;
        while ($i <= $fGradeVotes) {
            $todayUnix = strtotime("now");
            $today = date("m/d/Y", $todayUnix);
            $sql = "INSERT INTO transactions VALUES ('$temp[$i]', 'system', '$today', '+40')";
            $link -> query($sql);
            $balance;
            $sql = "SELECT balance from students WHERE username='$temp[$i]'";
            if ($result = $link -> query($sql)) {
              $balance = $result -> fetch_row()[0];
              $result -> free_result();
            }
            $newBalance = $balance + 40;
            $sql = "UPDATE students SET balance = $newBalance WHERE username = '$temp[$i]'";
            $link -> query($sql);
        }
    }



    $sql = "SELECT username from polls WHERE type='gradeff' and grade='5'";
    $temp = array();
    if ($result = $link -> query($sql)) {
      while ($row = $result -> fetch_row()) {
        array_push($temp, $row[0]);
      }
      $result -> free_result();
    }
    array_unique($temp);
    $fGradeVotes = count($temp);
    if($fGradeVotes == 52) {
        email5('Extra Dessert Day', 't1', 't2', 't3', 't4'); // t1, t2, t3, t4 = The 4 5th Grade Teachers' Email Names
        $link -> query("DELETE FROM polls WHERE grade='5' and type='gradeff'");
    } else {
        $i = 0;
        while ($i <= $fGradeVotes) {
            $todayUnix = strtotime("now");
            $today = date("m/d/Y", $todayUnix);
            $sql = "INSERT INTO transactions VALUES ('$temp[$i]', 'system', '$today', '+40')";
            $link -> query($sql);
            $balance;
            $sql = "SELECT balance from students WHERE username='$temp[$i]'";
            if ($result = $link -> query($sql)) {
              $balance = $result -> fetch_row()[0];
              $result -> free_result();
            }
            $newBalance = $balance + 55;
            $sql = "UPDATE students SET balance = $newBalance WHERE username = '$temp[$i]'";
            $link -> query($sql);
        }
    }
    $sql = "SELECT username from polls WHERE type='gradeff' and grade='4'";
    $temp = array();
    if ($result = $link -> query($sql)) {
      while ($row = $result -> fetch_row()) {
        array_push($temp, $row[0]);
      }
      $result -> free_result();
    }
    array_unique($temp);
    $fGradeVotes = count($temp);
    if($fGradeVotes == 52) {
        email5('Extra Dessert Day', 't1', 't2', 't3'); // t1, t2, t3 = The 3 4th Grade Teachers' Email Names
        $link -> query("DELETE FROM polls WHERE grade='4' and type='gradeff'");
    } else {
        $i = 0;
        while ($i <= $fGradeVotes) {
            $todayUnix = strtotime("now");
            $today = date("m/d/Y", $todayUnix);
            $sql = "INSERT INTO transactions VALUES ('$temp[$i]', 'system', '$today', '+40')";
            $link -> query($sql);
            $balance;
            $sql = "SELECT balance from students WHERE username='$temp[$i]'";
            if ($result = $link -> query($sql)) {
              $balance = $result -> fetch_row()[0];
              $result -> free_result();
            }
            $newBalance = $balance + 55;
            $sql = "UPDATE students SET balance = $newBalance WHERE username = '$temp[$i]'";
            $link -> query($sql);
        }
    }
?>