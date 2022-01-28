<?php include "functions.php" ?>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $destination = "";

  if (isset($_FILES['blog_feature_image']['name'])) {
    if (!$_FILES['blog_feature_image']['error']) {

      $name = md5(rand(100, 200));
      $ext = pathinfo($_FILES['blog_feature_image']['name'], PATHINFO_EXTENSION);
      $filename = $name . '.' . $ext;
      $destination = '../feature/' . $filename;
      $location = $_FILES["blog_feature_image"]["tmp_name"];
      move_uploaded_file($location, $destination);
    }
  }
  $blog_seo_words = "";
  $blog_meta_desc = "";
  $blog_title = "";
  $blog_tagline = "";
  $blog_category = 0;
  $blog_body = "";
  $blog_comment_status = "";


  if (!empty($_POST['blog_seo_words'])) {
    $blog_seo_words = sanitize($_POST['blog_seo_words']);
  }
  if (!empty($_POST['blog_meta_desc'])) {
    $blog_meta_desc = sanitize($_POST['blog_meta_desc']);
  }
  if (!empty($_POST['blog_title'])) {
    $blog_title = sanitize($_POST['blog_title']);
  }
  if (!empty($_POST['blog_tagline'])) {
    $blog_tagline = sanitize($_POST['blog_tagline']);
  }
  if (!empty($_POST['blog_category'])) {
    $blog_category = sanitize($_POST['blog_category']);
  }
  if (!empty($_POST['body'])) {
    $blog_body = $_POST['body'];
  }
  if (!empty($_POST['comment_status'])) {
    $blog_comment_status = sanitize($_POST['comment_status']);
  }



  if (AddDraft($blog_seo_words, $blog_meta_desc, $blog_title, $blog_tagline, $blog_category, $blog_body, $blog_comment_status, $destination)) {
    echo "Draft Saved";
  } else {
    echo "Error saving draft0_e_0";
  }
}
