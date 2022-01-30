<?php include "functions.php";
checkIfLogin(); ?>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  if (!IsEmptyString($_POST['article-category-select']) && !IsEmptyString($_POST['article-category-input'])) {
    echo "Please either select or add Article Category0_e_0";
  }

  $featureimage = "";

  if (isset($_FILES['article-file']['name'])) {
    if (!$_FILES['article-file']['error']) {

      $image = $_FILES['article-file']['name'];
      $image_tempAddress = $_FILES['article-file']['tmp_name'];
      $file_extension = pathinfo($image, PATHINFO_EXTENSION);
      $newname = uniqid(rand()) . str_replace("." . $file_extension, "", $image);

      $binary = @imagecreatefromstring(@file_get_contents($image));
      $image_quality = floor(10 - (100 / 10));
      @imagewebp($binary, "feature/" . $newname . '.webp', $image_quality);
      $final = $newname . '.webp';
      if (move_uploaded_file($image_tempAddress, "../feature/$final")) {
        $featureimage = $final;
      }
    }
  }

  $article_title = "";
  $article_tags = "";
  $article_category_select = "";
  $article_category_input = "";
  $article_body = "";

  if (!empty($_POST['article-title'])) {
    $article_title = sanitize($_POST['article-title']);
  }
  if (!empty($_POST['article-tags'])) {
    $article_tags = sanitize($_POST['article-tags']);
  }
  if (!empty($_POST['article-category-select'])) {
    $article_category_select = sanitize($_POST['article-category-select']);
  }
  if (!empty($_POST['article-category-input'])) {
    $article_category_input = sanitize($_POST['article-category-input']);
  }
  if (!empty($_POST['body'])) {
    $article_body = sanitize($_POST['body']);
  }

  $article_category = $article_category_select ? !empty($article_category_select) : $article_category_input;

  if (AddDraft($article_title, $article_tags, $featureimage, $article_category, $article_body)) {
    echo "Draft Saved Successfully";
  } else {
    echo "Error saving draft0_e_0";
  }
}
