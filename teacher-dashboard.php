<?php
session_start();
require_once "config.php";
$currentUser = $_SESSION['username'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="dashboard.css">
    <meta charset="UTF-8">
    <title>GA Lower School PointBuddy | Teacher Dashboard</title>
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
<div class="send">
    <table class="send-names">
      <tr id="tr1">
      </tr>
      <tr id="tr2">
      </tr>
    </table>
    <form method="post" action="search.php">
        <p id="errsucc"></p>
        <input name="names" placeholder="Enter usernames here..." type="text" id="names" oninput=search(this.value)>
        <ul id="dataViewer">
        </ul>
    </form>
    <form class="send-form" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <input placeholder="Enter points here..." type="text" id="points">
        <div class="send_button" onclick=sendFunction()>
            <p id="send_text" type="submit">Send</p>
            <img id="send_img" src="https://img.icons8.com/external-kmg-design-outline-color-kmg-design/32/000000/external-send-user-interface-kmg-design-outline-color-kmg-design.png" alt="send"/>
        </div>
    </form>
</div>
<div class="lookup">
    <p id="balanceName"></p>
    <p class="lookup-balance"></p>
    <form class="lookup-form" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <input placeholder="Enter username here..." type="text" id="search" oninput=search2(this.value)>
        <ul id="dataViewer2">
        </ul>
    </form>
    <p id="lookupTitle">Points Search</p>
</div>

<script>
function search(name) {
    console.log(name);
    fetchSearchData(name);
}

function search2(name) {
    console.log(name);
    fetchSearchData2(name);
}

function fetchSearchData(name) {
    fetch('search.php', {
        method: 'POST',
        body: new URLSearchParams('name=' + name)
    }).then(res => res.json()).then(res => viewSearchResult(res)).catch(e => console.error('Error: ' + e))
}

function fetchSearchData2(name) {
    fetch('search.php', {
        method: 'POST',
        body: new URLSearchParams('name=' + name)
    }).then(res => res.json()).then(res => viewSearchResult2(res)).catch(e => console.error('Error: ' + e))
}

function viewSearchResult(data) {
    const dataViewer = document.getElementById("dataViewer");
    dataViewer.innerHTML = "";
    if (data.length !== 0) {
        for (let i = 0; i <= data.length; i++) {
            const li = document.createElement("li");
            li.innerHTML = data[i].username;
            li.id = data[i].username;
            li.addEventListener("click", () => {
                liOnClick(data[i].username);
            });
            dataViewer.appendChild(li);
        }
    }
    if (dataViewer.childElementCount > 10) {
        dataViewer.removeChild(dataViewer.childNodes[9]);
    }
}

function viewSearchResult2(data) {
    const dataViewer = document.getElementById("dataViewer2");
    dataViewer.innerHTML = "";
    if (data.length !== 0) {
        for (let i = 0; i <= data.length; i++) {
            const li = document.createElement("li");
            li.innerHTML = data[i].username;
            li.id = data[i].username;
            li.addEventListener("click", () => {
                liOnClick2(data[i].username);
            });
            dataViewer.appendChild(li);
        }
    }
    if (dataViewer.childElementCount > 10) {
        dataViewer.removeChild(dataViewer.childNodes[9]);
    }
}


function sendFunction() {
    const errsucc = document.getElementById("errsucc");
    let recipients = [];
    const td = document.getElementsByTagName("td");
    for (let i = 0; i < td.length; i++) {
        recipients.push(td[i].innerHTML);
    }
    recipients = recipients.toString();
    recipients = recipients.replace(",", " ");
    const points = document.getElementById("points").value;
    const isNum = /^\d+$/.test(points);
    if (isNum === false && recipients.length === 0) {
        errsucc.style = "color: red;";
        errsucc.innerHTML = "* Please enter a valid integer and recipients.";
    } else if (isNum === false) {
        errsucc.style = "color: red;";
        errsucc.innerHTML = "* Please enter a valid integer.";
    } else if (recipients.length === 0) {
        errsucc.style = "color: red;";
        errsucc.innerHTML = "* Please enter valid recipients.";
    } else {
        const xhttp = new XMLHttpRequest();
        xhttp.open("GET", "ajaxinterceptor.php?p="+points+"&r="+recipients);
        xhttp.send();
        errsucc.style = "color: green;";
        errsucc.innerHTML = "Points sent succesfully.";
    }
}

function liOnClick(name) {
    const tr1 = document.getElementById("tr1");
    const tr2 = document.getElementById("tr2");
    const td = document.createElement("td");
    if(tr1.childElementCount < 3) {
        td.innerHTML = name;
        td.addEventListener("click", () => {
            td.remove();
        })
        tr1.appendChild(td);
    } else if (tr2.childElementCount < 3) {
        td.innerHTML = name;
        td.addEventListener("click", () => {
            td.remove();
        })
        tr2.appendChild(td);
    } else {
        console.log("Maximum recipients have been reached.");
    }
}

function liOnClick2(name) {
    const nameOutput = document.getElementById("balanceName")
    nameOutput.innerHTML = name;
    const output = document.getElementsByClassName("lookup-balance");
    fetch('balance-search.php', {
        method: 'POST',
        body: new URLSearchParams('u=' + name)
    }).then(res => res.text()).then(
        res => output[0].innerHTML = `Balance: ${res} Points`
    ).catch(e => console.error('Error: ' + e))
}
</script>
</body>
</html>