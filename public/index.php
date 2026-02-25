<?php
  session_start();
  $errors = [
    "login"=> $_SESSION['login_error'] ?? '',
    'register'=> $_SESSION['register_error'] ??''
  ];
  $activeForm = $_SESSION['active_form'] ?? 'login';

  session_unset();
  function showError($error) {
    return !empty($error) ? "<p class='error-message'>$error</p>" : '';
  }
  function isActiveForm($formName, $activeForm) {
    return $activeForm === $formName ? 'active' : '';
  }
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Form login & register</title>
    <link rel="stylesheet" href="../assets/css/style.css?v=<?= filemtime(__DIR__ . '/../assets/css/style.css'); ?>" />
  </head>
  <body>
    <div class="container">
      <div class="form-box <?= isActiveForm('login', $activeForm)  ?>" id="login-form">
        <form action="../app/controllers/login_register.php" method="post">
          <h2>Login</h2>
          <?= showError($errors['login']);?>
          <div class="input-box">
            <input type="email" name="email" placeholder="Email" required />
            <input
              type="password"
              name="password"
              placeholder="Password"
              required
            />
            <button type="submit" name="login">Login</button>
          </div>
          <p>
            If you don't have an account,
            <a href="#" id="register-btn">Register</a>
          </p>
        </form>
      </div>

      <div class="form-box  <?= isActiveForm('register', $activeForm) ?>" id="register-form">
        <form action="../app/controllers/login_register.php" method="post">
          <h2>Register</h2>
          <?= showError($errors['register']);?>
          <div class="input-box">
            <input type="text" name="name" placeholder="Name" required />
            <input type="email" name="email" placeholder="Email" required />
            <input
              type="password"
              name="password"
              placeholder="Password"
              required
            />
            <select name="role" id="role" required>
              <option value="">--Select Role--</option>
              <option value="user">User</option>
              <option value="admin">Admin</option>
            </select>
            <button type="submit" name="register">Register</button>
          </div>
          <p>
            If you already have an account, <a href="#" id="login-btn">Login</a>
          </p>
        </form>
      </div>
    </div>
    <script src="../assets/js/script.js"></script>
  </body>
</html>
