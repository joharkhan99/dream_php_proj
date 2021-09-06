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

function LIKE($id)
{
  global $connection;
  $id = sanitize($id);

  $query = "UPDATE posts SET post_likes=post_likes+1 WHERE id='$id'";
  $result = mysqli_query($connection, $query);
  if ($result) {
    return true;
  } else {
    return false;
  }
}

function DISLIKE($id)
{
  global $connection;
  $id = sanitize($id);

  $query = "UPDATE posts SET post_dislikes=post_dislikes+1 WHERE id='$id'";
  $result = mysqli_query($connection, $query);
  if ($result) {
    return true;
  } else {
    return false;
  }
}

function ADDVIEW($id)
{
  global $connection;
  $id = sanitize($id);

  $query = "UPDATE posts SET post_views=post_views+1 WHERE id='$id'";
  $result = mysqli_query($connection, $query);
  if ($result) {
    return true;
  } else {
    return false;
  }
}
function timeAgo($time_ago)
{
  $time_ago = strtotime($time_ago);
  $cur_time   = time();
  $time_elapsed   = $cur_time - $time_ago;
  $seconds    = $time_elapsed;
  $minutes    = round($time_elapsed / 60);
  $hours      = round($time_elapsed / 3600);
  $days       = round($time_elapsed / 86400);
  $weeks      = round($time_elapsed / 604800);
  $months     = round($time_elapsed / 2600640);
  $years      = round($time_elapsed / 31207680);
  // Seconds
  if ($seconds <= 60) {
    return "just now";
  }
  //Minutes
  else if ($minutes <= 60) {
    if ($minutes == 1) {
      return "one minute ago";
    } else {
      return "$minutes minutes ago";
    }
  }
  //Hours
  else if ($hours <= 24) {
    if ($hours == 1) {
      return "an hour ago";
    } else {
      return "$hours hrs ago";
    }
  }
  //Days
  else if ($days <= 7) {
    if ($days == 1) {
      return "yesterday";
    } else {
      return "$days days ago";
    }
  }
  //Weeks
  else if ($weeks <= 4.3) {
    if ($weeks == 1) {
      return "a week ago";
    } else {
      return "$weeks weeks ago";
    }
  }
  //Months
  else if ($months <= 12) {
    if ($months == 1) {
      return "a month ago";
    } else {
      return "$months months ago";
    }
  }
  //Years
  else {
    if ($years == 1) {
      return "one year ago";
    } else {
      return "$years years ago";
    }
  }
}

function random_pic($dir = '../profiles')
{
  $files = glob($dir . '/*.*');
  $file = array_rand($files);
  return $files[$file];
}

function AddComment($name, $email, $userimg, $p_id, $comment_text, $user_unique_id = "none")
{
  global $connection;

  $query = "INSERT INTO comments(username,email,userimg,text,post_id,user_unique_id) VALUES('$name','$email','$userimg','$comment_text','$p_id','$user_unique_id')";
  $result = mysqli_query($connection, $query);

  if ($result) {
    return true;
  } else {
    return false;
  }
}

function AddReply($comment_id, $name, $email, $p_id, $comment_text, $user_unique_id = "none")
{
  global $connection;

  $query = "INSERT INTO comment_replies(comment_id,username,email,text,post_id,user_unique_id) VALUES('$comment_id','$name','$email','$comment_text','$p_id','$user_unique_id')";
  $result = mysqli_query($connection, $query);

  if ($result) {
    return true;
  } else {
    return false;
  }
}

class GetSavedUserCommentInfo
{
  public $name = "", $email, $userimg, $user_unique_id;

  function __construct($user_unique_id)
  {
    $this->user_unique_id = $user_unique_id;
    $this->GetUserInfo();
  }

  public function GetUserInfo()
  {
    global $connection;
    $query = "SELECT username,email,userimg FROM comments WHERE user_unique_id='" . $this->user_unique_id . "' LIMIT 1";
    $result = mysqli_query($connection, $query);

    if ($result) {
      $row = mysqli_fetch_assoc($result);
      if (!empty($row)) {
        $this->name = $row['username'];
        $this->email = $row['email'];
        $this->userimg = $row['userimg'];
      }
    } else {
      return false;
    }
  }
}

class GetSavedUserReplyInfo
{
  public $name, $email, $user_unique_id;

  function __construct($user_unique_id)
  {
    $this->user_unique_id = $user_unique_id;
    $this->GetUserInfo();
  }

  public function GetUserInfo()
  {
    global $connection;
    $query = "SELECT username,email FROM comment_replies WHERE user_unique_id='" . $this->user_unique_id . "' LIMIT 1";
    $result = mysqli_query($connection, $query);

    if ($result) {

      $row = mysqli_fetch_assoc($result);
      if (!empty($row)) {
        $this->name = $row['username'];
        $this->email = $row['email'];
      }
    } else {
      return false;
    }
  }
}
?>