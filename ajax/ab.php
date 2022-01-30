<?php include "functions.php";
checkIfLogin(); ?>
<?php
if (IsEmptyString($_POST['article-title'])) {
  echo "Please add Article Title0_e_0";
} elseif (empty($_FILES['article-file'])) {
  echo "Please add Article Feature Image0_e_0";
} elseif (IsEmptyString($_POST['article-tags'])) {
  echo "Please add Article Tags0_e_0";
} elseif (count(explode(",", $_POST['article-tags'])) < 3) {
  echo "Please add atleast 3 Article Tags0_e_0";
} elseif (IsEmptyString($_POST['article-category-select']) && IsEmptyString($_POST['article-category-input'])) {
  echo "Please select or add Article Category0_e_0";
} elseif (!IsEmptyString($_POST['article-category-select']) && !IsEmptyString($_POST['article-category-input'])) {
  echo "Please either select or add Article Category0_e_0";
} elseif (IsEmptyString(trim($_POST['body']))) {
  echo "Please add Article Body/Content0_e_0";
} else {

  if ($_FILES['article-file']['name']) {
    if (!$_FILES['article-file']['error']) {
      $image = $_FILES['article-file']['name'];
      $image_tempAddress = $_FILES['article-file']['tmp_name'];
      $file_extension = pathinfo($image, PATHINFO_EXTENSION);
      $newname = uniqid(rand()) . str_replace("." . $file_extension, "", $image);

      $binary = @imagecreatefromstring(@file_get_contents($image));
      $image_quality = floor(10 - (100 / 10));
      @imagewebp($binary, "feature/" . $newname . '.webp', $image_quality);
      $final = $newname . '.webp';

      $article_title = sanitize($_POST['article-title']);
      $article_tags = sanitize($_POST['article-tags']);
      $article_category_select = sanitize($_POST['article-category-select']);
      $article_category_input = sanitize($_POST['article-category-input']);
      $article_category = $article_category_select ? !empty($article_category_select) : $article_category_input;
      $article_body = $_POST['body'];

      if (AddArticle($article_title, $article_tags, $final, $article_category, $article_body)) {
        if (move_uploaded_file($image_tempAddress, "../feature/$final")) {
          echo "Article Published Successfully";
        } else {
          echo 'Error Publishing Article0_e_0';
        }
      } else {
        echo 'Error Publishing Article0_e_0';
      }


      // 
    } else {
      echo '0_e_0Error Publishing Article';
    }
  }
}
