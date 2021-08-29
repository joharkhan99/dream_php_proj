<?php include "functions.php" ?>
<?php
if (isset($_POST['email']) && isset($_POST['password']) && !empty($_POST['email']) && !empty($_POST['password'])) {

  $email = sanitize($_POST['email']);
  $password = sanitize($_POST['password']);

  if (empty($email) || empty($password)) {
    echo "Please Fill All Fields0";
  } elseif (!loginUser($email, $password)) {
    echo "Invalid Email or Password0";
  }
} else {
  echo "Please Fill All Fields0";
}
