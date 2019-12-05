<?php

define("MAIN_APP_RUN", true);
require_once("library.php");

$login_attempt = null;
if (isset($_POST["login"])) {
    $login_attempt = loginUser($_POST["username"], $_POST["password"]);
    $message = $login_attempt["message"];
    if(!$login_attempt["success"]) {
      echo "<script type='text/javascript'>window.onload = function() { alert('$message');</script>";
    }
}

if(!checkSession()) {
  ob_start();
  header("Location: finalLandingPage.php");
  ob_flush();
  die();
}

if (isset($_POST["request_meeting"])) {
    echo requestMeeting($_POST["meeting_time"], $_POST["meeting_location"]);
} else if (isset($_POST["submitLocations"])) {
    echo addLocationPreferences($locations);
} else if (isset($_POST["submitTimes"])) {
    echo addTimePreferences($days);
} elseif (isset($_POST["send_message"])) {
    echo sendMessage($_POST["chat_info"]);
}

$message_data = loadMessages();
if(!$message_data["success"]) {
  $message = $message_data["message"];
  //echo "<script type='text/javascript'>window.onload = function() { alert('$message'); };</script>";
}
$message_data = $message_data["data"]

?>

<!DOCTYPE html>
<html>
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../homePage/homepage.css">
    <title>Collude.IT</title>
  </head>
  <body>

  	<header class="navbar navbar-expand-sm navbar-light">
  	  <a class="navbar-brand" href="#" >
        <img src="../res/logo2.png" width="60" height="50" class="d-inline-block align-top" alt="">
      </a>

      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarMenu">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarMenu">
        <ul class="navbar-nav">
          <li class="nav-item"><a class="nav-link" href="#">Home</a></li>
          <li class="nav-item"><a class="nav-link" href="../profilePage/profilePage.html">Profile</a></li>
        </ul>
      </div>
      <form method="POST" action="finalLandingPage.php">
        <input type="submit" class="headerMenuLink d-inline-block border border-gray-dark rounded-1 px-2 py-1" name="log_out" value="Log Out">
      </form>
    </header>

  	<div class="container col-lg-12 d-inline-block" id="mainBody">
      <div class="row">
        <div class="col-lg-4 nopadding" id = "sideWindow">
          <div class = "sideBar nopadding">
            <!-- ------------------------------Inside Side Bar Here Please-----------------------------------------  -->
            <aside class="verticalNavBar">
              <ul class="tabs nopadding">
                <li id="profileIcon"><a href="../profilePage/profilePage.html"><img class="icon nopadding" alt="account" src="../res/account.jpg"></a></li>
                <li id="timeIcon"><img class="icon nopadding" alt="time" src="../res/clock.png"></li>
                <li id="locationIcon"><img class="icon nopadding" alt="location" src="../res/ping.png"></li>
                <li id="calendarIcon"><img class="icon nopadding" alt="calendar" src="../res/calendar.png"></li>
              </ul>
            </aside>
            <div class="notificationBar">
              <div class="notif-item notifs nopadding" id="notifBar">
                Notifications
              </div>
            </div>
            <div class="expand-close nopadding">
              <div class="arrow nopadding" alt="time">&lt;</div>
              <div class="arrow nopadding" alt="time">&lt;</div>
              <div class="arrow nopadding" alt="time">&lt;</div>
            </div>
            <div class="content" id="sideBarContent">select tab to display content here</div>
          </div>
        </div>

        <div class="col-lg-8 no-gutters nopadding" id = "contentBar">
          <div class= "chatBox">
            <?php
            foreach($message_data as $m) {
              echo "<div class='message'>" . $m["name"] . ": " . $m["message"] . "</div>";
            }
            ?>
            <!-- ------------------------------Insert Chat Menu Here Please-----------------------------------------  -->
          </div>
          <div class = "messageBox nopadding">
              <textarea id = "userMessage" placeholder = "Type your message here" cols = "100" rows = "3"></textarea>

              <button id = "messageSend">Send</button>
          </div>
        </div>

      </div>
    </div>

    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="../HomePage/homePage.js"></script>
  </body>
</html>