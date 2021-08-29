<?php session_start(); ?>
<?php include "db.php"; ?>
<!-- admin -->
<!-- admin@site@2899 -->
<?php
function sanitize($str)
{
  global $connection;

  if (empty($str)) {
    return $str;
  } else {
    $str = mysqli_real_escape_string($connection, trim(stripslashes(htmlentities(strip_tags($str), ENT_QUOTES, "UTF-8"))));
    return $str;
  }
}

function emailExists($email)
{
  global $connection;
  if (!empty($email)) {
    $query = "SELECT email FROM users WHERE email='$email'";
    $result = mysqli_query($connection, $query);
    if (mysqli_num_rows($result) > 0)   //means exist
      return true;
    else
      return false;
  }
}

function IsEmptyString($str)
{
  $str = sanitize($str);

  if (!isset($str) || empty($str)) {
    return true;
  } else {
    return false;
  }
}

function generate_key($email)
{
  if (!empty($email)) {

    $key = md5(uniqid($email, true));
    return $key;
  }
}

function GetUserRole($userkey)
{
  global $connection;
  $userkey = sanitize($userkey);
  $query = "SELECT roles.role FROM user_roles INNER JOIN roles ON roles.id=user_roles.roleId WHERE user_roles.userkey='$userkey'";
  $row = mysqli_query($connection, $query);

  return mysqli_fetch_assoc($row)['role'];
}

function loginUser($email, $password)
{
  global $connection;

  if (!emailExists($email)) {
    return false;
  } else {

    if (!empty($email) && !empty($password) && emailExists($email)) {
      $query = "SELECT * FROM users WHERE email='$email'";
      $result = mysqli_query($connection, $query);

      $row = mysqli_fetch_assoc($result);
      $db_email = $row['email'];
      $db_pass = $row['password'];
      $verifyPass = password_verify($password, $db_pass);

      if ($email == $db_email && $verifyPass) {
        $_SESSION['userkey'] = $row['userkey'];
        $_SESSION['role'] = GetUserRole($row['userkey']);
        return true;
      } else {
        $_SESSION['userkey'] = '';
        $_SESSION['role'] = '';
        return false;
      }
    }
  }
}

function a_c($catg)
{
  global $connection;

  $query = "INSERT INTO categories(cat_name) VALUES('$catg')";
  $result = mysqli_query($connection, $query);
  if (!$result) {
    return false;
  } else {
    return true;
  }
}

function G_Cat()
{
  global $connection;
  $output = "";
  $query = "SELECT * FROM categories";
  $result = mysqli_query($connection, $query);
  while ($row = mysqli_fetch_assoc($result)) {
    $output .= '<option value="' . $row['cat_id'] . '">' . $row['cat_name'] . '</option>';
  }
  echo $output;
}

function AddBlog($blog_seo_words, $blog_meta_desc, $blog_title, $blog_tagline, $blog_category, $blog_body, $comment_status, $feature_image)
{

  global $connection;
  $author = sanitize($_SESSION['userkey']);

  $query = "INSERT INTO posts(post_author,post_content,post_title,comment_status,post_categoryID,post_keywords,post_meta_descp,post_tag,post_feature_image) VALUES('$author','$blog_body','$blog_title','$comment_status','$blog_category','$blog_seo_words','$blog_meta_desc','$blog_tagline','$feature_image')";
  $result = mysqli_query($connection, $query);
  if ($result) {
    return true;
  } else {
    return false;
  }
}
?>