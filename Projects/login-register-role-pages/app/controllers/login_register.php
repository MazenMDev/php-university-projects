<?php
  session_start(); // start the session
  require_once __DIR__ . "/../../config/config.php"; // require to connect to config

  // if the button is register
  if(isset($_POST["register"])){ 
    $name = $_POST["name"]; // take the name from user
    $email = $_POST["email"]; // take the email 
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);
    $role = $_POST["role"];

    $check_email = $conn->prepare("SELECT email FROM users WHERE email = ?"); // prepare the sql to select email
    $check_email->bind_param("s", $email); 
    $check_email->execute();
    $check_email_result = $check_email->get_result();

    if($check_email_result->num_rows > 0){
      $_SESSION["register_error"] = "Email already exists.";
      $_SESSION["active_form"] = "register";
    }else{
      $insert_user = $conn->prepare("INSERT INTO users (name, email, password, role) VALUES (?, ?, ?, ?)");
      $insert_user->bind_param("ssss", $name, $email, $password, $role);
      $insert_user->execute();
    }
    header("Location: ../../public/index.php");
    exit();
  }

  if(isset($_POST["login"])){
    $email = $_POST["email"];
    $password = $_POST["password"];
    
    $result = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $result->bind_param("s", $email);
    $result->execute();
    $user_result = $result->get_result();
    
    if($user_result->num_rows > 0){
      $user = $user_result->fetch_assoc();
      if(password_verify($password, $user["password"])){
        $_SESSION['name'] = $user['name'];
        $_SESSION['email'] = $user['email'];

        if($user['role'] === 'admin'){
          header('Location: ../../public/admin_page.php');
        }else{
          header('Location: ../../public/user_page.php');
        }
        exit();  
      }
    }
    
    $_SESSION['login_error'] = 'Incorrect email or password';
    $_SESSION['active_form'] = 'login';
    header('Location: ../../public/index.php');
    exit();
  }

?>