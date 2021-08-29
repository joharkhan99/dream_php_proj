<?php include "functions.php" ?>
<?php
if (isset($_POST['catg']) && !empty($_POST['catg'])) {

  $catg = sanitize($_POST['catg']);

  if (empty($catg)) {
    echo "Field can't be empty0";
  } elseif (!a_c($catg)) {
    echo "Error !0";
  } else {
    echo "Category Added";
  }
} else {
  echo "Field can't be empty0";
}

// category add