<?php
session_start();
// Check if the user is logged in and has the admin role
if(!isset(($_SESSION["email"]))){
  header("Location: index.php");
  exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>User page</title>
    <link rel="stylesheet" href="../assets/css/style.css?v=<?= filemtime(__DIR__ . '/../assets/css/style.css'); ?>" />
</head>
<body>
  <div class="box">
    <h1>Welcome, <span class="name"><?= $_SESSION["name"] ?></span> Page</h1>
    <p class="page-only">This is a <span>user-only</span> page.</p>
    <button onclick="window.location.href='logout.php'">Logout</button>
  </div>
</body>
</html>