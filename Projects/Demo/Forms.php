<?php
  if($_SERVER["REQUEST_METHOD"] === "POST"){
    $email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
    echo "The email is: " . $email;
  }
?>

<html>
  <body>
    <h1>Please submit the form</h1>
    <form method="POST">
      <label for="email">Email: </label>
      <input type="email" name="email" id="email" required/>
      <button>Submit</button>
    </form>
  </body>
</html>