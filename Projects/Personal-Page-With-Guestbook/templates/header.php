<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Personal Page</title>
  <link rel="stylesheet" href="/css/style.css?v=<?= filemtime(__DIR__ . '/../public/css/style.css'); ?>" />
</head>
<body>
  <header class="site-header">
    <div class="container">
      <h1>Welcome</h1>
    </div>
  </header>
  <nav class="site-nav">
    <div class="container">
      <a href="./">Home</a>
      <a href="/contact">Contact</a>
      <a href="/guestbook">Guestbook</a>
    </div>
  </nav>
  <main class="container">
    <?php require_once('_flash.php'); ?>
