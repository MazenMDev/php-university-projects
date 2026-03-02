<?php

  session_start();
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    setcookie("username", $username, time() + 3600); // Cookie expires in 1 hour
    $_SESSION["user"] = $username; // Store username in session
  }

  $hasCookie = isset($_COOKIE['username']);
  if(!$hasCookie) {
    $welcomeMessage = "Welcome, new user!";
  } else {
    $welcomeMessage = "Welcome back, " . htmlspecialchars($_COOKIE['username']) . "!";
  }

  if (!isset($_SESSION["visits"])) {
    $_SESSION["visits"] = 1;
  } else {
    $_SESSION["visits"]++;
  }

  $visitMessage = "You have visited this page " . $_SESSION["visits"] . " times.";
?>


<html>
  <body>
    <?php if(!$hasCookie) { ?>
      <form method="POST">
        <label for="username">Enter your name: </label>
        <input type="text" name="username" id="username" required/>
        <button>Submit</button>
      </form>
    <?php } ?>
    <h1><?=  $welcomeMessage ?></h1>
    <p><?= $visitMessage ?></p> 
  </body>
</html>

