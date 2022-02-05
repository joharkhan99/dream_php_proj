<?php include "functions.php" ?>
<?php checkIfLogin(); ?>
<?php
if (!IsEmptyString($_POST['pass']) && !IsEmptyString($_POST['cnfm_pass'])) {

  $pass = sanitize($_POST['pass']);
  $cnfm_pass = sanitize($_POST['cnfm_pass']);
  $userkey = sanitize($_COOKIE['_uacct_']);

  if (!userKeyExists($userkey)) {
    header("Location:../logout.php");
    exit();
  }

  if (strlen($pass) < 8) {
    echo "Password length should be atleast 8 characters0_e_0";
    exit();
  } elseif ($pass != $cnfm_pass) {
    echo "Passwords do not match0_e_0";
    exit();
  } else {
    if (ChangePassword($pass, $cnfm_pass, $userkey)) {
      echo "Password Updated Successfully!";
    } else {
      echo "Error Updating Password0_e_0";
    }
  }

  // 
} else {
  echo "Please provide complete details0_e_0";
}
