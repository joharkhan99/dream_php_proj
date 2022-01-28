<?php session_start(); ?>
<?php
// if ($_SESSION['role'] == 'admin') {

if ($_FILES['file']['name']) {
  if (!$_FILES['file']['error']) {
    $name = md5(rand(100, 200));
    $ext = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
    $filename = $name . '.' . $ext;
    $destination = '../posts/' . $filename;
    $location = $_FILES["file"]["tmp_name"];

    if (move_uploaded_file($location, $destination)) {
      echo $destination;
    } else {
      echo 'Error Adding Image0_e_0';
    }
  } else {
    echo '0_e_0Error Adding Image' . $_FILES['file']['error'];
  }
}
// }
