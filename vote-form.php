<?php
    session_start();
    $currentUser = $_SESSION['username'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="vote.css">
    <meta charset="UTF-8">
    <title>GA Lower School PointBuddy | Points Voting Form</title>
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
    <div class="wrapper">
        <h2 class="title">Points Voting Form</h2>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
          <label id="clabel" for="class">Which class are you in? </label>
          <select id="class" name="class">
            <option value="5G">5G</option> <!-- 5th Grade Class 1 -->
            <option value="5V">5V</option> <!-- 5th Grade Class 2 -->
            <option value="5L">5L</option> <!-- 5th Grade Class 3 -->
            <option value="5W">5W</option> <!-- 5th Grade Class 4 -->
            <option value="4B">4B</option> <!-- 4th Grade Class 1 -->
            <option value="4N">4N</option> <!-- 4th Grade Class 2 -->
            <option value="4R">4R</option> <!-- 4th Grade Class 3 -->
          </select>
          </br><label id="glabel" for="grade">Which grade are you in? </label>
          <select id="grade" name="grade">
              <option value="5">5th Grade</option>
              <option value="4">4th Grade</option>
          </select></br>
          <input type="submit" id="submit">
        </form>
        <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                require_once "config.php";
                $currentUser = $_SESSION['username'];
                $type = $_SESSION['type'];
                $grade = $_POST['grade'];
                $class = $_POST['class'];
                $result = $link->query('SELECT ID FROM polls ORDER BY ID DESC LIMIT 1;');
                $max_public_id = array();
                if (mysqli_num_rows($result) > 0) {
                   $max_public_id = mysqli_fetch_row($result);
                } else {
                    $max_public_id[0] = 0;
                }
                $max_public_id = $max_public_id[0];
                $max_public_id = $max_public_id+1;
                $sql = "INSERT INTO polls VALUES ('$currentUser', '$type', $max_public_id, '$class', '$grade')";
                $link->query($sql);
            }
        ?>
        <p id="disclaimer">*If any of the information above is incorrect, your vote won't count and will be discarded.</p>
    </div>
</body>
</html>