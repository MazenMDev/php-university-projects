<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>My Blog</title>
  <link rel="stylesheet" href="/css/style.css?v=<?= filemtime(__DIR__ . '/../public/css/style.css'); ?>" />
</head>
<body>
  <header class="site-header">
    <div class="container">
      <h1>My Blog</h1>
    </div>
  </header>
  <nav class="site-nav">
    <div class="container">
      <a href="./">Home</a>
      <a href="/posts">Posts</a>
    </div>
  </nav>
  <main class="container">
    <?= $content ?>
  </main>

  <footer>
    <div class="container">
      <p>&copy; <?= date('Y') ?> My Blog. All rights reserved.</p>
    </div>
  </footer>
</body>
</html>