<?php include "functions.php" ?>
<?php checkIfLogin(); ?>
<?php
if (!IsEmptyString($_POST['profile_name']) && !IsEmptyString($_POST['profile_bio'])) {

  $profile_name = sanitize($_POST['profile_name']);
  $profile_bio = sanitize($_POST['profile_bio']);
  $userkey = sanitize($_COOKIE['_uacct_']);

  if (!userKeyExists($userkey)) {
    header("Location:../logout.php");
    exit();
  }

  if ((@file_exists($_FILES['profile_image']['tmp_name']) || @is_uploaded_file($_FILES['profile_image']['tmp_name'])) && !empty($_FILES['profile_image'])) {
    // profile image
    $target_dir = "../users/";
    $target_file = $target_dir . uniqid() . basename($_FILES["profile_image"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    $check = getimagesize($_FILES["profile_image"]["tmp_name"]);
    if ($check !== false) {

      if ($_FILES["profile_image"]["size"] > 5242880) {
        echo "Maximum profile image size: 5mbs0_e_0";
        $uploadOk = 0;
        exit();
      } elseif (
        $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif"
      ) {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed0_e_0";
        $uploadOk = 0;
        exit();
      } else {
        $uploadOk = 1;
      }
    } else {
      echo "Profile file is not an image0_e_0";
      $uploadOk = 0;
      exit();
    }

    if ($uploadOk == 0) {
      echo " Sorry, your file was not uploaded0_e_0";
      exit();
    } else {
      $image = str_replace("../users/", "", $target_file);
      $previous_image = returnuserinfo($_COOKIE['_uacct_'], 'profile_pic');
      if (@UpdateProfile($userkey, $profile_name, $profile_bio, $image)) {
        if (!@move_uploaded_file($_FILES["profile_image"]["tmp_name"], $target_file)) {
          echo "Sorry, there was an error uploading your profile image0_e_0";
          exit();
        } else {
          if (unlink("../users/" . $previous_image))
            echo "Profile Updated Successfully!";
          else
            echo "Error updating profile0_e_0";
        }
      } else {
        echo "Error updating profile0_e_0";
      }
    }
    // profile image
  } else {
    if (UpdateProfile($userkey, $profile_name, $profile_bio)) {
      echo "Profile Updated Succefully!";
    } else {
      echo "Error updating profile0_e_0";
    }
  }


  // 
} else {
  echo "Please provide complete details0_e_0";
}
