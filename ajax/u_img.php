<?php
include_once "functions.php";
checkIfLogin();
?>
<?php
if ($_FILES['file']['name']) {
  if (!$_FILES['file']['error']) {
    $image = $_FILES['file']['name'];
    $image_tempAddress = $_FILES['file']['tmp_name'];
    $file_extension = pathinfo($image, PATHINFO_EXTENSION);
    $newname = uniqid(rand()) . str_replace("." . $file_extension, "", $image);

    $binary = @imagecreatefromstring(@file_get_contents($image));
    $image_quality = floor(10 - (100 / 10));
    @imagewebp($binary, "posts/" . $newname . '.webp', $image_quality);
    $final = $newname . '.webp';

    if (move_uploaded_file($image_tempAddress, "../posts/$final")) {
      echo "../posts/$final";
    } else {
      echo 'Error Adding Image0_e_0';
    }
  } else {
    echo '0_e_0Error Adding Image' . $_FILES['file']['error'];
  }
}
