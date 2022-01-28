<?php include "functions.php" ?>

<?php
if (IsEmptyString($_POST['blog_seo_words'])) {
  echo "Add Some SEO keywords0_e_0";
} elseif (IsEmptyString($_POST['blog_meta_desc'])) {
  echo "Add Blog Meta Description0_e_0";
} elseif (IsEmptyString($_POST['blog_title'])) {
  echo "Add Blog Title0_e_0";
} elseif (IsEmptyString($_POST['blog_tagline'])) {
  echo "Add Blog Tag Line0_e_0";
} elseif (IsEmptyString($_POST['blog_category'])) {
  echo "Select Blog Category0_e_0";
} elseif (empty($_FILES['blog_feature_image'])) {
  echo "Add Blog Feature Image0_e_0";
} elseif (IsEmptyString($_POST['body'])) {
  echo "Add Blog Body/Content0_e_0";
} else {

  if ($_FILES['blog_feature_image']['name']) {
    if (!$_FILES['blog_feature_image']['error']) {

      $name = md5(rand(100, 200));
      $ext = pathinfo($_FILES['blog_feature_image']['name'], PATHINFO_EXTENSION);
      $filename = $name . '.' . $ext;
      $destination = '../feature/' . $filename;
      $location = $_FILES["blog_feature_image"]["tmp_name"];

      if (move_uploaded_file($location, $destination)) {

        $blog_seo_words = sanitize($_POST['blog_seo_words']);
        $blog_meta_desc = sanitize($_POST['blog_meta_desc']);
        $blog_title = sanitize($_POST['blog_title']);
        $blog_tagline = sanitize($_POST['blog_tagline']);
        $blog_category = sanitize($_POST['blog_category']);
        $blog_body = $_POST['body'];
        $comment_status = sanitize($_POST['comment_status']);

        if (AddBlog($blog_seo_words, $blog_meta_desc, $blog_title, $blog_tagline, $blog_category, $blog_body, $comment_status, $destination)) {
          echo "Blog Published";
        } else {
          echo 'Error Publishing0_e_0';
        }

        if (!IsEmptyString($_POST['draft_id'])) {
          $draft_id = $_POST['draft_id'];
          if (DeleteFromDraft($draft_id)) {
            echo 'Blog Published';
          } else {
            echo 'Error Publishing0_e_0';
          }
        }



        // 
      } else {
        echo 'Error Publishing0_e_0';
      }
    } else {
      echo '0_e_0Error Publishing';
    }
  }
}
