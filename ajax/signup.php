<?php include "functions.php" ?>
<?php
if (!IsEmptyString($_POST['email']) && !IsEmptyString($_POST['full_name']) && !IsEmptyString($_POST['password']) && !IsEmptyString($_POST['confirm_password']) && !IsEmptyString($_POST['about']) && (file_exists($_FILES['image']['tmp_name']) || is_uploaded_file($_FILES['image']['tmp_name']))) {

  $email = sanitize($_POST['email']);
  $password = sanitize($_POST['password']);
  $confirm_password = sanitize($_POST['confirm_password']);
  $about = sanitize($_POST['about']);
  $name = sanitize($_POST['full_name']);

  if (strlen($password) < 8) {
    echo "Password length should be atleast 8 characters0";
  } elseif ($password != $confirm_password) {
    echo "Passwords do not match0";
  } elseif (emailExists($email)) {
    echo "Email already taken. Try another one0";
  } else {

    // profile image
    $target_dir = "../users/";
    $target_file = $target_dir . uniqid() . basename($_FILES["image"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    $check = getimagesize($_FILES["image"]["tmp_name"]);
    if ($check !== false) {

      if ($_FILES["image"]["size"] > 5242880) {
        echo "Maximum profile image size: 5mbs0";
        $uploadOk = 0;
        exit();
      } elseif (
        $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif"
      ) {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed0";
        $uploadOk = 0;
        exit();
      } else {
        $uploadOk = 1;
      }
    } else {
      echo "Profile file is not an image0";
      $uploadOk = 0;
      exit();
    }

    if ($uploadOk == 0) {
      echo " Sorry, your file was not uploaded0";
      exit();
    } else {
      if (!move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
        echo "Sorry, there was an error uploading your profile image0";
        exit();
      } else {
        $image = str_replace("../users/", "", $target_file);

        if (AddUser($name, $email, $password, $about, $image)) {
          echo "Account Created Succefully!";
        } else {
          echo "Error creating account!";
        }
      }
    }
    // profile image
  }














  // 
} else {
  echo "Please provide complete details0";
}
