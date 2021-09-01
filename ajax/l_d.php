<?php include "functions.php" ?>
<?php
if (isset($_POST['like']) && isset($_POST['id'])) {
  LIKE($_POST['id']);
}

if (isset($_POST['dislike']) && isset($_POST['id'])) {
  DISLIKE($_POST['id']);
}
